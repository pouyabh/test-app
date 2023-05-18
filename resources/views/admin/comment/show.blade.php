@php use Carbon\Carbon; @endphp
@extends('layouts.admin.master')
@section('title','Show A Comment')
@section('content')

    <section style="background-color: #eee;">
        <div class="container my-5 py-5">

            <div class="row d-flex justify-content-center">
                <div class="col-md-12 col-lg-10 col-xl-8">
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

                    <form action="{{ route('admin.comments.reply',$comment) }}" method="POST">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-start align-items-center">
                                    <img class="rounded-circle shadow-1-strong me-3"
                                         src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar"
                                         width="60"
                                         height="60"/>
                                    <div>
                                        <h6 class="fw-bold text-primary mb-1">{{ $comment->user->name ?? null }}</h6>
                                        <p class="text-muted small mb-0">
                                            Shared publicly - {{ $comment->created_at->diffForHumans() }}
                                        </p>
                                    </div>
                                </div>

                                <p class="mt-3 mb-4 pb-2">
                                    {!! $comment->text !!}
                                </p>
                            </div>

                            @forelse($comment->replies as $reply)
                                <div>
                                    <div class="card-body ">
                                        <div class="d-flex flex-start align-items-center ">
                                            <img class="rounded-circle shadow-1-strong me-3 "
                                                 src="https://cdn-icons-png.flaticon.com/512/149/149071.png"
                                                 alt="avatar"
                                                 width="60"
                                                 height="60"/>
                                            <div>
                                                <h6 class="fw-bold text-primary mb-1 ">{{ $reply->admin->name ?? null  }}</h6>
                                                <p class="text-muted small mb-0">
                                                    Shared publicly - {{ $reply->created_at->diffForHumans() }}
                                                </p>
                                            </div>
                                        </div>

                                        <p class="mt-3 mb-4 pb-2">
                                            {!! $reply->text !!}
                                        </p>
                                    </div>
                                </div>
                            @empty
                                <p>Empty</p>
                            @endforelse

                            <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
                                <div class="d-flex flex-start w-100">
                                    <img class="rounded-circle shadow-1-strong me-3"
                                         src="https://cdn-icons-png.flaticon.com/512/149/149071.png" alt="avatar"
                                         width="40"
                                         height="40"/>
                                    <div class="form-outline w-100">
                <textarea class="form-control" id="text" name="text" rows="4"
                          style="background: #fff;"></textarea>
                                        <label class="form-label" for="text">Message</label>
                                    </div>
                                </div>
                                <div class="float-end mt-2 pt-1">
                                    <button type="submit" class="btn btn-primary btn-sm">Reply comment</button>
                                </div>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </section>
@endsection
