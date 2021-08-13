<?php

namespace App\Repositories\User;

use App\Models\User;
use Throwable;


interface UserRepositoryInterface{

     public function findById(int $id);
     public function update_roleUser($request);
     public function update_permissions($request,$role);
}