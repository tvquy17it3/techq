@extends('layouts.appt')

@section('content')
<div class="container">
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-4">
            <h2>{{ $post->title }}</h2>
            <p>{{ Str::limit($post->body, 100) }}</p>
            <p><a class="btn btn-default" href="{{ route('show_post', ['id' => $post->id]) }}" role="button">Chi tiết »</a></p>
        </div>
        @endforeach
    </div>
</div>
@endsection