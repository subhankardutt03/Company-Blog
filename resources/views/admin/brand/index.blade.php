{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Brands') }}
        </h2>
    </x-slot> --}}

    @extends('admin.admin_master')
    @section('admin')
         <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ">
                        @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ Session::get('success') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">X</button>
                                    </div>
                            @endif
                        <div class="card">
                            <div class="card-header">
                                All Brands
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>SL.NO</th>
                                    <th>ID</th>
                                    <th>Brand Name</th>
                                    <th>Brand Image</th>
                                    <th>Created At</th>
                                    <th colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    // $i=1;
                                @endphp
                                @foreach ($brands as $item)
                                    <tr>
                                        <td>{{ $brands->firstItem()+$loop->index  }}</td>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->brand_name }}</td>
                                        <td><img src="{{ asset($item->brand_image) }}" style="height:40px;width:70px;"></td>
                                        <td>
                                        @if ($item->created_at == NULL)
                                            <span class ="text-danger">No Date Set</span>
                                        @else
                                        {{ $item->created_at->diffForHumans() }}
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('edit-brand/'.$item->id ) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ url('delete-brand/ '.$item->id) }}" onclick="return confirm('Are You Want to Delete ??')" class="btn btn-danger">Delete</a>
                                        </td>
                                </tr>   
                                @endforeach
                            </tbody>
                        </table>
                            {{ $brands->links() }}
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Add Brand
                            </div>
                            <div class="card-body">
                                <form  method="post"  action="{{ route('add.brand') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="brandName">Brand Name</label>
                                        <input type="text" name="brand_name" class="form-control mt-1 mb-2">
                                        @error('brand_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="brandName">Brand Image</label>
                                        <input type="file" name="brand_image" class="form-control mt-1">
                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-success">Add Brand</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endsection
   
{{-- </x-app-layout> --}}
