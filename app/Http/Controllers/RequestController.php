<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequestRequest;
use App\Models\Request as HelpRequest;
use Inertia\Inertia;

class RequestController extends Controller
{
    public function create()
    {
        return Inertia::render('RequestHelp');
    }

    public function store(StoreRequestRequest $request)
    {
        HelpRequest::create($request->validated());

        return redirect()->back()->with('success', 'success_request');
    }
}
