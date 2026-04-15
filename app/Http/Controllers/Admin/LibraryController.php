<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLibraryRequest;
use App\Models\Library;
use App\Models\User;
use App\Services\Admin\LibraryService;
use Illuminate\Http\Request;

class LibraryController extends Controller
{

    protected $service;

    public function __construct(LibraryService $service)
    {
        $this->service = $service;
    }
    public function index()
    {
        $libraries = Library::with('user')->get();
        return view('admin.libraries.index', compact('libraries'));
    }

    public function create()
    {
        $users = User::whereRelation('role','name','user')->get();
        return view('admin.libraries.create', compact('users'));
    }

    public function store(StoreLibraryRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.libraries.index')
            ->with('success', 'Library created successfully');
    }

    public function approve(Library $library)
    {
        $this->service->approve($library);

        return back()->with('success', 'Library approved');
    }

    public function block(Library $library)
    {
        $this->service->block($library);

        return back()->with('success', 'Library blocked');
    }

    public function destroy(Library $library)
    {
        $this->service->delete($library);

        return back()->with('success', 'Library deleted');
    }
}
