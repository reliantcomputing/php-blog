@extends('layouts.app')

@section('content')
    <div class="row">
        @auth
            <form method="POST" action='#'>
                <div class="mb-2">
                    <input type="text" name="title" class="form-control" placeholder="Enter title here..." />
                </div>
                @error('title')
                    <div class="text-danger mt-1 mb-1">
                        {{ $message }}
                    </div>
                @enderror
                <div class="mb-2">
                    <textarea class="form-control" name="body" placeholder="Write something here"></textarea>
                </div>
                @error('body')
                    <div class="text-danger mt-1 mb-1">
                        {{ $message }}
                    </div>
                @enderror
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary">Create Post</button>
                </div>
            </form>
        @endauth
        <h3 class="mt-2 mb-2">Posts</h3>
        <div class="col-md-6">
            Posts
        </div>
    </div>
@endsection