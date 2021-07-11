@extends('layouts.appt')
@section('content')
<div class="container">
    <div class="row">
        @foreach($posts as $post)
        <div class="col-md-4">
            <h2>{{ $post->title }}</h2>
            <p>{{ $post->id }}</p>
            <p>{{ Str::limit($post->body, 100) }}</p>
            <p>
                <a class="btn btn-success" href="{{route('edit_post',$post->id)}}" role="button">Chỉnh sửa</a>
                @can('post.publish')
                    <a class="btn btn-success" href="{{ route('publish_post',$post->id) }}" role="button">Xuất bản</a>
                @endcan
            </p>
        </div>
        @endforeach
    </div>
    {{$posts->links()}}
</div>
@endsection
