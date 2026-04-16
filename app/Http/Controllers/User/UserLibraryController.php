<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\StoreLibraryRequest;
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

        return redirect()->route('home') //to change to dashboard
            ->with('success', 'Library created successfully');
    }
    

    public function index()
    {
        $library = auth()->user()->library;

        return view('library.index', compact('library'));
    }

}