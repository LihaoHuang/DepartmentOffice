<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lost extends Model
{
    protected $table = 'losts';
    protected $fillable = ['name','number','findTime','situation'];
}
