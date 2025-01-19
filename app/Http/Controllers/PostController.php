<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::all();
        return view("post.index", compact("posts"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("post.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "title" => "required",
            "description" => "required",
            "category" => "required",
        ], [
            "title.required" => "Judul tidak boleh kosong",
            "description.required" => "Deskripsi tidak boleh kosong",
            "category.required" => "Kategori tidak boleh kosong",
        ]);

        $post = Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "category" => $request->category,
        ]);

        if ($post) {
            return redirect()->route("post.index")->with("success", "Data berhasil disimpan");
        }

        return redirect()->route("post.create")->with("error", "gagal menambahkan data post");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
