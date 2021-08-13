<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

/**
 * Class BaseRepository
 *
 * @package App\Repositories
 */
class BaseRepository implements RepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @inheritdoc
     */
    public function findById(int $id)
    {
        return $this->model->where('id', $id)->first();
    }

    public function update_roleUser($request)
    {

        $validator = Validator::make($request->input(), array(
            'id_user' => 'required',
            'checkbox' => 'required|array',
        ));

        if ($validator->fails()) {
            return response()->json([
                'error'    => true,
                'messages' => $validator->errors(),
            ], 422);
        }

        $roleAdmin = Role::where('slug', 'admin')->pluck("id")->first();
        if (!Auth::user()->isSuperAdmin() && in_array($roleAdmin,$request->checkbox)) {
            return response()->json([
                'error'    => true,
                'messages' => ["Bạn không có quyền thiết lập admin!"],
            ], 422);
        }

        $user = User::findOrFail($request->id_user);
        $rs = $user->roles()->sync($request->checkbox);

        return response()->json([
            'error' => false,
            'id_user'  => $request->id_user,
            'checkbox'=>$request->checkbox,
        ], 200);
    }
}