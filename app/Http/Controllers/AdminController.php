<?php

namespace App\Http\Controllers;

use App\Models\Request as HelpRequest;
use App\Models\MissingPerson;
use Illuminate\Http\Request;
use Inertia\Inertia;

class AdminController extends Controller
{
    public function index()
    {
        $stats = [
            'requests' => [
                'pending' => HelpRequest::where('status', 'pending')->count(),
                'accepted' => HelpRequest::where('status', 'accepted')->count(),
                'completed' => HelpRequest::where('status', 'completed')->count(),
                'total' => HelpRequest::count(),
            ],
            'missing_people' => [
                'missing' => MissingPerson::where('status', 'missing')->count(),
                'found' => MissingPerson::where('status', 'found')->count(),
                'total' => MissingPerson::count(),
            ]
        ];

        $requests = HelpRequest::latest()->paginate(10, ['*'], 'requests_page');
        $missingPeople = MissingPerson::latest()->paginate(10, ['*'], 'missing_page');

        return Inertia::render('Admin/Dashboard', [
            'stats' => $stats,
            'requests' => $requests,
            'missingPeople' => $missingPeople,
        ]);
    }

    public function updateRequest(Request $request, $id)
    {
        $helpRequest = HelpRequest::findOrFail($id);
        
        $request->validate([
            'status' => 'required|in:pending,accepted,delivering,completed,verified',
            'category' => 'required|string',
        ]);

        $helpRequest->update($request->only(['status', 'category']));

        return redirect()->back()->with('success', 'Request updated successfully');
    }

    public function destroyRequest($id)
    {
        HelpRequest::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Request deleted successfully');
    }

    public function updateMissingPerson(Request $request, $id)
    {
        $person = MissingPerson::findOrFail($id);

        $request->validate([
            'status' => 'required|in:missing,found',
            'name' => 'required|string',
        ]);

        $person->update($request->only(['status', 'name']));

        return redirect()->back()->with('success', 'Missing person updated successfully');
    }

    public function destroyMissingPerson($id)
    {
        MissingPerson::findOrFail($id)->delete();

        return redirect()->back()->with('success', 'Missing person deleted successfully');
    }
}
