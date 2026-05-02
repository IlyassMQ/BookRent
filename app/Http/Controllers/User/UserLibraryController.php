<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreLibraryRequest;
use App\Http\Requests\User\UpdateLibraryRequest;
use App\Services\user\UserLibraryService;

class UserLibraryController extends Controller
{
    
    public function __construct(private UserLibraryService $service) {}

    public function create()
    {
        // if (auth()->user()->library) {
        //     return redirect()->route('library.dashboard');
        // }

        return view('library.create');
    }

    public function store(StoreLibraryRequest $request)
    {
        $this->service->create(auth()->user(), $request->validated());

        return redirect()->route('home')
            ->with('success', 'Library created successfully');
    }
    

    public function index()
    {
        $library = auth()->user()->library;

        return view('library.index', compact('library'));
    }

    public function edit()
    {
    $library = auth()->user()->library;

    return view('library.edit', compact('library'));
    }

    public function update(UpdateLibraryRequest $request)
{
    $library = auth()->user()->library;

    $library->update($request->validated());

    return redirect()->route('library.dashboard')
        ->with('success', 'Library updated successfully');
}
}