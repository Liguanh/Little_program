<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TestController extends Controller
{
    //

    public function add()
    {
    	return view('admin.test.test');
    }


    public function store(Request $request)
    {

    	$this->validate($request, [
    			'position_name'  => 'numeric',
    			'position_desc'  => 'boolean'
    		]);
    }
}
