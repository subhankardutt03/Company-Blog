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
                    <div class="col-md-8 offset-md-2 ">
                            <div class="card">
                            <div class="card-header">
                                Edit Brand
                            </div>
                            <div class="card-body">
                                <form  method="post"  action="{{ url('update-brand/ '.$brands->id) }}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="old_image" value="{{ $brands->brand_image }}">
                                    <div class="form-group">
                                        <label for="categoryName">Brand Name</label>
                                        <input type="text" name="brand_name" class="form-control mt-1" value="{{ $brands->brand_name }}">
                                        @error('brand_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <br>
                                    <div class="form-group">    
                                        <label for="brandName">Brand Image</label>
                                        <input type="file" name="brand_image" class="form-control mt-1" vlaue="{{ $brands->brand_image }}">
                                        @error('brand_image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <img src="{{ asset($brands->brand_image) }}" alt="" style="height:200px;width:400px;">
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-success">Update Brand</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
        @endsection
{{-- </x-app-layout> --}}
