<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostsRequest;
use Dotenv\Exception\ValidationException;

class PostsController extends Controller
{
    public function index()
    {
        try {
            $posts = Post::all();
            return response()->json([
                "code" => 200,
                "data" => $posts,
                "success" => true,
                "message" => "Success mengambil seluruh data post!"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "code" => 500,
                "data" => null,
                "success" => false,
                "message" => "Terjadi kesalahan saat mengambil seluruh data post!"
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                "title" => "required|string|max:20|min:5",
                "description" => "required|string",
                "category" => "required|string",
            ], [
                "title.required" => "Judul Tidak Bole Kosong Bro!😊",
                "title.string" => "Judul harus berupa string",
                "title.min" => "Judul minimal 5 karakter!😊",
                "title.max" => "Judul maksimal 20 karakter!😊",
                "description.required" => "Deskripsi Tidak Bole Kosong Bro!😊",
                "description.string" => "Deskripsi harus berupa string",
                "category.required" => "Kategori Tidak Bole Kosong Bro!😊",
                "category.string" => "Kategori harus berupa string",
            ]);
            Post::create([
                "title" => $request->title,
                "description" => $request->description,
                "category" => $request->category,
            ]);
            return response()->json([
                "code" => 201,
                "success" => true,
                "message" => "Berhasil Menambahkan Data Post!"
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                "code" => 500,
                "success" => false,
                "message" => "Terjadi kesalahan saat menambahkan data post: " . $e->getMessage(),
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                return response()->json([
                    "code" => 404,
                    "data" => null,
                    "success" => false,
                    "message" => "Data post tidak ditemukan!"
                ], 404);
            }
            return response()->json([
                "code" => 200,
                "data" => $post,
                "success" => true,
                "message" => "Success mengambil data post!"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "code" => 500,
                "data" => null,
                "success" => false,
                "message" => "Terjadi kesalahan saat mengambil seluruh data post!" . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                return response()->json([
                    "code" => 404,
                    "data" => null,
                    "success" => false,
                    "message" => "Data post tidak ditemukan!"
                ], 404);
            }
            $request->validate([
                "title" => "required|string|max:20|min:5",
                "description" => "required|string",
                "category" => "required|string",
            ], [
                "title.required" => "Judul Tidak Bole Kosong Bro!😊",
                "title.string" => "Judul harus berupa string",
                "title.min" => "Judul minimal 5 karakter!😊",
                "title.max" => "Judul maksimal 20 karakter!😊",
                "description.required" => "Deskripsi Tidak Bole Kosong Bro!😊",
                "description.string" => "Deskripsi harus berupa string",
                "category.required" => "Kategori Tidak Bole Kosong Bro!😊",
                "category.string" => "Kategori harus berupa string",
            ]);
            $post->update([
                "title" => $request->title,
                "description" => $request->description,
                "category" => $request->category,
            ]);
            return response()->json([
                "code" => 200,
                "success" => true,
                "message" => "Berhasil Memperbarui Data Post!"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "code" => 500,
                "success" => false,
                "message" => "Terjadi kesalahan saat memperbarui data post: " . $e->getMessage(),
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $post = Post::find($id);
            if (!$post) {
                return response()->json([
                    "code" => 404,
                    "data" => null,
                    "success" => false,
                    "message" => "Data post tidak ditemukan!"
                ], 404);
            }
            $post->delete();
            return response()->json([
                "code" => 200,
                "success" => true,
                "message" => "Berhasil Menghapus Data Post!"
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                "code" => 500,
                "success" => false,
                "message" => "Terjadi kesalahan saat menghapus data post: " . $e->getMessage(),
            ], 500);
        }
    }
}
