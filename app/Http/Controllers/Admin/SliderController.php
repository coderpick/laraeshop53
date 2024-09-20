<?php

namespace App\Http\Controllers\Admin;

use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $sliders = Slider::get();
        return view('admin.slider.index', compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|string|max:255',
            'sub_title' => 'nullable|string|max:255',
            'url' => 'required|url|max:255',
            'status' => 'required',
            'image' => 'required|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        try {

            $file_path = $this->uploadMedia($request);

            Slider::create([
                'title' => $request->title,
                'sub_title' => $request->sub_title,
                'image' => $file_path,
                'url' => $request->url,
                'status' => $request->status,
            ]);
            notyf()->success('Slider created successfully.');

            return redirect()->route('admin.slider.index');
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
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

        if ($request->hasFile('image')) {
            $imgDriver = new ImageManager(new Driver());
            $image = $imgDriver->read($request->file('image'));
            $image->cover(1980, 630);
            $image->toWebp();
            $imageName = time() . rand(0000, 9999) . '.webp';
            if (isset($brand->image) && File::exists(public_path($brand->image))) {
                unlink($brand->image);
            }
            $image->save('uploads/slider/' . $imageName);
            return 'uploads/slider/' . $imageName;
        }
    }
}
