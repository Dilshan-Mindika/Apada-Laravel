<?php

namespace App\Http\Controllers;

use App\Models\Request as ReliefRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;

class MyRequestController extends Controller
{
    public function index()
    {
        return Inertia::render('MyRequests');
    }

    public function search(Request $request)
    {
        $request->validate([
            'phone' => 'required|string',
        ]);

        $requests = ReliefRequest::where('phone', $request->phone)
            ->orderBy('created_at', 'desc')
            ->get();

        return Inertia::render('MyRequests', [
            'requests' => $requests,
            'phone' => $request->phone,
        ]);
    }

    public function verify($id)
    {
        $reliefRequest = ReliefRequest::findOrFail($id);

        if ($reliefRequest->status === 'completed') {
            $reliefRequest->update(['status' => 'verified']);
        }

        return redirect()->back();
    }
}
