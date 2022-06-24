<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Kategori {{ Auth::user()->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" container">
            <div class=" row">
                <div class=" col-md-8">
                    <div class=" card">
                        <div class=" card-header">Edit Kategori</div>
                        <div class=" card-body">
                            <form action="{{url('kategori/update/'.$kategori->id)}} " method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Update  Kategori</label>
                                    <input type="text" class="form-control" id="kategori_nama" name="kategori_nama"
                                        aria-describedby="emailHelp" value="{{$kategori->kategori_nama}}">
                                   
                                    </div>
                                    @error('kategori_nama')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Update Kategori</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
