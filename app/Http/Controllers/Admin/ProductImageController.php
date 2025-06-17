<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductImageRequest;
use App\Http\Requests\UpdateProductImageRequest;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\ImageManager;
use Illuminate\Support\Str;

class ProductImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ProductImage::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProductImageRequest $request,$id)
    {

        $baseImageData = [
            'product_id' => $id
        ];
        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:products,id'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product.index')
                ->withErrors($validator)
                ->withInput();
        }

        $uploadedPaths = collect();

      
        foreach ($request->file('images') as $image) {
            $imageManager = ImageManager::gd()->read($image);

            $uuid = Str::uuid()->toString();

            $extension = $image->getClientOriginalExtension();
            $originalName = $image->getClientOriginalName();

            $fileName = $uuid . '.' . $extension;

            $largePath = $image->storeAs('/product_images/large', $fileName, 'public');

            $previewImage = $imageManager->resize(400, 400, function ($c) {

                $c->aspectRatio();
                $c->upsize();
            });

            $previewPath = 'product_images/preview/' . $uuid . '.jpg';
            Storage::disk('public')->put($previewPath, $previewImage->encodeByExtension('jpg', 80));


            $thumbNailImage = $imageManager->cover(150, 150);
            $thumbnailPath = 'product_images/thumbnail/' . $uuid . '.jpg';

            Storage::disk('public')->put($thumbnailPath, $thumbNailImage->encodeByExtension('jpg', 80));

            $uploadedImage = array_merge($baseImageData, [

                'original_name' => $originalName,
                'large' => $largePath,
                'preview' => $previewPath,
                'thumbnail' => $thumbnailPath

            ]);

            $uploadedPaths->push($uploadedImage);
        }



       $productImages = $uploadedPaths->map(function  ($path)  {
            return ProductImage::create(
                [
                    'product_id'    => $path['product_id'],
                    'original_name' => $path['original_name'],
                    'large'         => $path['large'],
                    'preview'       => $path['preview'],
                    'thumbnail'     => $path['thumbnail']
                ]
            );
        });

        return response()->json(['productImages' => $productImages]);

        // return redirect()->route('manage-image.edit', ['product' => $request->product_id]);
    }


    /**
     * Display the specified resource.
     */
    public function show(ProductImage $productImage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:products'
        ]);

        if ($validator->fails()) {
            return redirect()->route('product.index')
                ->withErrors($validator)
                ->withInput();
        }

        $product = Product::with('productImages')->find($id);


        return view('admin.product.product-image.upload',['product' => $product]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProductImageRequest $request, $id)
    {

   }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $validator =  Validator::make(['id' => $id], [
            'id' => 'required|numeric|exists:product_images,id',

        ]);

        if ($validator->fails()) {
            return redirect()->route('product.index')
                ->withErrors($validator)
                ->withInput();
        }



        $productImage = ProductImage::find($id);
        $product = Product::find($productImage->product_id);

        $productImageLargeStart = strpos($productImage->large,'product_images');
        $productImagePrevieweStart = strpos($productImage->preview,'product_images');
        $productImageThumbnailStart = strpos($productImage->thumbnail,'product_images');

       $productImageLarge =  substr($productImage->large, $productImageLargeStart);
       $productImagePreview =  substr($productImage->preview, $productImagePrevieweStart);
       $productImageThumbnail  =  substr($productImage->thumbnail, $productImageThumbnailStart);




        Storage::disk('public')->delete($productImageLarge);
        Storage::disk('public')->delete( $productImagePreview );
        Storage::disk('public')->delete( $productImageThumbnail );
        $productImage->delete();


        return redirect()->route('manage-image.edit', ['id' => $product->id]);
    }
}
