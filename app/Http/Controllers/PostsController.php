<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $post = Post::all();
        return view("post.index", [
            "post" => $post
        ]);
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
            "title" => "required|string",
            "description" => "required|string",
            "category" => "required|string",
        ], [
            "title.required" => "Judul Tidak Bole Kosong Bro!",
            "title.string" => "Judul harus berupa string",
            "description.required" => "Deskripsi Tidak Bole Kosong Bro!",
            "description.string" => "Deskripsi harus berupa string",
            "category.required" => "Kategori Tidak Bole Kosong Bro!",
            "category.string" => "Kategori harus berupa string",
        ]);

        $create_post = Post::create([
            "title" => $request->title,
            "description" => $request->description,
            "category" => $request->category,
        ]);

        if ($create_post) {
            session()->flash("sukses", "berhasil memasukan data baru ke database");
            return redirect()->route("post.index");
        }
        session()->flash("error", "terjadi kesalahan saat memasukan data");
        return redirect()->route("post.create");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $postinganId)
    {
        $post = Post::find($postinganId);
        return view("post.show", [
            "post" => $post
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // $post = Post::find($id);
        // return view("post.edit", [
        //     "post" => $post
        // ]);
        // $post = Post::find($id);
        //untuk hanya satu data
        $post = Post::where("id", "=", $id)->first();
        if (!$post) {
            session()->flash("error", "data tidak ditemukan");
            return redirect()->route("post.index");
        }
        return view("post.edit", [
            "post" => $post
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            session()->flash("error", "data tidak ditemukan");
            return redirect()->route("post.index");
        }

        $request->validate([
            "title" => "required|string",
            "description" => "required|string",
            "category" => "required|string",
        ], [
            "title.required" => "Judul Tidak Bole Kosong Bro!",
            "title.string" => "Judul harus berupa string",
            "description.required" => "Deskripsi Tidak Bole Kosong Bro!",
            "description.string" => "Deskripsi harus berupa string",
            "category.required" => "Kategori Tidak Bole Kosong Bro!",
            "category.string" => "Kategori harus berupa string",
        ]);

        $update_post = $post->update([
            "title" => $request->title,
            "description" => $request->description,
            "category" => $request->category,
        ]);

        if ($update_post) {
            session()->flash("sukses", "berhasil memperbarui data");
            return redirect()->route("post.index");
        }
        session()->flash("error", "terjadi kesalahan saat memperbarui data");
        return redirect()->route("post.edit", $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $post = Post::find($id);
        if (!$post) {
            return redirect()->route("post.index")->with('error', 'data tidak ditemukan');
        }

        $delete_post = $post->delete();

        if ($delete_post) {
            return redirect()->route('post.index')->with('sukses', 'data berhasil dihapus');
        }
        return redirect()->route('post.index')->with('error', 'data gagal dihapus');
    }
}
