<?php

namespace App\Http\Controllers;

use App\Models\Career;
use Illuminate\Http\Request;

class CareerController extends Controller
{
    public function index(Request $request)
    {
        $query = Career::active()->orderBy('order')->orderBy('published_at', 'desc');

        // Filter by department
        if ($request->has('department') && $request->department) {
            $query->where('department', $request->department);
        }

        // Filter by location
        if ($request->has('location') && $request->location) {
            $query->where('location', $request->location);
        }

        // Filter by contract type
        if ($request->has('contract_type') && $request->contract_type) {
            $query->where('contract_type', $request->contract_type);
        }

        $careers = $query->get();

        // Get unique values for filters
        $departments = Career::active()->distinct()->pluck('department');
        $locations = Career::active()->distinct()->pluck('location');
        $contractTypes = Career::active()->distinct()->pluck('contract_type');

        return view('pages.career.index', compact('careers', 'departments', 'locations', 'contractTypes'));
    }

    public function show($locale, $slug)
    {
        $career = Career::where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();

        return view('pages.career.show', compact('career'));
    }
}
