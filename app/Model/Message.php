<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //下发记录表
    protected $table = "jy_message";
    public $timestamps = true;
}
