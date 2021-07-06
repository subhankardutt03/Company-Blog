 @extends('admin.admin_master')
    @section('admin')
         <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2>Contact Profile</h2>
                                </div>
                                <div class="col-md-6 text-right">
                                    <a href="{{ route('add.contact') }}"><button class="btn btn-success w-50">Add Contact</button></a>
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
                                All Contact
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SL.NO</th>
                                    <th width="30%">Contact Address</th>
                                    <th width="12%">Contact Email</th>
                                    <th width="10%">Mobile</th>
                                    <th width="15%"> Created At</th>
                                    <th width="25%" colspan="2">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($contacts as $contact)
                                    <tr class="text-center">
                                        <td>{{ $i++  }}</td>
                                        <td>{{ $contact->address }}</td>
                                        <td class="text-left">{{ $contact->email }}</td>
                                        <td class="text-left">{{ $contact->phone }}</td>
                                        <td>
                                        @if ($contact->created_at == NULL)
                                            <span class ="text-danger">No Date Set</span>
                                        @else
                                        {{ $contact->created_at->diffForHumans() }}
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('edit/contact/'.$contact->id ) }}" class="btn btn-info">Edit</a>
                                            <a href="{{ url('delete/contact/ '.$contact->id) }}" onclick="return confirm('Are You Want to Delete ??')" class="btn btn-danger ml-2">Delete</a>
                                        </td>
                                </tr>   
                                @endforeach
                            </tbody>
                        </table>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
    </div>
    @endsection