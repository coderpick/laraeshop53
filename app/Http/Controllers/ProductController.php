<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    public function products()
    {


        $data['products'] = Product::select('id', 'brand_id', 'name', 'slug', 'price', 'discount', 'discount_price', 'status')->with('brand:id,name')
            ->with(array('productImages' => function ($query) {
                $query->limit(2);
            }))
            ->latest()
            ->where('status', true)
            ->paginate(12);
        return view('frontend.shop', $data);
    }


    public function productDetail($slug)
    {
        $product = Product::with('brand:id,name', 'productImages')->where('slug', $slug)->first();

        if (!$product) {
            abort(404);
        }

        $relatedProducts = Product::select('id', 'brand_id', 'category_id', 'name', 'slug', 'price', 'discount', 'discount_price', 'status')->with('brand:id,name', 'productImages')
            ->where('status', true)
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->get();

        $product->increment('view_count');

        return view('frontend.product_detail', compact('product', 'relatedProducts'));
    }

    public function brandProduct($slug)
    {

        $brand = Brand::where('slug', $slug)->first();

        $products = Product::select('id', 'brand_id', 'category_id', 'name', 'slug', 'price', 'discount', 'discount_price', 'status')->with('brand:id,name', 'productImages')
            ->where('status', true)
            ->where('brand_id',  $brand->id)

            ->paginate(12);

        return view('frontend.shop', compact('products'));
    }
    public function categoryProduct($category = null, $subCategory = null)
    {

        if (isset($subCategory)) {
            $data['products'] = Category::where('slug', $category)->first()->subCategories->where('slug', $subCategory)->first()->products()->active()->paginate(12);
        } elseif (isset($category)) {
            $data['products'] = Category::where('slug', $category)->first()->products()->active()->paginate(12);
        }
        if (!$data['products']) {
            abort(404);
        }

        // $data['topRatedProducts'] = Product::withCount('orders')->orderBy('orders_count', 'DESC')->active()->paginate(12);
        return view('frontend.shop', $data);
    }
}
