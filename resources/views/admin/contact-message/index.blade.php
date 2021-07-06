 @extends('admin.admin_master')
    @section('admin')
         <div class="py-12">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 ">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-6">
                                    <h2>Contact Message Details</h2>
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
                                All Contact Message
                            </div>
                            <div class="card-body">
                                <table class="table table-hover">
                            <thead>
                                <tr class="text-center">
                                    <th width="5%">SL.NO</th>
                                    <th width="15%">Name</th>
                                    <th width="10%">Email</th>
                                    <th width="15%">Subject</th>
                                    <th width="25%">Message</th>
                                    <th width="15%"> Created At</th>
                                    <th width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i=1;
                                @endphp
                                @foreach ($contactMessage as $message)
                                    <tr class="text-center">
                                        <td>{{ $i++  }}</td>
                                        <td>{{ $message->name }}</td>
                                        <td class="text-left">{{ $message->email }}</td>
                                        <td class="text-left">{{ $message->subject }}</td>
                                          <td class="text-left">{{ $message->message }}</td>
                                        <td>
                                        @if ($message->created_at == NULL)
                                            <span class ="text-danger">No Date Set</span>
                                        @else
                                        {{ $message->created_at->diffForHumans() }}
                                        @endif
                                        </td>
                                        <td>
                                            <a href="{{ url('delete/contactMessage/ '.$message->id) }}" onclick="return confirm('Are You Want to Delete ??')" class="btn btn-danger ml-2">Delete</a>
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