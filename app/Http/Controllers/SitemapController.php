<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use App\Models\Material;
use App\Models\News;
use App\Models\OrganizationMenu;
use App\Models\ProfileMenu;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create();

        // Static pages
        $sitemap->add(
            Url::create(url('/'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(1.0)
        );

        $sitemap->add(
            Url::create(url('/profile'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9)
        );

        $sitemap->add(
            Url::create(url('/organization'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9)
        );

        $sitemap->add(
            Url::create(url('/news'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.9)
        );

        $sitemap->add(
            Url::create(url('/agenda'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                ->setPriority(0.9)
        );

        $sitemap->add(
            Url::create(url('/materials'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.8)
        );

        $sitemap->add(
            Url::create(url('/buletin'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.7)
        );

        $sitemap->add(
            Url::create(url('/pesan-buper'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                ->setPriority(0.7)
        );

        $sitemap->add(
            Url::create(url('/kirim-berita'))
                ->setLastModificationDate(now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
                ->setPriority(0.5)
        );

        // Profile menu pages
        ProfileMenu::where('is_active', true)->each(function (ProfileMenu $menu) use ($sitemap) {
            $sitemap->add(
                Url::create(url('/profile/'.$menu->slug))
                    ->setLastModificationDate($menu->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.7)
            );
        });

        // Organization menu pages
        OrganizationMenu::where('is_active', true)->each(function (OrganizationMenu $menu) use ($sitemap) {
            $sitemap->add(
                Url::create(url('/organization/'.$menu->slug))
                    ->setLastModificationDate($menu->updated_at)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                    ->setPriority(0.7)
            );
        });

        // News pages
        News::where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->each(function (News $news) use ($sitemap) {
                $sitemap->add(
                    Url::create(url('/news/'.$news->slug))
                        ->setLastModificationDate($news->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                        ->setPriority(0.8)
                );
            });

        // Agenda pages
        Agenda::where('is_active', true)
            ->orderBy('event_date', 'desc')
            ->each(function (Agenda $agenda) use ($sitemap) {
                $sitemap->add(
                    Url::create(url('/agenda/'.$agenda->slug))
                        ->setLastModificationDate($agenda->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
                        ->setPriority(0.7)
                );
            });

        // Material pages
        Material::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->each(function (Material $material) use ($sitemap) {
                $sitemap->add(
                    Url::create(url('/materials/'.$material->slug))
                        ->setLastModificationDate($material->updated_at)
                        ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
                        ->setPriority(0.6)
                );
            });

        return $sitemap->toResponse(request());
    }
}
