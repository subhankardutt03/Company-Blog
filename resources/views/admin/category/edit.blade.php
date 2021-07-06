<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('All Categories') }}
        </h2>
    </x-slot>

    <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2 ">
                            <div class="card">
                            <div class="card-header">
                                Edit Category
                            </div>
                            <div class="card-body">
                                <form  method="post"  action="{{ url('update-category/ ') . $categories->id }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="categoryName">Category Name</label>
                                        <input type="text" name="category_name" class="form-control mt-1" value="{{ $categories->category_name }}">
                                        @error('category_name')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-success">Update category</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

    </div>
</x-app-layout>
