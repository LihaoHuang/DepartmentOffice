<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Apply extends Model
{
    protected $table = 'applys';
    protected $fillable = ['name','intro','start_at','end_at'];
}
