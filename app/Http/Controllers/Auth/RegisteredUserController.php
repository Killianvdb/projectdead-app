<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse{ 
        
        $request->validate([        
             'name' => ['required', 'string', 'max:255'],     
             'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],     
             'birthday' => ['required', 'date'],         'avatar' => ['image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],         
             'password' => ['required', 'confirmed', Rules\Password::defaults()],     ]);  

             if ($request->hasFile('avatar')) {         
                $avatar = $request->file('avatar');         
                $avatarPath = $avatar->store('avatars', 'public');     } 
                else {         $avatarPath = null;     }    
                 $user = User::create([         
                    'name' => $request->name,         
                    'email' => $request->email,         
                    'birthday' => Carbon::createFromFormat('Y-m-d', $request->birthday),         
                    'password' => Hash::make($request->password),         
                    'avatar' => $avatarPath,     ]);     
                    
                    event(new Registered($user));     
                    Auth::login($user);    
                     return redirect(RouteServiceProvider::HOME); }
}

