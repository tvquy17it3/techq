@extends('layouts.admin')
@section('title', 'TEST')
@section('css')
<link href="ad\css\toastr.css" rel="stylesheet" />
<link href="ad\css\customad.css" rel="stylesheet" />
<meta name="csrf_token" content="{{ csrf_token() }}" />
@endsection
@section('content')
<!-- page content -->
<div class="content">
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h1>Posts Management</h1>
            </div>
            <div class="pull-right">
            @can('post.create')
                <a class="btn btn-success" href="{{ route('role-create') }}"> Create Post</a>
            @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
    @endif

    <div>
        <table class="table" style="margin-top: 50px;">
            <thead class="thead-dark">
                <tr>
                  <th scope="col">#ID</th>
                  <th scope="col">Title</th>
                  <th scope="col">Email</th>
                  <th scope="col">Author</th>
                  <th scope="col">Categories</th>
                  <th scope="col">Created_at</th>
                  <th scope="col">Updated_at</th>
              </tr>
            </thead>
            <tbody id="contents">
            </tbody>
        </table>
        <div id="load_more"></div>
    </div>
</div>

@endsection
@section('scripts')
<script src="ad/js/toastr.js"></script>
<script type="text/javascript" src="ad/js/dash/dashboad.js"> </script>
<script>
  toastr.options = {
    "newestOnTop": true,
    "progressBar": true,
    "onclick": null,
  }

  load_more();

  function load_more(id = '') {
    $.ajax({
      type: 'POST',
      url: "{{route('load_more_posts')}}",
      headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf_token"]').attr('content')
      },
      data: {
          id: id,
      },
      success: function (data) {
          $("#contents").append(data.list_posts);
          $("#load_more").html(data.load_more);
      },
      error: function (data) {
          console.log(data);
      }
  });
  }
    

  $(document).ready(function() {
      $(document).on("click","#btn_load_more",function() {
          var id = $(this).data('id');
          load_more(id);
      });
  });


</script>
@endsection