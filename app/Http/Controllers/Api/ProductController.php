<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequst;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request  $request)
    {
        $query = Product::query();

        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->search . '%')
                    ->orWhere('sku', 'like', '%' . $request->search . '%');
            });
        }

        return ProductResource::collection(
            $query->paginate(10)
        );
    }

    public function store(StoreProductRequst $request)
    {
        $this->authorize('create', Product::class);

        $product = Product::create($request->validated());

        return response()->json($product, 201);
    }
    public function destroy(int $id)
    {
        $post = Product::findOrFail($id);

        $this->authorize('delete', $post);

        $post->delete();

        return response()->json([
            'message' => 'Post berhasil dihapus'
        ]);
    }
}
