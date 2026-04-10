<?php
namespace App\Services\Admin;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserService
{
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role_id' => $data['role_id'],
        ]);
    }

    public function update(User $user, array $data)
    {
        $user->update($data);
    }

    public function delete(User $user)
    {
        $user->delete();
    }

    public function ban(User $user)
    {
        $user->update(['status' => 'banned']);
    }

    public function unban(User $user)
    {
        $user->update(['status' => 'active']);
    }
}