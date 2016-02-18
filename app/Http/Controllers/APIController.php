<?php namespace App\Http\Controllers;
use App\Blueg;
use App\User;
use App\Score;
use App\Winners;
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



    function imageGallery(){

        $imageDb = DB::table('images')->get();
        $page = Input::get('page');
        if($imageDb!=null){
            if($page==null){
                $page=1;
            }
            $countPerPage = 10;
            $grpSize = sizeof($imageDb);
            $pageCount = intval($grpSize/$countPerPage);
            if(($grpSize%$countPerPage)!=0){
                $pageCount++;
            }
            if($page!=null){
                if($page<=$pageCount){
                    $strt = ($page-1)*$countPerPage;
                    $end = $page*10;
                    $imageDb  = array_slice($imageDb,$strt , $countPerPage);
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
           'result'=>$this->transformCollectionImage($imageDb),'status'=>'success','total_page'=>$pageCount,'current_page'=>$page
        ]);
        }


    }

    private function transformCollectionImage($imageDb){

        return array_map([$this, 'transformImage'],$imageDb);
    }

    function transformImage($imageDb){
        return [
            'name'=>$imageDb->name,
            'ext'=>$imageDb->ext,

        ];
    }



    function getEvents(){
        $evTypeIGS = Input::get('evid');
        $evTypeSp = Input::get('evsp');



    if($evTypeIGS!=null){
        $winners = DB::table('winners')->get();
        if($evTypeIGS=='i'){
            $mData = DB::table('eventname')->where('type','i')->where('specialtype','n')->get();
            //dd($mData);
        }elseif($evTypeIGS=='g'){
            $mData = DB::table('eventname')->where('type','g')->where('specialtype','n')->get();
        }elseif($evTypeIGS=='s'){
            $mData = DB::table('eventname')->where('specialtype','sp')->get();
            dd($mData);
        }else{
            //$mData=
        }

        return Response::json([
           'status'=>'success','result'=>$this->transformCollectionEvent($mData,$winners)
        ]);
    }


    }


    private function transformCollectionEvent($mData,$winners){
        $win =null;

        //dd($winners);
      /*  if($winners!=null){
            foreach($mData as $dataEv){
                foreach($winners as $winner){
                    if(($dataEv->code)==($winner->event)){
                        if($winner->pos=='1'){
                            $pos1 = $winner;
                        }else if($winner->pos=='2'){
                            $pos2 = $winner;
                        }else if($winner->pos=='3'){
                            $pos3 = $winner;
                        }
                        // $win = $winner;
                    }
                }
            }

        }*/

        return array_map([$this, 'transformEvent'],$mData);//,$pos1,$pos2,$pos3);
    }

    function transformEvent($mData){
        $overBool = 0;
        $pos1 =new \stdClass();//null;//array('name'=>null,'pos'=>null,'event'=>null,'group'=>null,'class'=>null,'year'=>null);
        $pos1->name=null;
        $pos1->pos=null;
        $pos1->event=null;
        $pos1->group=null;
        $pos1->class=null;
        $pos1->year=null;

        $pos2 =new \stdClass();//null;//array('name'=>null,'pos'=>null,'event'=>null,'group'=>null,'class'=>null,'year'=>null);
        $pos2->name=null;
        $pos2->pos=null;
        $pos2->event=null;
        $pos2->group=null;
        $pos2->class=null;
        $pos2->year=null;


        $pos3 =new \stdClass();//null;//array('name'=>null,'pos'=>null,'event'=>null,'group'=>null,'class'=>null,'year'=>null);
        $pos3->name=null;
        $pos3->pos=null;
        $pos3->event=null;
        $pos3->group=null;
        $pos3->class=null;
        $pos3->year=null;
      // dd($pos1->name);

        $winners = DB::table('winners')->get();

        foreach($winners as $winner){
            if(($mData->code)==($winner->event)){
                $overBool =1;
                if($winner->pos=='1'){
                    $pos1 = $winner;
                }else if($winner->pos=='2'){
                    $pos2 = $winner;
                }else if($winner->pos=='3'){
                    $pos3 = $winner;
                }
                // $win = $winner;
            }
        }
          return [
            'name'=>$mData->name,
            'code'=>$mData->code,
            'type'=>$mData->type,
              'over'=>$overBool,
            'specialtype'=>$mData->specialtype,
            'winnerone'=>(['name'=>$pos1->name,'pos'=>$pos1->pos,'event'=>$pos1->event,'group'=>$pos1->group,'cls'=>$pos1->class,'year'=>$pos1->year]),
            'winnertwo'=>(['name'=>$pos2->name,'pos'=>$pos2->pos,'event'=>$pos2->event,'group'=>$pos2->group,'cls'=>$pos2->class,'year'=>$pos2->year]),
            'winnerthree'=>(['name'=>$pos3->name,'pos'=>$pos3->pos,'event'=>$pos3->event,'group'=>$pos3->group,'cls'=>$pos3->class,'year'=>$pos3->year])
        ];
    }


 function getFeeds(){
     $feedsTable = DB::table('feeds')->get();
     $page = Input::get('page');
     if($page==null){
         $page=1;
     }
     if($feedsTable!=null){
         $countPerPage = 10;
         $feedSize = sizeof($feedsTable);
         $pageCount = intval($feedSize/$countPerPage);
         if(($feedSize%$countPerPage)!=0){
             $pageCount++;
         }

         if($page!=null){
             if($page<=$pageCount){
                 $strt = ($page-1)*$countPerPage;
                 $end = $page*10;
                 $group  = array_slice($feedsTable,$strt , $countPerPage);
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
            'status'=>'success','result'=>$this->transformFeeds($feedsTable),'current_page'=>$page,'total_page'=>$pageCount
         ]);
     }
 }

    private function transformFeeds($feed){

        return array_map([$this, 'transformfeed'],$feed);
    }

    function transformfeed($feed){
        return [
            'mainstring'=>$feed->mainstring,
            'substring'=>$feed->substring,
            'author'=>$feed->author,
            'image'=>$feed->image,
            'ext'=>$feed->ext
        ];
    }


}