<?php

namespace App\Http\Controllers;

use App\Models\Profiles; 
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // Display a listing of the profiles
    public function index()
    {
        $profiles = Profiles::all(); 
        return view('profiles.index', ['profiles' => $profiles]);
    }

    // Show the form for creating a new profile
    public function create()
    {
        return view('profiles.create');
    }

    // Store a newly created profile in storage
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:200',
            'image' => 'required|max:100', 
        ]);

        $profile = new Profiles([ 
            'name' => $request->name,
            'image' => $request->image,
        ]);
        $profile->save();

        return redirect()->route('profiles.index')->with('success', 'Profile created successfully.');
    }

    // Display the specified profile
    public function show(Profiles $profile) 
    {
        return view('profiles.show', compact('profile'));
    }

    // Show the form for editing the specified profile
    public function edit(Profiles $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    // Update the specified profile in storage
    public function update(Request $request, Profiles $profile) 
    {
        $request->validate([
            'name' => 'required|max:200',
            'image' => 'required|max:100', 
        ]);

        $profile->update($request->all());
        return redirect()->route('profiles.index')->with('success', 'Profile updated successfully.');
    }

    // Remove the specified profile from storage
    public function destroy(Profiles $profile) 
    {
        $profile->delete();
        return redirect()->route('profiles.index')->with('success', 'Profile deleted successfully.');
    }
}
