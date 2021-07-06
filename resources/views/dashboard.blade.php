<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{-- {{ __('Dashboard') }} --}}
            Hi... <b> {{ Auth::user()->name }} </b>
            <b style="float: right;"> Total Users
                <span class="badge  badge-danger" style="background-color:red"> {{ count($users) }} </span>
            </b>
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div> --}}
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-md-1">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SL.NO</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($users as $item)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                    <td>{{ $item->id }}</td>
                                    <td>{{  $item->name }}</td>
                                    <td>{{ $item->email  }}</td>
                                    {{-- <td>{{ $item->created_at->diffForHumans() }}</td> --}}
                                    <td>{{ carbon\carbon::parse($item->created_at)->diffForHumans() }}</td>
                                </tr>
                                @endforeach
                            
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
