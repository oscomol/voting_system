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

            <p class="login-box-msg">Register a new account here</p>

            <form action="{{route('register-student')}}" method="post">
                @csrf
                @method('post')
                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Full name" name="name">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="Phone number" name="phone">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-phone"></span>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-3">
                    <input type="number" class="form-control" placeholder="ID number" name="lrn">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-book"></span>
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
                <div class="input-group mb-3">
                    <input type="password" class="form-control" placeholder="Confirm password" name="password_confirmation" id="confirmPassword">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="userType" value="student">
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block btn btn-sm">Sign In</button>
                    </div>
                </div>
                @if ($errors->any())
                <div class="error">
                    <p class="text-danger">
                        @foreach ($errors->all() as $error)
                            {{ $error }}<br>
                        @endforeach
                    </p>
                </div>
                 @endif
            </form>
            
            <p class="mb-0 text-center mt-3">
                <a href="{{url('/')}}" class="text-center">Already have an account ? Back to login</a>
            </p>
        </div>

    </div>
</div>    
@endsection

