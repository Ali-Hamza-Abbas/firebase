@extends('firebase.app')

@section('content')
 <div class="container">
     <div class="row">
         <div class="col-md-12">

            @if (session('status'))
                <h4 class="alert alert-success">{{ session('status') }}</h4>
            @endif

            @if (session('error'))
                <h4 class="alert alert-danger">{{ session('error') }}</h4>
            @endif

            <div class="card">
                <div class="card-header">
                    <h4> Contacts List - Total : <u>{{ $total }}</u>
                        <a href="{{ Url('add-contacts') }}" class="btn btn-sm btn-primary float-end" >Add Contacts</a>
                    </h4>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $i=1; @endphp
                            @forelse ($contacts as $key => $item)
                            <tr>
                                <td>{{ $i++ }}</td>
                                <td>{{ $item['fname']}}</td>
                                <td>{{ $item['lname']}}</td>
                                <td>{{ $item['phone']}}</td>
                                <td>{{ $item['email']}}</td>
                                <td><a href="{{url('edit-contact/'.$key)}}" class="btn btn-sm btn-success">Edit</td>
                                <td><a href="{{url('delete-contact/'.$key)}}" class="btn btn-sm btn-danger">Delete</td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="7">No Record Found</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
         </div>
     </div>
 </div>
@endsection
