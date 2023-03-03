<?php

namespace App\Http\Controllers;
// use App\Http\Controllers\TagBuilder;
use Illuminate\Http\Request;
use App\Builders\TagBuilder;
use App\Models\Tag;

class TagController extends Controller
{
    public function index()
    {
        // $tags = (new TagBuilder())->get();

        // return view("tags.index", [
        //     "tags" => $tags,
        // ]);

        $tags = (new TagBuilder())->get();
        return view("editor.tags.index", compact("tags"));
    }

    public function create()
    {
        return view("editor.tags.create");
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string|max:255",
            "status" => "required|string|max:255",
        ]);

        try {
            (new TagBuilder())->create($data);
        } catch (\Exception $e) {
            return redirect()
                ->route("editor/page-404")
                ->with("errorMessage", "Error storing tags data");
        }

        return redirect()
            ->route("tags.index")
            ->with("success", "Tag created successfully.");
    }

    public function destroy($id)
    {
        (new TagBuilder())->delete($id);

        return redirect()
            ->route("tags.index")
            ->with("message", "Tag Delete Successfully");
    }

    public function edit($id)
    {
        $tag = (new TagBuilder())
            ->where("id", "=", $id)
            ->get()
            ->first();

        return view("editor.tags.edit", compact("tag"));
    }

    public function update(Request $request, $id)
    {
        $tagData = $request->validate([
            "name" => "required|max:255",
        ]);

        $tag = (new TagBuilder())->update($id, $tagData);

        return redirect()
            ->route("tags.index")
            ->with("message", "Tag Updated Successfully");
    }
}
