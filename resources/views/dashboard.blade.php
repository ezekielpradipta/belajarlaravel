<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Hiiii {{Auth::user()->name}}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class=" container">
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
                    @php($i=1)
                        
                   
                    @foreach ($users as $user)
                    <tr>
                        <th scope="row">{{$i++}}</th>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>{{$user->created_at->diffForHumans()}}</td>
                    </tr>  
                    @endforeach
                    
                   
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
