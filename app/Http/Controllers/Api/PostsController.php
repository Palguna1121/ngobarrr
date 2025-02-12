<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\Cache\Store;
use App\Http\Requests\StorePostsRequest;
use App\Http\Requests\UpdatePostsRequest;
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

    public function store(StorePostsRequest $request)
    {
        try {
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

    public function update(UpdatePostsRequest $request, string $id)
    {
        try {
            $post = Post::find($id);

            if (!$post) {
                return response()->json([
                    "code" => 404,
                    "success" => false,
                    "message" => "Data post tidak ditemukan!"
                ], 404);
            }

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
