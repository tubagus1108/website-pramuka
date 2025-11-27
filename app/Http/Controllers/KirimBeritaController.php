<?php

namespace App\Http\Controllers;

use App\Models\SubmittedNews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;

class KirimBeritaController extends Controller
{
    public function index()
    {
        return view('pages.kirim-berita.index');
    }

    public function store(Request $request)
    {
        // Anti-spam: Rate limiting - max 3 submissions per hour per IP
        $key = 'submit-news:'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 3)) {
            $seconds = RateLimiter::availableIn($key);
            $minutes = ceil($seconds / 60);

            throw ValidationException::withMessages([
                'email' => "Terlalu banyak pengiriman. Silakan coba lagi dalam {$minutes} menit.",
            ]);
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'title' => 'required|string|max:255|min:10',
            'content' => 'required|string|min:50',
            'image' => 'nullable|image|max:2048',
            // Honeypot field - should be empty
            'website' => 'nullable|max:0',
            // Timestamp field - minimum 3 seconds to prevent instant bot submissions
            'form_start_time' => 'required|numeric',
        ]);

        // Anti-spam: Check minimum time (3 seconds)
        $formStartTime = (int) $validated['form_start_time'];
        $currentTime = time();
        $elapsedTime = $currentTime - $formStartTime;

        if ($elapsedTime < 3) {
            throw ValidationException::withMessages([
                'email' => 'Pengiriman terlalu cepat. Mohon isi form dengan lengkap.',
            ]);
        }

        // Anti-spam: Check for duplicate submissions (same email + title in last hour)
        $recentSubmission = SubmittedNews::where('email', $validated['email'])
            ->where('title', $validated['title'])
            ->where('created_at', '>', now()->subHour())
            ->exists();

        if ($recentSubmission) {
            throw ValidationException::withMessages([
                'title' => 'Anda sudah mengirimkan berita dengan judul yang sama. Mohon tunggu sebelum mengirim lagi.',
            ]);
        }

        $imagePath = null;
        $imageWebpPath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('submitted-news', 'public');

            // Generate WebP version
            $originalPath = storage_path('app/public/'.$imagePath);
            $webpPath = str_replace(['.jpg', '.jpeg', '.png'], '.webp', $originalPath);
            $webpStoragePath = str_replace(['.jpg', '.jpeg', '.png'], '.webp', $imagePath);

            try {
                $manager = new ImageManager(new Driver);
                $image = $manager->read($originalPath);
                $image->toWebp(90)->save($webpPath);
                $imageWebpPath = $webpStoragePath;
            } catch (\Exception $e) {
                // If conversion fails, leave null
            }
        }

        SubmittedNews::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'title' => $validated['title'],
            'content' => $validated['content'],
            'image' => $imagePath,
            'image_webp' => $imageWebpPath,
            'status' => 'pending',
        ]);

        // Record successful submission for rate limiting
        RateLimiter::hit($key, 3600); // 1 hour decay

        return redirect()->back()->with('success', 'Berita Anda telah terkirim dan akan segera ditinjau oleh admin.');
    }
}
