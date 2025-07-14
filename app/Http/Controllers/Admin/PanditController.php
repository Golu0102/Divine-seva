<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pandit;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PanditController extends Controller
{
    public function index()
    {
        $pandits = Pandit::latest()->get();
        return view('admin.pandits.index', compact('pandits'));
    }

    public function create()
    {
        return view('admin.pandits.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'bio' => 'nullable|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('pandits', 'public');
        }

        Pandit::create($validated);

        return redirect()->route('pandits.index')->with('success', 'Pandit added successfully.');
    }

    public function edit(Pandit $pandit)
    {
        return view('admin.pandits.edit', compact('pandit'));
    }

    public function update(Request $request, Pandit $pandit)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'nullable|email',
            'phone' => 'nullable|string|max:15',
            'bio' => 'nullable|string',
            'facebook' => 'nullable|url',
            'instagram' => 'nullable|url',
            'twitter' => 'nullable|url',
            'youtube' => 'nullable|url',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($pandit->image && Storage::disk('public')->exists($pandit->image)) {
                Storage::disk('public')->delete($pandit->image);
            }
            $validated['image'] = $request->file('image')->store('pandits', 'public');
        }

        $pandit->update($validated);

        return redirect()->route('pandits.index')->with('success', 'Pandit updated successfully.');
    }

    public function destroy(Pandit $pandit)
    {
        if ($pandit->image && Storage::disk('public')->exists($pandit->image)) {
            Storage::disk('public')->delete($pandit->image);
        }

        $pandit->delete();

        return redirect()->route('pandits.index')->with('success', 'Pandit deleted successfully.');
    }
}
