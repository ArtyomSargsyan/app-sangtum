<?php
namespace App\Repositories;

use App\Models\User;

class UserRepository{

    public function getUserById($userId) {

        return User::where('id', $userId)->first();
    }
}