<div>
    <div class="page-title">
        <div class="title_left">
            <h3>Bài đăng chưa được duyệt!<small></small></h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input class="form-control" wire:model="search" type="text" placeholder="Search users..." />
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                </div>
            </div>
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
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Category</th>
                                            <th>Created at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($posts as $values)
                                        <tr>
                                            <td>{{$values->id}}</td>
                                            <td>{{$values->title}}</td>
                                            <td>
                                                @if(!is_null($values->author))
                                                    {{$values->author->name ." | ". $values->author->email}}
                                                @endif

                                                
                                            </td>
                                            <td>{{$values->categories->name}}</td> 
                                            <td>{{$values->created_at}}</td>
                                        </td>
                                        <td>
                                            <button type="button" class="btn btn-primary btn-sm" wire:click="edit({{ $values->id }})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                                            <button type="button" wire:click.prevent="confirmPostRemoved({{ $values->id}},'{{$values->title }}')" class="btn btn-danger btn-sm"><i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div style="float: right;">
                {!! $posts->links() !!}
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                Xoá bài viết
            </div>
            <div class="modal-body">
                <p>Bạn muốn xoá bài viết: <b><i class="title">{{$title}}</i></b>, bài viết sẽ không được phục hồi</p>
                <p>Bạn có muốn tiếp tục! <i class="dataid"></i></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="button" wire:click.prevent="deletePost" class="btn btn-danger">Delete</button>
            </div>
        </div>
    </div>
</div>


</div>
