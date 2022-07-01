<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Http\Requests\StoreProdukRequest;
use App\Http\Requests\UpdateProdukRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;
class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produk::latest()->paginate(5);
        return view('produk.index', compact('produk'));
    }

    public function store(Request $request)
    { 
        $validate = $request->validate(
            [
                'produk_nama' => 'required|unique:produks',
                'produk_image' => 'required|mimes:png,jpg'
            ],
            [
                'produk_nama.required' => 'Nama Produk Tidak Boleh Kosong'
            ]
        );

         $produk_image = $request->file('produk_image');
         $random = hexdec(uniqid()).'.'.$produk_image->getClientOriginalExtension();

         Image::make($produk_image)->resize(300,200)->save('image/produk/'.$random);
        // $image_extension = strtolower($produk_image->getClientOriginalExtension());
        // $image_nama = $random . '.' . $image_extension;
        // $image_location = 'image/produk/';

        // $image_upload = $image_location . $image_nama;
        // $produk_image->move($image_location, $image_upload);
        
        $image_upload = 'image/produk/'.$random;
        Produk::insert([
            'produk_nama' => $request->produk_nama,
            'produk_image' => $image_upload,
            'created_at' => Carbon::now()
        ]);
        return redirect()->back()->with('success', 'Berhasil');
    }

    public function edit($id)
    {
        $produk = Produk::find($id);
        return view('produk.edit', compact('produk'));
    }
    public function update(Request $request, $id)
    {
        $validate = $request->validate(
            [
                'produk_nama' => 'required',
            ],
            [
                'produk_nama.required' => 'Nama Produk Tidak Boleh Kosong'
            ]
        );
        $old_produk_image = $request->old_produk_image;

        $produk_image = $request->file('produk_image');
        if ($produk_image) {

            $random = hexdec(uniqid());
            $image_extension = strtolower($produk_image->getClientOriginalExtension());
            $image_nama = $random . '.' . $image_extension;
            $image_location = 'image/produk/';

            $image_upload = $image_location . $image_nama;
            $produk_image->move($image_location, $image_upload);
            unlink($old_produk_image);
            Produk::find($id)->update([
                'produk_nama' => $request->produk_nama,
                'produk_image' => $image_upload,
                'created_at' => Carbon::now()
            ]);
        } else {
            Produk::find($id)->update([
                'produk_nama' => $request->produk_nama,

                'created_at' => Carbon::now()
            ]);
        }
        return redirect()->route('produk-all')->with('success', 'Berhasil Update');
    }

    public function delete($id){
        $image = Produk::find($id);
        $old_image = $image->produk_image;
        unlink($old_image);
        Produk::find($id)->delete();
        return redirect()->back()->with('success','Berhasil Dihapus');
    }
}
