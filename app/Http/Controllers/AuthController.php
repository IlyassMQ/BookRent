<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Services\AuthService;
use App\Models\Tag;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showRegister()
    {
        return view('auth.register', [
            'tags' => Tag::all()
        ]);
    }

    public function register(RegisterRequest $request)
    {
        $user = $this->authService->register($request->validated());

        return $this->redirectByRole($user);
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        if (!$this->authService->login($request->validated())) {
            return back()->withErrors([
                'email' => 'Invalid credentials'
            ]);
        }

        $request->session()->regenerate();

        return $this->redirectByRole(auth()->user());
    }

    public function logout(Request $request)
    {
        $this->authService->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    private function redirectByRole($user)
    {
        return match ($user->role->name) {
            'admin' => redirect('/admin'),
            'library' => redirect('/library'),
            default => redirect('/dashboard'),
        };
    }
}