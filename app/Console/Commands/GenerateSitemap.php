<?php

namespace App\Console\Commands;

use App\Models\Agenda;
use App\Models\News;
use App\Models\OrganizationMenu;
use App\Models\ProfileMenu;
use Illuminate\Console\Command;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'sitemap:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate XML sitemap for SEO optimization';

    /**
     * Execute the console command.
     */
    public function handle(): int
    {
        $this->info('Generating sitemap...');

        $sitemap = Sitemap::create();

        // Add static pages
        $staticPages = [
            ['url' => '/', 'priority' => 1.0, 'frequency' => 'weekly'],
            ['url' => '/profile', 'priority' => 0.9, 'frequency' => 'weekly'],
            ['url' => '/organization', 'priority' => 0.9, 'frequency' => 'weekly'],
            ['url' => '/news', 'priority' => 0.9, 'frequency' => 'daily'],
            ['url' => '/agenda', 'priority' => 0.8, 'frequency' => 'daily'],
            ['url' => '/materials', 'priority' => 0.8, 'frequency' => 'weekly'],
            ['url' => '/buletin', 'priority' => 0.7, 'frequency' => 'monthly'],
            ['url' => '/pesan-buper', 'priority' => 0.5, 'frequency' => 'yearly'],
            ['url' => '/kirim-berita', 'priority' => 0.5, 'frequency' => 'yearly'],
        ];

        foreach ($staticPages as $page) {
            $sitemap->add(
                Url::create($page['url'])
                    ->setPriority($page['priority'])
                    ->setChangeFrequency($page['frequency'])
            );
        }

        $this->info('Added static pages');

        // Add dynamic profile pages
        ProfileMenu::all()->each(function (ProfileMenu $profile) use ($sitemap) {
            $sitemap->add(
                Url::create("/profile/{$profile->slug}")
                    ->setLastModificationDate($profile->updated_at)
                    ->setPriority(0.7)
                    ->setChangeFrequency('monthly')
            );
        });

        $this->info('Added profile pages: '.ProfileMenu::count());

        // Add dynamic organization pages
        OrganizationMenu::all()->each(function (OrganizationMenu $org) use ($sitemap) {
            $sitemap->add(
                Url::create("/organization/{$org->slug}")
                    ->setLastModificationDate($org->updated_at)
                    ->setPriority(0.7)
                    ->setChangeFrequency('monthly')
            );
        });

        $this->info('Added organization pages: '.OrganizationMenu::count());

        // Add news pages
        News::all()->each(function (News $news) use ($sitemap) {
            $sitemap->add(
                Url::create("/news/{$news->slug}")
                    ->setLastModificationDate($news->updated_at)
                    ->setPriority(0.8)
                    ->setChangeFrequency('weekly')
            );
        });

        $this->info('Added news pages: '.News::count());

        // Add agenda pages
        Agenda::all()->each(function (Agenda $agenda) use ($sitemap) {
            $sitemap->add(
                Url::create("/agenda/{$agenda->id}")
                    ->setLastModificationDate($agenda->updated_at)
                    ->setPriority(0.7)
                    ->setChangeFrequency('weekly')
            );
        });

        $this->info('Added agenda pages: '.Agenda::count());

        // Save to public directory
        $path = public_path('sitemap.xml');
        $sitemap->writeToFile($path);

        $this->info("✓ Sitemap generated successfully at: {$path}");
        $this->info('Total URLs: '.count($sitemap->getTags()));

        return Command::SUCCESS;
    }
}
