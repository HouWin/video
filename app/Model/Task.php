<?php

namespace App\Model;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $guarded=[];

    public function postUser(){
        return $this->belongsTo(User::class,'post_user','id');
    }

    public function getUser(){
        return $this->belongsTo(User::class,'get_user','id');
    }

}
