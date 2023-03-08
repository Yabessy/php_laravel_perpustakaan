<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AuthController extends Controller
{
    public function store(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'number_type' => ['required', Rule::in(User::NUMBER_TYPES)],
            'number' => ['required', 'numeric', 'unique:' . User::class],
            'password' => ['required', 'string', 'confirmed', 'max:255'],
        ]);
        if (!isset($credentials['role'])) {
            $credentials['role'] = 'Member';
        }
        $credentials['password'] = bcrypt($credentials['password']);
        $user = User::create($credentials);
        Auth::login($user);
        return redirect()->route('home');
    }
    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'number' => ['required'],
            'password' => ['required']
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'));
        }
        return back()->withErrors([
            'number' => 'the provided crendentials do not match our record',
        ])->onlyInput('number');
    }
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }
}
