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
                    <div class="card">
                        @if (session('success'))
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ session('success') }}</strong>
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                        <div class=" card-header">All Kategori </div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Created At</th>
                                </tr>
                            </thead>
                            <tbody>


                                
                                @foreach ($kategori as $ini)
                                    <tr>
                                        <th scope="row">{{ $kategori->firstItem()+$loop->index}}</th>
                                        <td>{{ $ini->kategori_nama }}</td>
                                        <td>{{ $ini->user_id }}</td>
                                        @if ($ini->created_at == null)
                                            <span class=" text-danger">Data Tidak Ditemukan</span>
                                        @else
                                            <td>{{ $ini->created_at->diffForHumans() }}</td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $kategori->links() }}
                    </div>
                </div>
                <div class=" col-md-4">
                    <div class=" card">
                        <div class=" card-header">Tambah Kategori</div>
                        <div class=" card-body">
                            <form action="{{ route('kategori-store') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Kategori</label>
                                    <input type="text" class="form-control" id="kategori_nama" name="kategori_nama"
                                        aria-describedby="emailHelp">
                                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.
                                    </div>
                                    @error('kategori_nama')
                                        <span class=" text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Tambah Kategori</button>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
