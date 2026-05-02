<?php
namespace App\Services\user;

use App\Models\Library;
use App\Models\Role;
use App\Models\User;

class UserLibraryService
{
    public function create(User $user, array $data)
    {
        if (auth()->user()->library && auth()->user()->library->status === 'blocked') {
            return redirect()->route('home')
                ->with('error', 'Your library is blocked. You cannot create a new one.');
        }

        $library = Library::create([
            'name' => $data['name'],
            'address' => $data['address'] ?? null,
            'city' => $data['city'],
            'geo_lat' => $data['geo_lat'] ?? null,
            'geo_lng' => $data['geo_lng'] ?? null,
            'user_id' => $user->id,
            'status' => 'pending',
        ]);

        return $library;
    }
}