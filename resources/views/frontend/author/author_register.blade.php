@extends('frontend.master')
@section('content')
<section class="login">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-8 m-auto">
                <div class="login-content">
                    <h4>Sign Up</h4>
                    <p></p>
                    <form  action="{{ route('author.insert.register') }}" class="sign-form widget-form " method="POST">
                        @if(session('add_author'))
                            <div class="alert alert-success">{{ session('add_author') }}</div>
                        @endif
                        @csrf
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Username*" name="name" value="">
                        </div>
                        @error('name')
                            <strong class='text-danger'>{{ $message }}</strong>
                        @enderror
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Email*" name="email" value="">
                        </div>
                        @error('email')
                        <strong class='text-danger'>{{ $message }}</strong>
                         @enderror
                        <div class="form-group">
                            <input type="password" class="form-control" placeholder="Password*" name="password" value="">
                        </div>
                        @error('password')
                        <strong class='text-danger'>{{ $message }}</strong>
                        @enderror
                        <div class="sign-controls form-group">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="rememberMe">
                                <label class="custom-control-label" for="rememberMe">Agree to our <a href="#" class="btn-link">terms & conditions</a> </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn-custom">Sign Up</button>
                        </div>
                        <p class="form-group text-center">Don't have an account? <a href="{{ route('author.login') }}" class="btn-link">Login </a> </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
