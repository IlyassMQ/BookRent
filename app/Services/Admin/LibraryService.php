<?php

namespace App\Services\Admin;

use App\Models\Library;
use App\Models\User;

class LibraryService
{
    public function create(array $data): Library
    {
        $Library = Library::create([
            'name' => $data['name'],
            'address' => $data['address'],
            'geo_lat' => $data['geo_lat'] ?? null,
            'geo_lng' => $data['geo_lng'] ?? null,
            'user_id' => $data['user_id'],
            'status' => 'approved',
        ]);
        $user = User::findOrFail($data['user_id']);
        $user->update(['role_id' => 3]);

        return $Library ;
        }

    public function approve(Library $library): void
    {
        $library->update(['status' => 'approved']);
    }

    public function block(Library $library): void
    {
        $library->update(['status' => 'blocked']);
    }

    public function delete(Library $library): void
    {
        $library->delete();
    }
}