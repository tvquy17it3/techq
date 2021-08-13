<div>
    <div class="page-title">
        <div class="title_left">
            <h3>Manage<small> User</small></h3>
        </div>
        <div class="title_right">
            <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                <div class="input-group">
                    <input class="form-control" wire:model.debounce.500ms="search" type="text" placeholder="Search users..." />
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
                        <li>
                            <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                    </ul>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card-box table-responsive">
                                <div class="col-md-12" style="margin-bottom: 20px;">
                                    <div class="col-md-2">
                                        <div class="d-flex align-items-center ml-4">
                                            <label for="paginate" class="text-nowrap mr-2 mb-0">Hiển thị</label>
                                            <select wire:model="paginate" name="paginate" id="paginate" class="form-control form-control-sm">
                                                <option value="10">10</option>
                                                <option value="20">20</option>
                                                <option value="30">30</option>
                                            </select>
                                        </div>
                                    </div>
                                    @can('user.update')
                                    <div class="col-md-5">
                                        <div class="dropdown ml-4">
                                            @if($checked)
                                                <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                    Đã chọn <span class="badge badge-light"> {{ count($checked) }} </span>
                                                </button>
                                                <button type="button" class="btn btn-secondary" wire:click="emptyChecked">
                                                    Hủy chọn
                                                </button>
                                            @endif
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" type="button"
                                                    onclick="confirm('Khóa các tài khoản đã chọn?') || event.stopImmediatePropagation()"
                                                    wire:click="blockChecked">
                                                    Khóa tài khoản
                                                </a>
                                                <a class="dropdown-item" type="button"
                                                    onclick="confirm('Bạn có chắc chắn xóa các tài khoản đã chọn. Mọi bài viết của tài khoản này cũng sẽ bị xoá?') || event.stopImmediatePropagation()"
                                                    wire:click="deleteChecked">
                                                    Xóa tài khoản
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                    @endcan
                                </div>
                                <table id="datatable-fixed-header" class="table table-striped table-bordered" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>ID</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Role</th>
                                            <th>Email verified at</th>
                                            <th>Created at</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $values)
                                        <tr class="@if($this->isChecked($values->id)) table-primary @endif">
                                             <td>
                                                @if(!$values->inRole("admin"))
                                                    <input type="checkbox" name="" wire:model="checked" value="{{$values->id}}">
                                                @endif
                                            </td>
                                            <td>{{$values->id}}</td>
                                            <td>{{$values->name}}</td>
                                            <td>{{$values->email}}</td>
                                            <td>{{$values->phone}}</td>
                                            <td id="role_user_{{$values->id}}">
                                                <?php $ta = array();?>
                                                @if (!$values->roles->isEmpty())
                                                    @foreach ($values->roles as $r)
                                                        <h2><label class="badge badge-success" {{$ta[] = $r->id}}>{{$r->name}}</label></h2>
                                                    @endforeach
                                                @endif
                                            </td>
                                            <td>{{$values->email_verified_at}}</td>
                                            <td>{{$values->created_at}}</td>
                                            <td>

                                                @can('user.update')
                                                    <button type="button" class="btn btn-primary btn-sm open-modal" data-toggle="modal" onclick="event.preventDefault();editRoleForm({{$values->id}},'{{$values->email}}',{{json_encode($ta)}},{{json_encode($roles->pluck('id','slug'))}});"><i class="fa fa-pencil-square-o" aria-hidden="true" data-toggle="tooltip" title="Edit Role"></i></button>
                                                    <button type="button" wire:click.prevent="confirmUserRemoved({{ $values->id}},'{{$values->email }}')" class="btn btn-danger btn-sm"><i class="fa fa-ban" aria-hidden="true"></i></button>
                                                @else
                                                    <p>No Permission</p>
                                                @endcan
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
                    {!! $users->links() !!}
                </div>
            </div>
        </div>
    </div>

    <!-- Delete User Modal -->
    <div class="modal fade" id="confirm-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2>Khoá tài khoản</h2>
                </div>
                <div class="modal-body">
                    <p>Xác nhận khoá tài khoản: <b><i class="title">{{ $this->email}}</i></b>, tài khoản sẽ bị ẩn, bạn vẫn có thể khôi phục lại.</p>
                    <p>Bạn có muốn tiếp tục! <i class="dataid"></i></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="button" wire:click.prevent="blockUser" class="btn btn-danger">Block</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Role Modal -->
    <div class="modal fade" id="editRoleModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <form id="frmEditRole">
                    <div class="modal-header">
                        <h4 class="modal-title">
                            Edit Role 
                            <br><i><label id="email_user">.</label></i>
                        </h4>
                        <button aria-hidden="true" class="close" data-dismiss="modal" type="button">
                            ×
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="alert alert-danger" id="edit-error-bag">
                            <ul id="edit-role-errors">
                            </ul>
                        </div>
                        <div class="form-group">
                            <label>
                                Role
                            </label>
                            <input id="id_user" name="id_user" type="hidden" value="0">
                            <div id="containerRole">
                                @foreach($roles as $per)
                                    <input type="checkbox" value="{{$per->id}}" name="checkbox[]" id="checkbox{{$per->id}}"> {{$per->name}}<br>
                                @endforeach
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input id="task_id" name="task_id" type="hidden" value="0">
                            <input class="btn btn-default" data-dismiss="modal" type="button" value="Cancel">
                                <button class="btn btn-info" id="btn-edit" type="button" value="add">
                                    Update Role
                                </button>
                            </input>
                        </input>
                    </div>
                </form>
            </div>
        </div>
    </div>

</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
    function editRoleForm(id_user,email,role_user,roles) {
        $("#edit-error-bag").hide();
        $('#editRoleModal').modal('show');
        $("#frmEditRole input[name=id_user]").val(id_user);
        $("#email_user").text(email);
        for (var key in roles) {
            var checkedRole = document.getElementById("checkbox"+roles[key]);
            role_user.includes(roles[key]) ? checkedRole.checked = true : checkedRole.checked = false;
        }
    }

    $(function() {
        $("#btn-edit").click(function () {
            var list = $("input[name='checkbox[]']:checked").map(function () {
                return this.value;
            }).get();
            $.ajaxSetup({
                headers: {
                }
            });
            $.ajax({
                type: 'put',
                url: "{{route('update_role_user')}}",
                data: {
                    "_token": "{{ csrf_token() }}",
                    'id_user': $("#frmEditRole input[name=id_user]").val(),
                    'checkbox': list,
                },
                dataType: 'json',
                success: function (data) {
                    console.log(data);
                    // $('#frmEditRole').trigger("reset");
                    // $("#frmEditRole .close").click();
                    window.location.reload();
                },
                error: function (data) {
                    var errors = $.parseJSON(data.responseText);
                    $('#edit-role-errors').html('');
                    $.each(errors.messages, function (key, value) {
                        $('#edit-role-errors').append('<li>' + value + '</li>');
                    });
                    $("#edit-error-bag").show();
                }
            });
        });
    });

</script>
