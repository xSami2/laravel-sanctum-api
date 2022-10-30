<?php

namespace App\Traits;

trait HttpRespones{

    protected  function succes($data , $massage = null , $code = 200)
    {
        return response()->json([
           'status' => 'Request was successful.' ,
            'massage' => $massage ,
            'data' => $data
        ], $code);
    }

    protected  function error($data , $massage = null , $code)
    {
        return response()->json([
            'status' => 'Error has occurred.' ,
            'massage' => $massage ,
            'data' => $data
        ], $code);
    }
}
