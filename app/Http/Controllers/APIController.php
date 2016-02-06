<?php namespace App\Http\Controllers;
use App\Blueg;
use App\User;
use App\Score;
use Auth;
use Illuminate\Database\Eloquent\Collection;
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
           // $groupd = Blueg::all();
             //   $group = $groupd->toArray();
                //$group = $group->toArray();
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
                    $group  = array_slice($group,$strt , $countPerPage);
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
                'result'=>$this->transformCollection($group),'status'=>$status,'total_pages'=>$pageCount,'current_page'=>$page
            ]);
            }
    }

    function getEvent(){
       $eventTable = DB::get('event')->get();
        return Response::json([
           'result'=>$eventTable
        ]);

    }

    private function transformCollection($group){

        return array_map([$this, 'transform'],$group);
    }

    function transform($group){
        return [
            'name'=>$group->name,
            'year'=>$group->year,
            'cls'=>$group->class
        ];
    }


    function searchGroup(){
        $name = Input::get('name');
        $year = Input::get('yr');
        $class = Input::get('cls');
        $group = Input::get('grp');
        $page = Input::get('page');



        $gtable = null;
        if($group!=null){
            switch($group){
                case 'b':
                    $gtable = 'blueg';
                    $g= 'b';
                    break;
                case 'g':
                    $gtable = 'greeng';
                    $g= 'g';
                    break;
                case 'y':
                    $gtable = 'yellowg';
                    $g= 'y';
                    break;
                case 'r':
                    $gtable = 'redg';
                    $g= 'r';
                    break;
            }
            $mDataSource = DB::table($gtable)->get();
            foreach($mDataSource as $gp){
                $gp->group=$g;
            }

        }else{
            $gb = DB::table('blueg')->get();
            foreach($gb as $b){
                $b->group='b';
            }
            $gg = DB::table('greeng')->get();
            foreach($gg as $g){
                $g->group='g';
            }
            $gy = DB::table('yellowg')->get();
            foreach($gy as $y){
                $y->group='y';
            }

            $gr = DB::table('redg')->get();
            foreach($gr as $r){
                $r->group='r';
            }

            $mDataSource = array_merge($gb,$gg,$gy,$gr);
        }
        //dd($mDataSource);

      if($year!=null){
            //$mDataSource =
            $toData = array();
            foreach($mDataSource as $data){
                if(strtolower($data->year) == strtolower($year)){
                    array_push($toData,$data);
                }
            }

            if($class !=null){
                $newArr = $toData;
                $toData = array();
                foreach($newArr as $dataa){
                    if(strtolower($dataa->class) == strtolower($class)){
                        array_push($toData,$dataa);
                    }
                }
            }
            $mDataSource = $toData;
        }
       // dd($mDataSource);

        if($name!=null){
        $newArrTwo = $mDataSource;
            $arrToAdd = array();
            foreach($newArrTwo as $arr){
               // echo $arr->name;
                if (strpos(strtolower($arr->name), strtolower($name)) !== false) {
                    array_push($arrToAdd,$arr);
                }else{
                }
            }
            $mDataSource = $arrToAdd;
        }


        if($page==null){
            $page=1;
        }
        $countPerPage = 10;
        $searchSize = sizeof($mDataSource);
        $pageCount = intval($searchSize/$countPerPage);
        if(($searchSize%$countPerPage)!=0){
            $pageCount++;
        }
        if($page!=null){
            if(($page<=$pageCount)&&($page>0)){
                $strt = ($page-1)*$countPerPage;
                $end = $page*10;
                $mDataSource  = array_slice($mDataSource,$strt , $countPerPage);
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
           'result'=>$this->transformCollectionSearch($mDataSource),'status'=>'success','total_pages'=>$pageCount,'current_page'=>$page
        ]);


    }


    private function transformCollectionSearch($mDataSource){

        return array_map([$this, 'transformSearch'],$mDataSource);
    }

    function transformSearch($mDataSource){
        return [
            'name'=>$mDataSource->name,
            'year'=>$mDataSource->year,
            'cls'=>$mDataSource->class,
            'group'=>$mDataSource->group
        ];
    }



}