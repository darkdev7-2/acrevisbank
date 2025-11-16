<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Service;
use App\Models\Page;
use App\Models\Agency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display search results page
     */
    public function index(Request $request)
    {
        $query = $request->get('q', '');
        $locale = app()->getLocale();
        $segment = session('segment', 'privat');

        if (empty($query) || strlen($query) < 2) {
            return view('pages.search', [
                'query' => $query,
                'results' => collect([]),
                'total' => 0,
            ]);
        }

        $results = collect([]);

        // Search Articles
        $articles = Article::where('is_published', true)
            ->where(function ($q) use ($query, $locale) {
                $q->where('title->' . $locale, 'LIKE', "%{$query}%")
                  ->orWhere('excerpt->' . $locale, 'LIKE', "%{$query}%")
                  ->orWhere('content->' . $locale, 'LIKE', "%{$query}%");
            })
            ->limit(10)
            ->get()
            ->map(function ($article) use ($locale) {
                return [
                    'type' => 'article',
                    'title' => $article->getTranslation('title', $locale),
                    'excerpt' => $article->getTranslation('excerpt', $locale),
                    'url' => route('blog.show', ['locale' => $locale, 'slug' => $article->slug]),
                    'category' => $article->category?->name,
                    'date' => $article->published_at?->format('d/m/Y'),
                ];
            });

        // Search Services
        $services = Service::where('is_published', true)
            ->where('segment', $segment)
            ->where(function ($q) use ($query, $locale) {
                $q->where('title->' . $locale, 'LIKE', "%{$query}%")
                  ->orWhere('description->' . $locale, 'LIKE', "%{$query}%")
                  ->orWhere('content->' . $locale, 'LIKE', "%{$query}%");
            })
            ->limit(10)
            ->get()
            ->map(function ($service) use ($locale) {
                return [
                    'type' => 'service',
                    'title' => $service->getTranslation('title', $locale),
                    'excerpt' => $service->getTranslation('description', $locale),
                    'url' => route('services.detail', ['locale' => $locale, 'slug' => $service->slug]),
                    'category' => $service->category,
                    'icon' => $service->icon,
                ];
            });

        // Search Pages
        $pages = Page::where('is_published', true)
            ->where(function ($q) use ($query, $locale) {
                $q->where('title->' . $locale, 'LIKE', "%{$query}%")
                  ->orWhere('content->' . $locale, 'LIKE', "%{$query}%");
            })
            ->limit(10)
            ->get()
            ->map(function ($page) use ($locale) {
                return [
                    'type' => 'page',
                    'title' => $page->getTranslation('title', $locale),
                    'excerpt' => \Str::limit(strip_tags($page->getTranslation('content', $locale)), 150),
                    'url' => '/' . $locale . '/' . $page->slug,
                ];
            });

        // Search Agencies
        $agencies = Agency::where('is_active', true)
            ->where(function ($q) use ($query, $locale) {
                $q->where('name->' . $locale, 'LIKE', "%{$query}%")
                  ->orWhere('address->' . $locale, 'LIKE', "%{$query}%")
                  ->orWhere('city', 'LIKE', "%{$query}%")
                  ->orWhere('postal_code', 'LIKE', "%{$query}%");
            })
            ->limit(10)
            ->get()
            ->map(function ($agency) use ($locale) {
                return [
                    'type' => 'agency',
                    'title' => $agency->getTranslation('name', $locale),
                    'excerpt' => $agency->getTranslation('address', $locale) . ', ' . $agency->city,
                    'url' => route('agencies', ['locale' => $locale]) . '#agency-' . $agency->id,
                    'phone' => $agency->phone,
                    'city' => $agency->city,
                ];
            });

        // Merge all results
        $results = $results->merge($articles)
                          ->merge($services)
                          ->merge($pages)
                          ->merge($agencies);

        return view('pages.search', [
            'query' => $query,
            'results' => $results,
            'total' => $results->count(),
            'articleCount' => $articles->count(),
            'serviceCount' => $services->count(),
            'pageCount' => $pages->count(),
            'agencyCount' => $agencies->count(),
        ]);
    }

    /**
     * AJAX search for instant results (modal)
     */
    public function ajax(Request $request)
    {
        $query = $request->get('q', '');
        $locale = app()->getLocale();
        $segment = session('segment', 'privat');

        if (empty($query) || strlen($query) < 2) {
            return response()->json([
                'results' => [],
                'total' => 0,
            ]);
        }

        $results = collect([]);

        // Search Articles (limit 3)
        $articles = Article::where('is_published', true)
            ->where(function ($q) use ($query, $locale) {
                $q->where('title->' . $locale, 'LIKE', "%{$query}%")
                  ->orWhere('excerpt->' . $locale, 'LIKE', "%{$query}%");
            })
            ->limit(3)
            ->get()
            ->map(function ($article) use ($locale) {
                return [
                    'type' => 'article',
                    'title' => $article->getTranslation('title', $locale),
                    'excerpt' => \Str::limit($article->getTranslation('excerpt', $locale), 100),
                    'url' => route('blog.show', ['locale' => $locale, 'slug' => $article->slug]),
                ];
            });

        // Search Services (limit 3)
        $services = Service::where('is_published', true)
            ->where('segment', $segment)
            ->where(function ($q) use ($query, $locale) {
                $q->where('title->' . $locale, 'LIKE', "%{$query}%")
                  ->orWhere('description->' . $locale, 'LIKE', "%{$query}%");
            })
            ->limit(3)
            ->get()
            ->map(function ($service) use ($locale) {
                return [
                    'type' => 'service',
                    'title' => $service->getTranslation('title', $locale),
                    'excerpt' => \Str::limit($service->getTranslation('description', $locale), 100),
                    'url' => route('services.detail', ['locale' => $locale, 'slug' => $service->slug]),
                ];
            });

        // Search Agencies (limit 2)
        $agencies = Agency::where('is_active', true)
            ->where(function ($q) use ($query, $locale) {
                $q->where('name->' . $locale, 'LIKE', "%{$query}%")
                  ->orWhere('city', 'LIKE', "%{$query}%");
            })
            ->limit(2)
            ->get()
            ->map(function ($agency) use ($locale) {
                return [
                    'type' => 'agency',
                    'title' => $agency->getTranslation('name', $locale),
                    'excerpt' => $agency->city,
                    'url' => route('agencies', ['locale' => $locale]) . '#agency-' . $agency->id,
                ];
            });

        // Merge results
        $results = $results->merge($articles)
                          ->merge($services)
                          ->merge($agencies);

        return response()->json([
            'results' => $results,
            'total' => $results->count(),
            'hasMore' => $results->count() >= 8,
        ]);
    }
}
