<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Models\ProductImage;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands = Brand::get();
        $categories = Category::get();
        return view('admin.product.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {
        // return $request;
        $proudct =  Product::create([
            'category_id' => $request->category,
            'sub_category_id' => $request->subCategory,
            'brand_id' => $request->brand,
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'discount_price' => $request->discount_price,
            'quantity' => $request->quantity,
            'is_featured' => $request->is_featured,
            'status' => $request->is_featured,
        ]);



        notyf()->success('Product created successfully.');
        return redirect()->route('admin.product.index');
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


    protected function uploadMedia($request, $brand = null)
    {

        if ($request->hasFile('images')) {
            $imgDriver = new ImageManager(new Driver());
            $image = $imgDriver->read($request->file('images'));
            $image->cover(300, 280);
            $image->toWebp();
            $imageName = time() . rand(0000, 9999) . '.webp';
            if (isset($brand->image) && File::exists(public_path($brand->image))) {
                unlink($brand->image);
            }
            $image->save('uploads/product/' . $imageName);
            return 'uploads/product/' . $imageName;
        }
    }
}
