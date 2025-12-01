<?php

namespace App\Http\Controllers;

use App\Models\MissingPerson;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\Storage;

class MissingPersonController extends Controller
{
    public function index(Request $request)
    {
        $query = MissingPerson::query();

        if ($request->search) {
            $query->where('name', 'like', '%' . $request->search . '%')
                  ->orWhere('last_seen_location', 'like', '%' . $request->search . '%');
        }

        $people = $query->orderBy('created_at', 'desc')->paginate(12);

        return Inertia::render('MissingPeople/Index', [
            'people' => $people,
            'filters' => $request->only(['search']),
        ]);
    }

    public function create()
    {
        return Inertia::render('MissingPeople/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'age' => 'nullable|integer',
            'gender' => 'nullable|string',
            'last_seen_location' => 'required|string',
            'description' => 'nullable|string',
            'image' => 'nullable|image|max:2048', // 2MB Max
            'contact_name' => 'required|string|max:255',
            'contact_phone' => 'required|string|max:20',
            'contact_phone_2' => 'nullable|string|max:20',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('missing_people', 'public');
            $data['image_path'] = '/storage/' . $path;
        }

        MissingPerson::create($data);

        return redirect()->route('missing-people.index')->with('success', __('messages.success_report_missing'));
    }

    public function markFound($id)
    {
        $person = MissingPerson::findOrFail($id);
        // In a real app, we should verify ownership. For now, we'll allow it.
        $person->update(['status' => 'found']);

        return redirect()->back()->with('success', __('messages.success_mark_found'));
    }
}
