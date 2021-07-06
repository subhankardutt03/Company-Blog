 @extends('admin.admin_master')
    @section('admin')
    <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 ">
                        @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ Session::get('success') }}</strong>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                    </div>
                            @endif
                            <div>
                                <h2>Profile Image</h2>
                            </div>
                            <div class="card-group">
                                @foreach ($images as $item)
                                    <div class="col-md-4 mt-3">
                                        <div class="card m-2">
                                            <img src="{{ asset($item->image) }}" alt="" style="margin:10px;">

                                        </div>

                                    </div>
                                @endforeach
                            </div>
                    </div>

                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Add Multi Images
                            </div>
                            <div class="card-body">
                                <form  method="post"  action="{{ route('add.images') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group">
                                        <label for="brandName">Multi Image</label>
                                        <input type="file" name="image[]" class="form-control mt-1" multiple="">
                                        @error('image')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-success">Add Multi Image</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    @endsection

