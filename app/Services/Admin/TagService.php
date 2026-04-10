<?php

namespace App\Services\Admin;

use App\Models\Tag;

class TagService
{
    public function create(array $data)
    {
        return Tag::create($data);
    }

    public function update(Tag $tag, array $data)
    {
        $tag->update($data);
    }

    public function delete(Tag $tag)
    {
        $tag->delete();
    }
}