<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Exceptions\InvalidRequestException;

class ProductsController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::where('on_sale', true);

        // 若 search 参数不为空，则进行模糊搜索
        if ($search = $request->search) {
            $like = '%' . $search . '%';
            $query->where(function ($query) use ($like) {
                $query->where('title', 'like', $like)
                    ->orWhere('description', 'like', $like)
                    ->orWhereHas('skus', function ($query) use ($like) {
                        $query->where('title', 'like', $like)
                            ->orWhere('description', 'like', $like);
                    });
            });
        }

        // 若 order 参数不为空，则进行排序
        if ($order = $request->order) {
            if (preg_match('/^(.+)_(asc|desc)$/', $order, $m)) {
                if (in_array($m[1], ['price', 'sold_count', 'rating'])) {
                    $query->orderBy($m[1], $m[2]);
                }
            }
        }

        $products = $query->paginate(16);
        // 保留过滤参数，传入到前端页面
        $filters = ['search' => $search, 'order' => $order];

        return view('products.index', compact('products', 'filters'));
    }

    public function show(Request $request, Product $product)
    {
        if ( ! $product->on_sale) {
            throw new InvalidRequestException('商品已下架');
        }

        $favored = false;
        if ($user = $request->user()) {
            $favored = boolval($user->favoriteProducts()->find($product->id));
        }
        return view('products.show', compact('product', 'favored'));
    }

    public function favor(Request $request, Product $product)
    {
        $user = $request->user();
        if ($user->favoriteProducts()->find($product->id)) {
            return [];
        }

        $user->favoriteProducts()->attach($product);

        return [];
    }

    public function disfavor(Request $request, Product $product)
    {
        $user = $request->user();
        $user->favoriteProducts()->detach($product);

        return [];
    }

    public function favorites(Request $request)
    {
        $products = $request->user()->favoriteProducts()->paginate(16);

        return view('products.favorites', compact('products'));
    }
}
