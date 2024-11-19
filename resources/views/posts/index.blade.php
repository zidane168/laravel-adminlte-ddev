@extends('layouts.app')

<ul>
    @foreach (config('app.locales') as $locale)
    <li>
        <a href="{{ route('setLocale', $locale) }}">
            {{ strtoupper($locale) }}
        </a>
    </li>
    @endforeach
</ul>


@section('content')
<div class="container">
    <ul>
        <li>
            <a href="{{ route('setLocale', 'en') }}">
                English - {{ config('app.locales')[0]   }}
            </a>
        </li>
        <li>
            <a href="{{ route('setLocale', 'zh') }}">
                Chinese - {{ config('app.locales')[1]   }}
            </a>
        </li>
    </ul>

    <h1>{{ __('post.welcome') }} </h1>
    <a href="{{ route('posts.create') }}" class="btn btn-primary">
        <h1>{{ __('post.create') }} </h1>
    </a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
            <tr>
                <td>{{ $post->getTranslation(app()->getLocale())->title ?? 'No translation' }}</td>
                <td>
                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-warning">Edit</a>
                    <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection