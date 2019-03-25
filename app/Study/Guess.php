<?php

namespace App\Study;

use Illuminate\Database\Eloquent\Model;

class Guess extends Model
{
    //
    protected $table = "study_guess";

    public $timestamps = false;

    public function add($data)
    {
    	return self::insert($data);
    }

    public function getList()
    {
    	return self::get()->toArray();
    }

    public function getInfo($id)
    {
    	return self::where('id',$id)->first();
    }
}
