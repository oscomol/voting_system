@extends('layout.auth')

@section('title')
    Voting-System | Login
@endsection

@section('content')
<div class="login-box">

    <div class="login-logo">
        <a href="../../index2.html"><b>CR</b>SYSTEM</a>
    </div>
    <div class="card">
        <div class="card-body login-card-body">

            <p class="login-box-msg">Sign in as admin</p>

            <form action="{{route('login')}}" method="post">
                @csrf
                @method('post')
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Enter username" name="lrn">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Password" name="password">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block btn btn-sm">Sign In</button>
                    </div>

                </div>
            </form>
            @if (session('error'))
            <div class="error">
                <p class="text-danger">
                   Invalid username or password
                </p>
            </div>
             @endif
            <p class="mb-0 text-center mt-3">
                <a href="{{url('/register')}}" class="text-center">Register a new membership</a>
            </p>
        </div>

    </div>
</div>    
@endsection

