<?php


namespace App\Repositories;


use App\User;
use Illuminate\Support\Facades\Hash;

class UserRepository
{
    public function updateUser($id, $data)
    {
        return User::where('id', $id)->update($data);
    }
}
