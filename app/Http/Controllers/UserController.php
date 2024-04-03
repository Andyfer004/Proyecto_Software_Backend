<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(\App\Models\User $user)
    {
        return $user->paginate(2);
    }



      
    public function __construct(\App\Models\User $user){
        $this->user = $user;
    }
   
}
