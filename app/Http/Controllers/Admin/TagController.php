<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTagRequest;
use App\Http\Requests\Admin\UpdateTagRequest;
use App\Models\Tag;
use App\Services\Admin\TagService;
use Illuminate\Http\Request;

class TagController extends Controller
{
    protected $service;

    public function __construct(TagService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        $tags = Tag::latest()->get();
        return view('admin.tags.index', compact('tags'));
    }

    public function create()
    {
        return view('admin.tags.create');
    }

    public function store(StoreTagRequest $request)
    {
        $this->service->create($request->validated());

        return redirect()->route('admin.tags.index')->with('success', 'Tag created');
    }

    public function edit(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function update(UpdateTagRequest $request, Tag $tag)
    {
        $this->service->update($tag, $request->validated());

        return redirect()->route('admin.tags.index')->with('success', 'Tag updated');
    }

    public function destroy(Tag $tag)
    {
        $this->service->delete($tag);

        return back()->with('success', 'Tag deleted');
    }
}
