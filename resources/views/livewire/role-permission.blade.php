<div>
    <table class="table" style="margin-top: 50px;">
        <thead class="thead-dark">
            <tr>
              <th scope="col">#ID</th>
              <th scope="col">Name</th>
              <th scope="col">Slug</th>
              <th scope="col">Permisson</th>
              <th scope="col">Created_at</th>
              <th scope="col">Updated_at</th>
              <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
            @foreach ($roles as $role)
            <tr>
              <th scope="row">{{$role->id}}</th>
              <td>{{$role->name}}</td>
              <td>{{$role->slug}}</td>
              <td>
                @foreach ($role->permissions as $key => $pms)
                    <span class="btn badge badge-primary">{{$key.":".($pms ? 'true' :' false')}}</span>
                @endforeach
              </td>
              <td>{{$role->created_at}}</td>
              <td>{{$role->updated_at}}</td>
              <td>
                @can('user-update')
                    <button type="button" class="btn btn-primary btn-sm" wire:click="edit({{ $role->id }})"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>
                @else
                    <p>No Permission</p>
                @endcan
              </td>
          </tr>
            @endforeach
        </tbody>
    </table>


    <div class="modal fade" id="show-edit-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form wire:submit.prevent="savePermission">
                    <div class="modal-header">
                        <h2>Edit Role</h2>
                    </div>
                    <div class="modal-body">
                        <div class="hiddenCB">
                          <h3>Make your choice(s)</h3>
                          <div>
                            @foreach($permissions as $key => $valuePMS)
                                <p>
                                    <input type="checkbox" value="{{$valuePMS}}" wire:model="{{$key}}" {{$valuePMS != true?: 'checked' }}> {{$key}}
                                </p>
                            @endforeach
                          </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="button" type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
