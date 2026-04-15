<?php
namespace App\Services\user;

use App\Models\Library;
use App\Models\Role;
use App\Models\User;

class UserLibraryService
{
    public function create(User $user, array $data): Library
    {
        if ($user->library) {
            throw new \Exception('User already has a library');
        }

        $library = Library::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'geo_lat' => $data['geo_lat'] ?? null,
            'geo_lng' => $data['geo_lng'] ?? null,
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        $role = Role::where('name', 'library')->first();

        $user->update([
            'role_id' => $role->id
        ]);

        return $library;
    }
}