<?php

namespace App\Builders;

use App\Models\Tag;

class TagBuilder
{
    protected $query;

    public function __construct()
    {
        $this->query = Tag::query();
    }

    public function where($column, $operator, $value)
    {
        $this->query->where($column, $operator, $value);
        return $this;
    }

    public function orderBy($column, $direction = "asc")
    {
        $this->query->orderBy($column, $direction);
        return $this;
    }

    public function get()
    {
        return $this->query->get();
    }

    public function create($data)
    {
        return Tag::create($data);
    }

    public function update($id, $data)
    {
        $tag = Tag::findOrFail($id);
        $tag->fill($data);
        $tag->save();
        return $tag;
    }

    public function delete($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();
    }
}
