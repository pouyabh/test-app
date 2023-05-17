@extends('layouts.admin.master')

@section('title','Admin Panel')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 " style="padding-left: 100px">
                <a href="{{  route('admin.users.create') }}" class="btn-outline-info float-right m-2 p-2">Create</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First Name</th>
                        <th scope="col">Last Name</th>
                        <th scope="col">Phone Number</th>
                        <th scope="col">National Code</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Image</th>
                        <th scope="col">Email</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <a href="{{ route('admin.users.show',$user) }}">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td>{{ $user->lastname }}</td>
                            <td>{{ $user->phonenumber }}</td>
                            <td>{{ $user->national_code }}</td>
                            <td>{{ $user->gender }}</td>
                            <td>
                                <img src="{{ asset('storage/' . $user->image_path) }}" alt="" class="img-thumbnail">
                            </td>
                            <td>{{ $user->email }}</td>
                            <td><a href="{{ route('admin.users.edit',$user) }}" class="text-info">Edit</a></td>
                            <td>
                                <form action="{{ route('admin.users.destroy',$user) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button class="btn btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>

            </div>
        </div>
    </div>
@endsection
