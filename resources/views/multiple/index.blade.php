<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Multiple Image {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" container">
            <div class=" row">
                <div class=" col-md-8">



                    <div class=" card-group">
                        @foreach ($image as $multi)
                            <div class=" col-md-4 mt-5">
                                <div class=" card">
                                    <img src="{{ asset($multi->image) }} " alt="">
                                </div>
                            </div>
                        @endforeach
                    </div>


                </div>
                <div class=" col-md-4">
                    <div class=" card">
                        <div class=" card-header">Tambah Multiple Image</div>
                        <div class=" card-body">
                            <form action="{{ route('multiple-store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">

                                    <div class=" form-group">
                                        <label for="">Multiple Image</label>
                                        <input type="file" name="produk_image[]" class=" form-control"
                                            multiple="">
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
