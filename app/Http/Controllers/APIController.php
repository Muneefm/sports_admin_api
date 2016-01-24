<?php namespace App\Http\Controllers;
use App\User;
use App\Score;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Response;


class APIController extends Controller
{

    
    function getScore(){
        $scoreTable = DB::table('score')->where('id', 1)->first();

     //return  json_encode($scoreTable);

    return Response::json([
       'blue'=>$scoreTable->b,'green'=>$scoreTable->g,'yellow'=>$scoreTable->y,'red'=>$scoreTable->r
    ]);
    }


}