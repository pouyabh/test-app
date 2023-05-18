@extends('layouts.admin.master')
@section('title','Comments')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 " style="padding-left: 100px">
                <a href="{{  route('admin.users.create') }}" class="btn-outline-info float-right m-2 p-2">Create</a>
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Text</th>
                        <th scope="col">Admin </th>
                        <th scope="col">User </th>
                        <th scope="col">Status</th>
                        <th scope="col">Parent ID</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($comments as $comment)
                        <tr>
                            <th scope="row">{{ $loop->iteration }}</th>
                            <td>
                                <a href="{{ route('admin.comments.show',$comment) }}">
                                    {{ $comment->text }}
                                </a>
                            </td>
                            <td>{{ $comment->admin->name ?? null }}</td>
                            <td>{{ $comment->user->name ?? null }}</td>
                            <td>{{ $comment->status }}</td>
                            <td>{{ $comment->parent_id }}</td>
                            <td><a href="{{ route('admin.comments.edit',$comment) }}" class="text-info">Change Status</a></td>
                            <td>
                                <form action="{{ route('admin.comments.destroy',$comment) }}" method="POST">
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
