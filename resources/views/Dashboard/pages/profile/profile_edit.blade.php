@extends('Dashboard.Master.master_layout')
@section('title')
    Profile Edits - EatAnmol
@endsection
@section('content')
<div class="container p-5">
    <div class="container px-5">
        <div class="row justify-content-center">
            <div class="col-8 col-offset-2">
                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <div class="form-group text-start">
                        <label>Name</label>
                        <input class="form-control" placeholder="Enter your Name" type="text" name="name" value="{{  Auth::user()->name}}" required autofocus autocomplete="name">
                    </div>
                    <div class="form-group text-start">
                        <label>Email</label>
                        <input class="form-control" placeholder="Enter your email" type="email" name="email" value="{{ Auth::user()->email}}" required autocomplete="username">
                    </div>

                    <button type="submit" class="btn ripple btn-main-primary btn-block">Update Profile</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
