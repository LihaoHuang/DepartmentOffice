<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Turnout extends Model
{
    protected $table = 'turnouts';
    protected $fillable=[
        'item','votes',
        'optionName1','fileName1',
        'optionName2','fileName2',
        'optionName3','fileName3',
        'optionName4','fileName4',
        'optionName5','fileName5',
        'optionName6','fileName6',
        'optionName7','fileName7',
        'optionName8','fileName8',
        'optionName9','fileName9',
        'optionName10','fileName10'
        ];
}
