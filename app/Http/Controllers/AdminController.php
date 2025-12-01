<?php

namespace App\Http\Controllers;

use App\Models\Request as HelpRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'pending' => HelpRequest::where('status', 'pending')->count(),
            'accepted' => HelpRequest::where('status', 'accepted')->count(),
            'completed' => HelpRequest::where('status', 'completed')->count(),
            'total' => HelpRequest::count(),
        ];

        $requests = HelpRequest::latest()->paginate(10);

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'requests' => $requests,
        ]);
    }

    public function destroy($id)
    {
        HelpRequest::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Request deleted successfully');
    }
}
