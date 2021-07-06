<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
        {{-- <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"> --}}
            {{-- <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-jet-welcome />
            </div> --}}
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ">
                        @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ Session::get('success') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            @endif
                        <div class="card">
                            <div class="card-header">
                                All Categories
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SL.NO</th>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Category Name</th>
                                    <th>Created At</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // $i=1;
                                @endphp
                                @foreach ($categories as $item)
                                    <tr>
                                        <td>{{ $categories->firstItem()+$loop->index }}</td>
                                        <td>{{ $item->id }}</td>
                                        {{-- join(Eloquent ORM) --}}
                                        <td>{{ $item->user->name }}</td>
                                        {{-- join(Query Builder) --}}
                                        {{-- <td>{{ $item->name }}</td> --}}
                                        <td>{{ $item->category_name }}</td>
                                        <td>
                                        @if ($item->created_at == NULL)
                                            <span class ="text-danger">No Date Set</span>
                                        @else
                                        {{ carbon\carbon::parse($item->created_at)->diffForHumans() }}
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('edit-category/'.$item->id ) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ url('softDelete-category/ '.$item->id) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                </tr>   
                                @endforeach
                            </tbody>
                        </table>
                            {{ $categories->links() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Add Category
                            </div>
                            <div class="card-body">
                                {{-- @if (Session::has('categoryInserted'))
                            <div class="alert alert-success" role="alert">
                                {{ Session::get('categoryInserted') }}
                            </div>
                        @endif --}}
                                <form  method="post"  action="{{ route('add.category') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="categoryName">Category Name</label>
                                        <input type="text" name="category_name" class="form-control mt-1">
                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-success">Add category</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        {{-- </div> --}}

        {{-- Trash Category --}}

        <div class="container">
                <div class="row">
                    <div class="col-md-8 ">
                        <div class="card">
                            <div class="card-header">
                                Trash Categories
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SL.NO</th>
                                    <th>ID</th>
                                    <th>User ID</th>
                                    <th>Category Name</th>
                                    <th>Created At</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // $i=1;
                                @endphp
                                @foreach ($trashCategory as $item)
                                    <tr>
                                        <td>{{ $trashCategory->firstItem()+$loop->index }}</td>
                                        <td>{{ $item->id }}</td>
                                        {{-- join(Eloquent ORM) --}}
                                        <td>{{ $item->user->name }}</td>
                                        {{-- join(Query Builder) --}}
                                        {{-- <td>{{ $item->name }}</td> --}}
                                        <td>{{ $item->category_name }}</td>
                                        <td>
                                        @if ($item->created_at == NULL)
                                            <span class ="text-danger">No Date Set</span>
                                        @else
                                        {{ carbon\carbon::parse($item->created_at)->diffForHumans() }}
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('restore-category/ '.$item->id ) }}" class="btn btn-info">Restore</a>
                                            <a href="{{ url('delete-category/ '.$item->id) }}" class="btn btn-danger">Delete</a>
                                        </td>
                                </tr>   
                                @endforeach
                            </tbody>
                        </table>
                            {{ $trashCategory->links() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">

                    </div>
                </div>
            </div>
    </div>
</x-app-layout>
