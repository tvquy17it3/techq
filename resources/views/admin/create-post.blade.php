@extends('layouts.admin')
@section('title', 'Post')
@section('css')
<link href="ad/css/toastr.css" rel="stylesheet" />
<link href="ad/css/customad.css" rel="stylesheet" />
<meta name="csrf_token" content="{{ csrf_token() }}" />

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">



@endsection
@section('content')
<!-- page content -->
<div class="content">
    <div class="page-title">
        <div class="title_left">
            <h3>Đăng bài mới<small></small></h3>
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <div class="x_title">
                    <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('store_post_ad') }}">
                        {{ csrf_field() }}
                        <div class="form-group{{$errors->has('title') ? ' has-error' : ''}}">
                            <label for="title" class="control-label">Tiêu đề</label>
                            <input id="title" type="text" class="form-control" name="title" value="{{ old('title') }}" required autofocus>
                            @if ($errors->has('title'))
                            <span class="help is-danger" style="color:red">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label for="title">Danh mục</label>
                            <select class="selectpicker form-control" data-live-search="true" name="category_id[]" required="">
                              @foreach($categories as $values)
                              <option data-tokens="{{$values->name}}" value="{{$values->id}}"
                                {{in_array($values->id, old("category_id") ?: []) ? "selected": ""}}
                                >{{$values->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="title">Thumbnail</label>
                            <div class="input-group">
                              <span class="input-group-btn">
                                <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary text-white">
                                  <i class="fa fa-picture-o"></i> Choose
                              </a>
                          </span>
                          <input id="thumbnail" class="form-control" type="text" name="thumbnail" value="{{ old('thumbnail') }}" readonly>
                      </div>
                      @if ($errors->has('thumbnail'))
                      <span class="help-block" style="color:red">
                        <strong>{{ $errors->first('thumbnail') }}</strong>
                    </span>
                    @endif
                    <div id="holder" style="margin-top:15px;max-height:100px;">
                        @if(old('thumbnail'))
                        <img src="{{ old('thumbnail') }}" style="height: 5rem;">
                        @endif
                    </div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Contents</label>
                    <textarea class="form-control" id="ckeditorContemt" rows="3" name="body">{{ old('body') }}</textarea>
                    @if ($errors->has('body'))
                    <span class="help-block" style="color:red">
                        <strong>{{ $errors->first('body') }}</strong>
                    </span>
                    @endif
                </div>

                <div class="form-group">
                    <div class="col-md-9 col-md-offset-3">
                        <button type="submit" class="btn btn-success">
                            Tạo bài viết mới
                        </button>
                        <a href="" class="btn btn-success">
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
<script src="ad/js/toastr.js"></script>
<script type="text/javascript" src="ad/js/dash/dashboad.js"> </script>

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

<script src="ckeditor/ckeditor.js"></script>
<script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>


<script type="text/javascript">

    var options = {
        filebrowserImageBrowseUrl: '/laravel-filemanager?type=Images',
        filebrowserImageUploadUrl: '/laravel-filemanager/upload?type=Images&_token={{csrf_token()}}',
        filebrowserBrowseUrl: '/laravel-filemanager?type=Files',
        filebrowserUploadUrl: '/laravel-filemanager/upload?type=Files&_token={{csrf_token()}}',
    };


    CKEDITOR.replace('ckeditorContemt', options);
    $('#lfm').filemanager('image');

</script>

<script>
    var lfm = function(id, type, options) {
      let button = document.getElementById(id);

      button.addEventListener('click', function () {
        var route_prefix = (options && options.prefix) ? options.prefix : '/filemanager';
        var target_input = document.getElementById(button.getAttribute('data-input'));
        var target_preview = document.getElementById(button.getAttribute('data-preview'));

        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = function (items) {
          var file_path = items.map(function (item) {
            return item.url;
        }).join(',');

          // set the value of the desired input to image url
          target_input.value = file_path;
          target_input.dispatchEvent(new Event('change'));

          // clear previous preview
          target_preview.innerHtml = '';

          // set or change the preview image src
          items.forEach(function (item) {
            let img = document.createElement('img')
            img.setAttribute('style', 'height: 5rem')
            img.setAttribute('src', item.thumb_url)
            target_preview.appendChild(img);
        });

          // trigger change event
          target_preview.dispatchEvent(new Event('change'));
      };
  });
  };


</script>

@endsection