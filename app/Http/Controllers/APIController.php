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


    function getGroupMenbers(){
        $grpId  =Input::get('gpid');
        $page = Input::get('page');
        $status = 'fail';
        if($grpId !=null){

            if($grpId == 'b'){
                $status = 'success';
                $group = DB::table('blueg')->get();
            }else if($grpId == 'g'){
                $status = 'success';
                $group = DB::table('greeng')->get();
            }else if($grpId == 'y'){
                $status = 'success';
                $group = DB::table('yellowg')->get();
            }else if($grpId == 'r'){
                $status = 'success';
                $group = DB::table('redg')->get();
            }
            if($page==null){
                $page=1;
            }
            $countPerPage = 10;
            $grpSize = sizeof($group);
            $pageCount = intval($grpSize/$countPerPage);
            if(($grpSize%$countPerPage)!=0){
                $pageCount++;
            }
            if($page!=null){
                if($page<=$pageCount){
                    $strt = ($page-1)*$countPerPage;
                    $end = $page*10;
                    $group  = array_slice($group,$strt , $end);
                    //dd($grpArray);
                }else{
                    return Response::json([
                        'status'=>'fail',
                    ]);
                }
            }else{
                $page=1;
            }
            return Response::json([
                'result'=>$group,'status'=>$status,'total_pages'=>$pageCount,'current_page'=>$page
            ]);


            }
    }

    function getEvent(){
       $eventTable = DB::get('event')->get();
        return Response::json([
           'result'=>$eventTable
        ]);





    }


}