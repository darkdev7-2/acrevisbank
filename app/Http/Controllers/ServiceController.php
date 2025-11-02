<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of services
     */
    public function index(Request $request)
    {
        $query = Service::where('is_active', true)
            ->orderBy('order');

        // Filter by category if provided
        if ($request->has('category')) {
            $query->where('category', $request->category);
        }

        // Filter by segment if provided
        if ($request->has('segment')) {
            $query->where('segment', $request->segment);
        }

        $services = $query->get();

        // Get all categories for filter
        $categories = Service::where('is_active', true)
            ->select('category')
            ->distinct()
            ->pluck('category');

        return view('pages.services.index', compact('services', 'categories'));
    }

    /**
     * Display the specified service
     */
    public function show(string $slug)
    {
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        // Get related services from the same category
        $relatedServices = Service::where('category', $service->category)
            ->where('slug', '!=', $slug)
            ->where('is_active', true)
            ->orderBy('order')
            ->limit(3)
            ->get();

        return view('pages.services.detail', compact('service', 'relatedServices'));
    }
}
