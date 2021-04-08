@extends('layouts.app')

@section('content')
    <div class="row">
        @auth
            <form method="POST" action='{{ route('posts.update', $post) }}'>
                @csrf
                <div class="mb-2">
                    <input type="text" name="title" value="{{$post->title}}" class="form-control" placeholder="Enter title here..." />
                </div>
                @error('title')
                    <div class="text-danger mt-1 mb-1">
                        {{ $message }}
                    </div>
                @enderror
                <div class="mb-2">
                    <textarea class="form-control" name="body" placeholder="Write something here">{{$post->body}}</textarea>
                </div>
                @error('body')
                    <div class="text-danger mt-1 mb-1">
                        {{ $message }}
                    </div>
                @enderror
                <div class="mb-2">
                    <button type="submit" class="btn btn-primary">Update Post</button>
                </div>
            </form>
        @endauth
    </div>
@endsection