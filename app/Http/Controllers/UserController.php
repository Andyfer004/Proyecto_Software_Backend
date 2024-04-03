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

    public function deactivateAccount($id){

        $data = $this->user->where('id',$id)->update(['voided'=>'TRUE']);

        if($data>0){
            return ['message'=> 'se ha desactivado correctamente', 'deleted'=> $data];
        }else{
            return ['message'=> 'no se ha podido desactivar, intentalo de nuevo'];
        }

    }
   
}
