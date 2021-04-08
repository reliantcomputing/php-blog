@extends('layouts.app')

@section('content')
    <div class="row">
        @auth
            <form method="POST" action='{{ route('posts.store') }}'>
                @csrf
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
        @foreach ($posts as $post)
            <div class="col-md-7 mb-3">
                <div class="card">
                    <div class="card-body">
                    <h6 class="card-subtitle mb-2 text-muted">{{ $post->user->username }}</h6>
                    <h5 class="card-title">{{ $post->title }}</h5>
                    <p class="card-text">{{ $post->body }}</p>
                    <div class="row">
                        <a href="{{ route('posts.edit', $post) }}" class="card-link">Edit</a>
                        <form action="" method="post">
                            <a href="#" class="card-link">Delete</a>
                        </form>
                    </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection