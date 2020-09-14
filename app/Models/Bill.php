<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $timestamps = false;
    protected $table = 'bills';
    protected $fillable = ['id', 'user_id', 'status', 'due', 'url', 'dt_payment'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
