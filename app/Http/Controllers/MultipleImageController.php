<?php

namespace App\Http\Controllers;

use App\Models\MultipleImage;
use App\Http\Requests\StoreMultipleImageRequest;
use App\Http\Requests\UpdateMultipleImageRequest;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Carbon;
class MultipleImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $image = MultipleImage::all();
        return view('multiple.index',compact('image'));
    }
    public function store(Request $request){
        $produk_image = $request->file('produk_image');
        foreach ($produk_image as $multiple_image) {
            $random = hexdec(uniqid()).'.'.$multiple_image->getClientOriginalExtension();

            Image::make($multiple_image)->resize(300,300)->save('image/multiple/'.$random);
           $image_upload = 'image/multiple/'.$random;
           MultipleImage::insert([
               'image' => $image_upload,
               'created_at' => Carbon::now()
           ]);
        }
       
        return redirect()->back()->with('success', 'Berhasil');
    }

}
