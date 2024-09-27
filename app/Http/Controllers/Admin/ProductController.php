<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Models\ProductImage;
use App\Models\SubCategory;
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
        $products = Product::withTrashed()->select('id', 'category_id', 'sub_category_id', 'brand_id', 'name', 'price', 'discount', 'discount_price', 'quantity', 'is_featured', 'status', 'deleted_at')
            ->with('category', 'subCategory', 'brand:id,name')
            ->orderBy('id', 'DESC')->get();
        return view('admin.product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $brands     = Brand::get();
        $categories = Category::get();
        return view('admin.product.create', compact('brands', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProductStoreRequest $request)
    {

        if ($request->discount) {
            $discountPrice = $request->price - ($request->price * $request->discount) / 100;
        };

        $product =  Product::create([
            'category_id' => $request->category,
            'sub_category_id' => $request->subCategory,
            'brand_id' => $request->brand,
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount ?? null,
            'discount_price' => $discountPrice ?? null,
            'quantity' => $request->quantity,
            'is_featured' => $request->is_featured,
            'status' => $request->is_featured,
        ]);

        $imageData = [];

        if ($files = $request->file('images')) {

            foreach ($files as $key => $file) {

                $imgDriver = new ImageManager(new Driver());
                $image = $imgDriver->read($file);
                $image->cover(540, 560);
                $image->toWebp();
                $imageName = 'product_' . time() . rand(0000, 9999) . '.webp';
                $path = 'uploads/product/' . $imageName;
                $image->save($path);
                $imageData[] = [
                    'product_id' => $product->id,
                    'image' => $path,
                ];
            }
        }

        ProductImage::insert($imageData);

        notyf()->success('Product created successfully.');
        return redirect()->route('admin.product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $product =Product::with('category', 'subCategory', 'brand:id,name','productImages')->withTrashed()->findOrFail($id);
       return view('admin.product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product    = Product::with('productImages')->withTrashed()->findOrFail($id);
        $brands     = Brand::get();
        $categories = Category::get();
        $subCategories = SubCategory::where('category_id', $product->category_id)->get();
        return view('admin.product.edit', compact('brands', 'categories', 'product', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ProductUpdateRequest $request, string $id)
    {
        $product = Product::withTrashed()->findOrFail($id);

        if ($request->discount) {
            $discountPrice = $request->price - ($request->price * $request->discount) / 100;
        };

        $product->update([
            'category_id' => $request->category,
            'sub_category_id' => $request->subCategory,
            'brand_id' => $request->brand,
            'name' => $request->name,
            'slug' => $request->slug,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount ?? null,
            'discount_price' => $discountPrice ?? null,
            'quantity' => $request->quantity,
            'is_featured' => $request->is_featured,
            'status' => $request->is_featured,
        ]);



        $imageData = [];

        if ($files = $request->file('images')) {

            foreach ($files as $key => $file) {

                $imgDriver = new ImageManager(new Driver());
                $image = $imgDriver->read($file);
                $image->cover(540, 560);
                $image->toWebp();
                $imageName = 'product_' . time() . rand(0000, 9999) . '.webp';
                $path = 'uploads/product/' . $imageName;
                $image->save($path);
                $imageData[] = [
                    'product_id' => $product->id,
                    'image' => $path,
                ];
            }
        }

        if ($files = $request->file('images')) {
            $productImages = ProductImage::where('product_id', $product->id)->get();
            foreach ($productImages as $key => $value) {
                if (!in_array($value->image, $files)) {
                    if (File::exists(public_path($value->image))) {
                        File::delete(public_path($value->image));
                    }
                    $value->delete();
                }
            }
        }
        /* insert new images */
        ProductImage::insert($imageData);

        notyf()->success('Product update successfully.');
        return redirect()->route('admin.product.index');
    }

    public function trash(string $id)
    {

        $product = Product::findOrFail($id);

        $product->delete();

        notyf()->success('Product trashed successfully.');
        return redirect()->route('admin.product.index');
    }

    public function restore(string $id)
    {

        $product = Product::withTrashed()->findOrFail($id);

        $product->restore();

        notyf()->success('Product restored successfully.');
        return redirect()->route('admin.product.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::with('productImages')->withTrashed()->findOrFail($id);

        if (count($product->productImages) > 0) {

            foreach ($product->productImages as $key => $value) {
                if (File::exists(public_path($value->image))) {
                    File::delete(public_path($value->image));
                }
            }
        }


        $product->forceDelete();

        notyf()->success('Product deleted successfully.');
        return redirect()->route('admin.product.index');
    }
}
