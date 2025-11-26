<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OptimizeResponse
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Only optimize HTML responses
        if ($response->headers->get('Content-Type') === 'text/html; charset=UTF-8' ||
            str_contains($response->headers->get('Content-Type', ''), 'text/html')) {

            // Add performance headers
            $response->headers->set('X-Content-Type-Options', 'nosniff');
            $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
            $response->headers->set('X-XSS-Protection', '1; mode=block');
            $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

            // Cache headers for static content
            if (! $request->is('admin/*') && ! $request->is('filament/*')) {
                $response->headers->set('Cache-Control', 'public, max-age=3600, must-revalidate');
            }

            // Minify HTML output
            if (config('app.env') === 'production') {
                $content = $response->getContent();
                if ($content) {
                    $content = $this->minifyHtml($content);
                    $response->setContent($content);
                }
            }
        }

        // Add static assets cache headers
        if ($request->is('build/*') || $request->is('css/*') || $request->is('js/*') || $request->is('fonts/*')) {
            $response->headers->set('Cache-Control', 'public, max-age=31536000, immutable');
        }

        return $response;
    }

    /**
     * Minify HTML content
     */
    protected function minifyHtml(string $html): string
    {
        // Remove HTML comments (except IE conditionals)
        $html = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $html);

        // Remove whitespace between tags
        $html = preg_replace('/>\s+</', '><', $html);

        // Remove multiple spaces
        $html = preg_replace('/\s+/', ' ', $html);

        return trim($html);
    }
}
