<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use App\Models\Role;
use App\Services\Admin\UserService;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $users = User::with('role')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('admin.users.create', compact('roles'));
    }

    public function store(StoreUserRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.users.index')->with('success', 'User created');
    }

    public function show(User $user)
    {
        return view('admin.users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();
        return view('admin.users.edit', compact('user','roles'));
    }

    public function update(UpdateUserRequest $request, User $user)
    {
        $this->service->update($user, $request->validated());

        return redirect()->route('admin.users.index')->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        $this->service->delete($user);

        return back()->with('success', 'User deleted');
    }

    public function ban(User $user)
    {
        $this->service->ban($user);
        return back()->with('success', 'User banned');
    }

    public function unban(User $user)
    {
        $this->service->unban($user);
        return back()->with('success', 'User unbanned');
    }
}

