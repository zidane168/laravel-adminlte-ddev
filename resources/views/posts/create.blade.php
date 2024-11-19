@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Post</h1>
    <form action="{{ route('posts.store') }}" method="POST">
        @csrf
       
        <div class="form-group">
            <label for="locale">Locale</label>
            <input type="text" name="locale" class="form-control" id="locale" required>
        </div>
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" name="title" class="form-control" id="title" required>
        </div>
        <div class="form-group">
            <label for="content">Content</label>
            <textarea name="content" class="form-control" id="content" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
@endsection
