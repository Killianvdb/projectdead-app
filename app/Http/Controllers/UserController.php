<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;



class UserController extends Controller
{
    public function show($id)
{
    $user = User::find($id);

    if (!$user) {
        return response()->json(['message' => 'User not found'], 404);
    }

    if ($user == auth()->user()) {
        return redirect('/profile');
    } else {
        return view('profile.default', ['user' => $user]); // Pass $user to the view
    }
}


    public function promoteToAdmin($id)
    {
        // controleren als de huidige gebruiker een admin is
        if (auth()->user()->is_admin) {
            return redirect()->back()->with('error', 'You do not have the necessary permissions.');
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // geen user promoveren die al admin is
        if (!$user->is_admin) {
            $user->is_admin = true;
            $user->save();

            return redirect()->back()->with('success', 'User promoted to admin successfully!');
        }

        return redirect()->back()->with('error', 'User is already an admin.');
    }

    public function demoteFromAdmin($id)
    {
        //kijken of de huidige gebruiker een admin is
        if (auth()->user()->is_admin ) {
            return redirect()->back()->with('error', 'You do not have the necessary permissions.');
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // maak zeker dat je geen admin demote die geen admin is
        if ($user->is_admin) {
            $user->is_admin = false;
            $user->save();

            return redirect()->back()->with('success', 'User demoted from admin successfully!');
        }

        return redirect()->back()->with('error', 'User is not an admin.');
    }
}
