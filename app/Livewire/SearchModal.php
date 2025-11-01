<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Service;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

class SearchModal extends Component
{
    public $query = '';
    public $results = [];
    public $isOpen = false;

    protected $listeners = ['openSearch' => 'open'];

    public function open()
    {
        $this->isOpen = true;
        $this->query = '';
        $this->results = [];
    }

    public function close()
    {
        $this->isOpen = false;
        $this->query = '';
        $this->results = [];
    }

    public function updatedQuery()
    {
        if (strlen($this->query) < 2) {
            $this->results = [];
            return;
        }

        $locale = app()->getLocale();
        $searchTerm = '%' . $this->query . '%';

        // Search in services
        $services = Service::where('is_active', true)
            ->where(function ($q) use ($searchTerm, $locale) {
                $q->where("title->{$locale}", 'LIKE', $searchTerm)
                  ->orWhere("description->{$locale}", 'LIKE', $searchTerm);
            })
            ->limit(5)
            ->get()
            ->map(function ($service) use ($locale) {
                return [
                    'type' => 'service',
                    'title' => $service->getTranslation('title', $locale),
                    'description' => \Str::limit($service->getTranslation('description', $locale), 100),
                    'url' => route('services.detail', ['locale' => $locale, 'slug' => $service->slug]),
                ];
            });

        // Search in articles
        $articles = Article::where('is_published', true)
            ->where('published_at', '<=', now())
            ->where(function ($q) use ($searchTerm, $locale) {
                $q->where("title->{$locale}", 'LIKE', $searchTerm)
                  ->orWhere("excerpt->{$locale}", 'LIKE', $searchTerm);
            })
            ->limit(5)
            ->get()
            ->map(function ($article) use ($locale) {
                return [
                    'type' => 'article',
                    'title' => $article->getTranslation('title', $locale),
                    'description' => \Str::limit($article->getTranslation('excerpt', $locale), 100),
                    'url' => route('blog.show', ['locale' => $locale, 'slug' => $article->slug]),
                ];
            });

        $this->results = $services->concat($articles)->toArray();
    }

    public function render()
    {
        return view('livewire.search-modal');
    }
}
