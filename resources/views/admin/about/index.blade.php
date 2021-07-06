 @extends('admin.admin_master')
    @section('admin')
         <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2>Home About</h2>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('add.about') }}"><button class="btn btn-success w-50">Add About</button></a>
                                </div>
                            </div>
                        </div>
                        <br>
                        @if (Session::has('success'))
                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        <strong>{{ Session::get('success') }}</strong>
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">X</button>
                                    </div>
                            @endif

                        <br>
                        <div class="card">
                            <div class="card-header">
                                All About
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SL.NO</th>
                                    <th width="10%">Title</th>
                                    <th width="20%">Short Description</th>
                                    <th width="30%">Long Description</th>
                                    <th width="15%"> Created At</th>
                                    <th width="20%" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($about as $about)
                                    <tr class="text-center">
                                        <td>{{ $i++  }}</td>
                                        <td>{{ $about->title }}</td>
                                        <td class="text-left">{{ $about->short_desc }}</td>
                                        <td class="text-left">{{ $about->long_desc }}</td>
                                        <td>
                                        @if ($about->created_at == NULL)
                                            <span class ="text-danger">No Date Set</span>
                                        @else
                                        {{ $about->created_at->diffForHumans() }}
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('edit/about/'.$about->id ) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ url('delete/about/ '.$about->id) }}" onclick="return confirm('Are You Want to Delete ??')" class="btn btn-danger">Delete</a>
                                        </td>
                                </tr>   
                                @endforeach
                            </tbody>
                        </table>
                            {{-- {{ $sliders->links() }} --}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    @endsection