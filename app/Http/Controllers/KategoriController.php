<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use App\Http\Requests\StoreKategoriRequest;
use App\Http\Requests\UpdateKategoriRequest;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kategori = Kategori::paginate(5);
        $trash = Kategori::onlyTrashed()->latest()->paginate(3);
       return view('kategori', compact('kategori','trash'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreKategoriRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $validate = $request->validate([
        'kategori_nama' => 'required|unique:kategoris',
       ], [
        'kategori_nama.required' => 'Nama Kategori Tidak Boleh Kosong'
       ]
    );
    Kategori::insert([
        'kategori_nama'=> $request->kategori_nama,
        'user_id' => Auth::user()->id,
        'created_at' => Carbon::now()
    ]);

    return redirect()->back()->with('success','Berhasil');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Kategori  $kategori
     * @return \Illuminate\Http\Response
     */
   public function edit($id){
    $kategori = Kategori::find($id);
    return view('kategori-edit',compact('kategori'));
   }

   public function update(Request $request, $id){
        $update = Kategori::find($id)->update([
            'kategori_nama' => $request->kategori_nama,
            'user_id' => Auth::user()->id
        ]);
        return redirect()->route('kategori-all')->with('success','Berhasil');
   }
   public function softdelete($id){
    $delete = Kategori::find($id)->delete();
    return redirect()->back()->with('success','Berhasil Dihapus');
   }

   public function restore($id){
    $restore = Kategori::withTrashed()->find($id)->restore();
    return redirect()->back()->with('success','Berhasil Direstore');
   }
   public function permadelete($id){
    $delete = Kategori::onlyTrashed()->find($id)->forceDelete();
    return redirect()->back()->with('success','Berhasil Dihapus Selamanya');
   }
}
