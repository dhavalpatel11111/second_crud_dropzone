<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImgtableController extends Controller
{
    public function addimg(Request $request)
    {

        //  echo '<pre>';
        //  print_r($request->file('file')[0]->getClientOriginalName());
        for ($i = 0; $i < count($request->file('file')); $i++) {
            $request->file('file')[$i]->getClientOriginalName();
        }
        die;
    }
}
