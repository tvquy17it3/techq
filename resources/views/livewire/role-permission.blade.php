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
                @foreach ($role->permissions as $key => $permission)
                    <span class="btn badge badge-primary">{{$key.":".($permission ? 'true' :' false')}}</span>
                @endforeach
              </td>
              <td>{{$role->created_at}}</td>
              <td>{{$role->updated_at}}</td>
          </tr>
            @endforeach
        </tbody>
    </table>
</div>
