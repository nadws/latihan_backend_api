<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request  $request)
    {
        $query = Post::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                    ->orWhere('content', 'like', '%' . $request->search . '%');
            });
        }

        return PostResource::collection(
            $query->paginate(10)
        );
    }


    public function store(StorePostRequest $request)
    {
        $this->authorize('create', Post::class);

        $post = Post::create($request->validated());

        return response()->json($post, 201);
    }

    public function destroy(int $id)
    {
        $post = Post::findOrFail($id);

        $this->authorize('delete', $post);

        $post->delete();

        return response()->json([
            'message' => 'Post berhasil dihapus'
        ]);
    }
}
