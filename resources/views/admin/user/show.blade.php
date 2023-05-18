@extends('layouts.admin.master')
@section('title','Show A User')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 " style="padding-left: 100px">
                <h1>User Info</h1>
                <form>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputEmail4">Email</label>
                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email"
                                   value="{{  $user->email }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" placeholder="Name"
                                   value="{{ $user->name }}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="lastname">Last Name</label>
                            <input type="text" class="form-control" id="lastname" placeholder="Lastname"
                                   value="{{  $user->lastname }}" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone">Phone</label>
                            <input type="email" class="form-control" id="phone" placeholder="phone"
                                   value="{{  $user->phonenumber }}" readonly>
                        </div>
                    </div>
                    <div class="form-row">
                        <label for="national_code">National code</label>
                        <input type="text" class="form-control" id="national_code" placeholder="2591425"
                               value="{{  $user->national_code }}" readonly>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-4">
                            <label for="gender">Gender</label>
                            <select id="gender" class="form-control" readonly>
                                <option selected>{{ $user->gender }}</option>
                            </select>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
