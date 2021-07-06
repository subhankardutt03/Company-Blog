@extends('admin.admin_master')
    @section('admin')
         <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-10 offset-1 ">
                        @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ Session::get('success') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">X</button>
                                    </div>
                            @endif
                            <div class="col-md-12">
                                        <div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h2>Edit About</h2>
										</div>
										<div class="card-body">
                                            <form method="post" action="{{ url('update/about/ '.$about->id) }}" enctype="multipart/form-data">
                                                @csrf
												<div class="form-group">
													<label for="exampleFormControlInput1">About Title</label>
                                                    <input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="About Title"
                                                    value="{{ $about->title }}">
												</div>
												<div class="form-group">
													<label for="exampleFormControlTextarea1">Short Description</label>
													<textarea class="form-control" id="exampleFormControlTextarea1" name="short_desc" rows="3">{{ $about->short_desc }}</textarea>
												</div>
													<div class="form-group">
													<label for="exampleFormControlTextarea1">Long Description</label>
													<textarea class="form-control" id="exampleFormControlTextarea1" name="long_desc" rows="3">{{ $about->long_desc }}</textarea>
												</div>
												<div class="form-footer pt-4 pt-5 mt-4 border-top">
													<button type="submit" class="btn btn-primary btn-default w-25">Submit</button>
												</div>
											</form>
										</div>
									</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    @endsection
