<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Models\Tag;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    private $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showRegister()
    {
        $tags = Tag::all();
        return view('auth.register', compact('tags'));
    }

    
    public function register(RegisterRequest $request)
    {
        $user = $this->authService->register($request->validated());

        return redirect()->route('home');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (!$this->authService->login($request->validated())) {
            return back()->withErrors(['email' => 'Invalid credentials']);
        }

        $request->session()->regenerate();
        $user = auth()->user();
        if ($user->role->name === 'admin') {
        return redirect()->route('admin.dashboard');
        }
        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        $this->authService->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}