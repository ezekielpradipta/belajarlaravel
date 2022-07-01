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
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class=" card-header">All Produk </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Nama Produk</th>
                                    <th scope="col">Gambar Produk</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($produk as $ini)
                                    <tr>
                                        <th scope="row">{{ $produk->firstItem() + $loop->index }}</th>
                                        <td>{{ $ini->produk_nama }}</td>
                                        <td><img src="{{asset($ini->produk_image)}} " style="height: 40px; widht:40px" alt=""></td>
                                        @if ($ini->created_at == null)
                                            <span class=" text-danger">Data Tidak Ditemukan</span>
                                        @else
                                            <td>{{ $ini->created_at->diffForHumans() }}</td>
                                        @endif
                                        <td> <a href="{{ url('produk/edit/' . $ini->id) }} "
                                                class=" btn btn-info">Edit</a> <a
                                                href="{{ url('produk/delete/' . $ini->id) }}"
                                                class=" btn btn-danger">Delete</a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $produk->links() }}
                    </div>
                </div>
                <div class=" col-md-4">
                    <div class=" card">
                        <div class=" card-header">Tambah Produk</div>
                        <div class=" card-body">
                            <form action="{{ route('produk-store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <div class=" form-group">
                                        <label for="exampleInputEmail1" class="form-label">Nama Produk</label>
                                        <input type="text" class="form-control" id="produk_nama" name="produk_nama"
                                            aria-describedby="emailHelp">
                                        @error('produk_nama')
                                            <span class=" text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class=" form-group">
                                        <label for="">Gambar Produk</label>
                                        <input type="file" name="produk_image" class=" form-control">
                                        @error('produk_image')
                                            <span class=" text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                </div>

                                <button type="submit" class="btn btn-primary">Tambah Produk</button>
                        </div>

                        
                        </form>
                    </div>

                </div>
            </div>
        </div>

    </div>
  
</x-app-layout>
