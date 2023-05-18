@extends('layouts.admin.master')
@section('title','Show All activities')
@section('content')
    <div class="container">
        <div class="col-md-12 " style="padding-left: 100px">

        <h1>Log Activity Lists</h1>
        <div class="row">

                <table class="table table-bordered">
                    <tr>
                        <th>#</th>
                        <th>Subject</th>
                        <th>URL</th>
                        <th>Method</th>
                        <th>Ip</th>
                        <th width="300px">User Agent</th>
                        <th>User Id</th>
                    </tr>
                    @forelse($logs as  $log)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $log->subject }}</td>
                            <td class="text-success">{{ $log->url }}</td>
                            <td><label class="label label-info">{{ $log->method }}</label></td>
                            <td class="text-warning">{{ $log->ip }}</td>
                            <td class="text-danger">{{ $log->agent }}</td>
                            <td>{{ $log->admin_id }}</td>
                        </tr>
                    @empty
                        <p>Empty</p>
                    @endforelse
                </table>
            </div>
        </div>
@endsection
