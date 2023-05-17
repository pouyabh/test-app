@extends('layouts.admin.master')
@section('title','Create A User')
@section('content')
    <div class="container">

        <div class="row">
            <div class="col-md-12 " style="padding-left: 120px">
                <form action="{{  route('admin.users.update',$user) }}" method="POST" enctype="multipart/form-data">
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
                        <label for="email">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com"
                               value="{{ $user->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="john"
                               value="{{ $user->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="lastname">Last Name</label>
                        <input type="text" class="form-control" id="lastname" name="lastname" placeholder="doe"
                               value="{{ $user->lastname }}" required>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password" name="password"
                               placeholder="mustbe8chars" >
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Repeat your Password</label>
                        <input type="password" class="form-control" id="password_confirmation"
                               name="password_confirmation"
                               placeholder="mustbe8chars">
                    </div>

                    <div class="form-group">
                        <label for="phonenumber">Phone</label>
                        <input type="number" class="form-control" id="phonenumber" name="phonenumber"
                               placeholder="09221452514" value="{{ $user->phonenumber }}" >
                    </div>

                    <div class="form-group">
                        <label for="national_code">National Code</label>
                        <input type="number" class="form-control" id="national_code" name="national_code"
                               value="{{  $user->national_code }}" placeholder="2283281425" required>
                    </div>

                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select class="form-control" id="gender" name="gender">
                            <option value="MALE" @if($user->gender == 'MALE') selected @endif>Male</option>
                            <option value="FEMALE" @if($user->gender == 'FEMALE') selected @endif>Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <div class="form-group">
                            <label><b>Please Select Image</b></label>
                            <input type="file" name="thumbnail" class="form-control">
                        </div>
                    </div>

                    @csrf
                    <button type="submit" class="btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>
@endsection
