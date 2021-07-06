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
											<h2>Edit Contact</h2>
										</div>
										<div class="card-body">
                                            <form method="POST" action="{{ url('update/contact/ '.$contacts->id) }}" enctype="multipart/form-data">
                                                @csrf
                                                    <div class="form-group">
													<label for="exampleFormControlTextarea1">Contact Address</label>
													<textarea class="form-control" id="exampleFormControlTextarea1" name="address" rows="3">{{ $contacts->address }}</textarea>
												</div>
												<div class="form-group">
													<label for="exampleFormControlInput1">Contact Email</label>
													<input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="Contact Email"
                                                    value="{{ $contacts->email }}">
												</div>
												<div class="form-group">
													<label for="exampleFormControlFile1">Mobile Number</label>
													<input type="text" class="form-control" id="exampleFormControlFile1" name="phone" value="{{ $contacts->phone }}">
												</div>
												<div class="form-footer pt-3 mt-2">
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
