<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public $timestamps = false;
    protected $table = 'users';
    protected $fillable = ['id', 'name', 'email', 'password'];

    public function bills()
    {
        return $this->hasMany('App\Models\Bill', 'User_id');
    }
}
