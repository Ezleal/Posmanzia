<?php

namespace App\Repositories;

use App\User;


class UsersRepository{

    public function traerUsers(){

       return User::all();
    }
    public function UsersPorID($id){
        
       return User::findOrFail($id);

    }
}