<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Produk {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" container">
            <div class=" row">
              
                <div class=" col-md-8">
                    <div class=" card">
                        <div class=" card-header">Edit Produk</div>
                        <div class=" card-body">
                            <form action="{{ url('produk/update/'.$produk->id)}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_produk_image" id="old_produk_image" value="{{$produk->produk_image}}">
                                <div class="mb-3">
                                    <div class=" form-group">
                                        <label for="exampleInputEmail1" class="form-label">Update Nama Produk</label>
                                        <input type="text" class="form-control" id="produk_nama" name="produk_nama"
                                            aria-describedby="emailHelp" value="{{$produk->produk_nama}} ">
                                        @error('produk_nama')
                                            <span class=" text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class=" form-group">
                                        <label for="">Update Gambar Produk</label>
                                        <input type="file" name="produk_image" class=" form-control" value="{{$produk->produk_image}}">
                                        @error('produk_image')
                                            <span class=" text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class=" form-group">
                                        <img src="{{asset($produk->produk_image)}}" style="width: 400px; height:200px" alt="">
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">Update Produk</button>
                        </div>

                        
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
  
</x-app-layout>
