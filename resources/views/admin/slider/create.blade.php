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
											<h2>Basic Form Controls</h2>
										</div>
										<div class="card-body">
                                            <form method="post" action="{{ route('store.slider') }}" enctype="multipart/form-data">
                                                @csrf
												<div class="form-group">
													<label for="exampleFormControlInput1">Slider Title</label>
													<input type="text" class="form-control" id="exampleFormControlInput1" name="title" placeholder="Slider Title">
												</div>
												<div class="form-group">
													<label for="exampleFormControlTextarea1">Slider Description</label>
													<textarea class="form-control" id="exampleFormControlTextarea1" name="description" rows="3"></textarea>
												</div>
												<div class="form-group">
													<label for="exampleFormControlFile1">Slider Image</label>
													<input type="file" class="form-control-file" id="exampleFormControlFile1" name="image">
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
