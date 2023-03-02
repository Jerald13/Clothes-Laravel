<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product_images;
class ImageController extends Controller
{
    //
    // public function upload(Request $request)
    // {
    //     // Validate the uploaded files
    //     $validatedData = $request->validate([
    //         "images.*" => "required|image|mimes:jpeg,png,jpg,gif|max:2048",
    //     ]);

    //     // Loop through the uploaded files and save them as Blob data in the database
    //     foreach ($request->file("images") as $file) {
    //         $image = new Product_images();
    //         $image->name = $file->getClientOriginalName();
    //         $image->data = file_get_contents($file);
    //         $image->mime = $file->getClientMimeType();
    //         $image->save();
    //     }

    //     return redirect()
    //         ->back()
    //         ->with("success", "Images uploaded successfully.");
    // }

    public function uploadApi(Request $request)
    {
        //single image
        // if ($request->has("image")) {
        //     $image = $request->image;
        //     $name = time() . "." . $image->getClientOriginalExtension();
        //     $path = public_path("upload");
        //     $image->move($path, $name);
        //     return response()->json(
        //         [
        //             "data" => "",
        //             "message" => "Image upload successfully.",
        //             "status" => true,
        //         ],
        //         200
        //     );
        // }

        //Multiple Image
        // if ($request->has("image")) {
        //     $image = $request->image;
        //     foreach ($image as $key => $value) {
        //         $name =
        //             time() . $key . "." . $value->getClientOriginalExtension();

        //         $path = public_path("upload");
        //         $value->move($path, $name);
        //     }

        //     return response()->json(
        //         [
        //             "data" => "",
        //             "message" => "Image upload successfully.",
        //             "status" => true,
        //         ],
        //         200
        //     );
        // }

        //Multiple image from API to database
        $validatedData = $request->validate([
            "images.*" => "required|image|mimes:jpeg,png,jpg,gif|max:20000",
        ]);

        $images = $request->file("images");
        $imageData = [];

        foreach ($images as $image) {
            $imageData[] = [
                "name" => $image->getClientOriginalName(),
                "data" => file_get_contents($image),
                "mime" => $image->getClientMimeType(),
            ];
        }

        Product_images::insert($imageData);

        try {
            // Insert the image data into the database
            Product_images::insert($imageData);
        } catch (\Illuminate\Database\QueryException $e) {
            // handle the exception, log the error, or return a custom error response
            return response()->json(
                [
                    "error" =>
                        "An error occurred while running a database query.",
                ],
                500
            );
        }

        return redirect()
            ->back()
            ->with("success", "Images uploaded successfully.");
    }

    public function upload(Request $request)
    {
        $validatedData = $request->validate([
            "images.*" => "required|image|mimes:jpeg,png,jpg,gif|max:20000",
        ]);

        $images = $request->file("images");
        $imageData = [];

        foreach ($images as $image) {
            $imageData[] = [
                "name" => $image->getClientOriginalName(),
                "data" => file_get_contents($image),
                "mime" => $image->getClientMimeType(),
            ];
        }
        Product_images::insert($imageData);
        try {
        } catch (\Illuminate\Database\QueryException $e) {
            // handle the exception, log the error, or return a custom error response
            return response()->json(
                [
                    "error" =>
                        "An error occurred while running a database query.",
                ],
                500
            );
        }

        return redirect()
            ->back()
            ->with("success", "Images uploaded successfully.");
    }
}
