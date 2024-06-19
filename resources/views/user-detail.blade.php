@extends('layouts.admin')
@section('title')
    detail user
@endsection
@section('navbar')
@endsection

@section('content')
    <h1>
        detail user
    </h1>




    <div class="mt-5 d-flex justify-content-end">

        @if ($user->status == 'in active')
            <a href="/user-approve/{{ $user->slug }}" class="btn bg-info">Approve User</a>
        @endif


    </div>




    <div class="mt-5">
        @if (Session('status'))
            <div class="alert alert-success">
                {{ Session('status') }}
            </div>
        @endif

    </div>

    <div class="my-3 w-25">
        <div class="mb-3">
            <label for="" class="form-label"> Username</label>
            <input type="text" class="form-control" readonly value="{{ $user->username }}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Email</label>
            <input type="text" class="form-control" readonly value="{{ $user->email }}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Phone</label>
            <input type="text" class="form-control" readonly value="{{ $user->phone }}">
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Phone</label>
            <textarea name="" id="" cols="30" rows="10" style="resize:none;" readonly
                class="form-control">{{ $user->addres }}</textarea>
        </div>
        <div class="mb-3">
            <label for="" class="form-label">Status</label>
            <input type="text" class="form-control" readonly value="{{ $user->status }}">
        </div>

    </div>
@endsection
