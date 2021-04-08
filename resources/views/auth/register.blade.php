@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-4">
            <h3>Registration</h3>
            <form method="POST" action="#">
                @csrf
                <div class="mb-1">
                    <input type="text" class="form-control" placeholder="Name" name="name" value="{{ old('name') }}"/>
                </div class="mb-1">
                <div class="mb-1">
                    <input type="text" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}"/>
                </div class="mb-1">
                <div class="mb-1">
                    <input type="password" class="form-control" placeholder="Password" name="password"/>
                </div class="mb-1">
                <div class="mb-1">
                    <input type="password" class="form-control" placeholder="Re-enter password" name="password_confirmation"/>
                </div>
                <div>
                    <button type="submit" class="btn btn-success btn-block">Register</button>
                </div>
            </form>
        </div>
    </div>
@endsection