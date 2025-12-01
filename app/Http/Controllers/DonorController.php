<?php

namespace App\Http\Controllers;

use App\Models\Request as HelpRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DonorController extends Controller
{
    public function index(Request $request)
    {
        $query = HelpRequest::query();

        if ($request->has('category') && $request->category !== 'All') {
            $query->where('category', $request->category);
        }

        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', "%{$request->search}%")
                  ->orWhere('phone', 'like', "%{$request->search}%");
            });
        }

        $requests = $query->where('status', '!=', 'completed')
                          ->latest()
                          ->paginate(10)
                          ->withQueryString();

        return Inertia::render('Donor/RequestList', [
            'requests' => $requests,
            'filters' => $request->only(['category', 'search']),
        ]);
    }

    public function accept($id)
    {
        $request = HelpRequest::findOrFail($id);
        $request->update(['status' => 'accepted']);

        return redirect()->back()->with('success', 'success_accept');
    }

    public function complete($id)
    {
        $request = HelpRequest::findOrFail($id);
        $request->update(['status' => 'completed']);

        return redirect()->back()->with('success', 'success_complete');
    }
}
