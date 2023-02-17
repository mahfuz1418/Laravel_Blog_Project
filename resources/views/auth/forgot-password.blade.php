@extends('auth.layouts.guest')
@section('content')
    <div class="container">
        <div class="row " style="height: 600px">
            <div class="col-md-8 mx-auto my-auto ">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('password.email') }}" method="post">
                            @csrf
                            <h5 class="card-title"></h5>
                            <div class="mb-4 text-sm text-gray-600">
                                <p>Forgot your password? No problem. Just let us know your email address and we will email
                                    you a password reset link that will allow you to choose a new one.</p>
                            </div>
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    <h4 class="alert-heading">{{ session('status') }}</h4>

                                </div>
                            @endif
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input name="email" type="email" class="form-control"
                                    id="exampleInputEmail1" placeholder="Email" value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button class="btn btn-dark mr-2 mb-2 mb-md-0 text-white">Email Password Reset Link</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection








