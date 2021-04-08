@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h3>Registration</h3>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-1">
                    <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                </div>
                @error('email')
                    <div class="text-danger mt-1 mb-1">
                        {{ $message }}
                    </div>
                @enderror
                <div class="mb-1">
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                </div>
                @error('password')
                    <div class="text-danger mt-1 mb-1">
                        {{ $message }}
                    </div>
                @enderror
                <div>
                    <button type="submit" class="btn btn-success btn-block">Login</button>
                </div>
            </form>
        </div>
    </div>
@endsection