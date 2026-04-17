<?php
namespace App\Services;

use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data)
    {
        $isFirstUser = User::count() === 0;

        if ($isFirstUser) {
            $roleId = 1; 
        } else {
            $roleId = 2; 
        }

        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $roleId
        ]);

        if (!empty($data['tags'])) {
            $user->tags()->sync($data['tags'] ?? []);
        }

        Auth::login($user);

        return $user;
    }

    public function login(array $credentials)
    {
        return Auth::attempt($credentials);
    }

    public function logout()
    {
        Auth::logout();
    }
}