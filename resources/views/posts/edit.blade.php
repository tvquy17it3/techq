@extends('layouts.appt')
@section('css')
<meta name="csrf_token" content="{{ csrf_token() }}" />
<link href="css\toastr.css" rel="stylesheet"/>
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Cập nhật bài viết</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('update_post', ['post' => $post->id]) }}">
                        {{ csrf_field() }}
                        <div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
                            <label for="title" class="col-md-3 control-label">Tiêu đề</label>
                            <div class="col-md-9">
                                <input id="title" type="text" class="form-control" name="title" value="{{ old('title', $post->title) }}" required autofocus>
                                @if ($errors->has('title'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('title') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                            <label for="body" class="col-md-3 control-label">Nội dung</label>
                            <div class="col-md-9">
                                <textarea name="body" id="body" cols="30" rows="8" class="form-control" required>{{ old('body', $post->body) }}</textarea>
                                @if ($errors->has('body'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('body') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9 col-md-offset-3">
                                <button type="submit" class="btn btn-success">
                                    Cập nhật
                                </button>
                                @can('post.publish')
                                <a href="{{ route('publish_post', ['post' => $post->id]) }}" class="btn btn-success">
                                    Xuất bản
                                </a>
                                @endcan
                                <a href="{{ route('list_posts') }}" class="btn btn-default">
                                    Hủy bỏ
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script src="js\toastr.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var check = "{{\Session::has('success')}}";
        if (check !="") {
            toastr["success"]("{!! \Session::get('success') !!}");
        }   
    })
</script>
@endsection