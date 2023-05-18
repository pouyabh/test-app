@extends('layouts.admin.master')
@section('title','Edit A Comment')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12 " style="padding-left: 120px">
                <form action="{{  route('admin.comments.update',$comment) }}" method="POST" enctype="multipart/form-data">
                    @method('PATCH')
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if(session()->has('message'))
                        <div class="alert alert-success">
                            {{ session()->get('message') }}
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="gender">Status</label>
                        <select class="form-control" id="gender" name="status">
                            <option value="ACTIVE" @if($comment->status == 'ACTIVE') selected @endif>Active</option>
                            <option value="INACTIVE" @if($comment->status == 'INACTIVE') selected @endif>Inactive</option>
                        </select>
                    </div>


                    @csrf
                    <button type="submit" class="btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
