<?php namespace App\Http\Controllers;

/**
 * Created by PhpStorm.
 * User: Muneef
 * Date: 30/01/16
 * Time: 00:29
 */
use App\Blueg;
use App\Event;
use App\Eventname;
use App\Greeng;
use App\Redg;
use App\Winners;
use App\Yellowg;


use App\User;
use App\Score;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;


class DeleteController extends Controller
{

    function deleteFromGroup(){
        $blue_id = Input::get('b_id');
        $green_id = Input::get('g_id');
        $yellow_id  = Input::get('y_id');
        $red_id = Input::get('r_id');

        if($blue_id!=null){
            DB::table('blueg')->where('id',$blue_id)->delete();

        }
        if($green_id!=null){
            DB::table('greeng')->where('id',$green_id)->delete();

        }
        if($yellow_id!=null){
            DB::table('yellowg')->where('id',$yellow_id)->delete();

        }
        if($red_id!=null){
            DB::table('redg')->where('id',$red_id)->delete();

        }

        //return Redirect('');

    }

    function deleteFromEvent(){

        $eventStudId = Input::get('ev_id');
        if($eventStudId!=null){
            DB::table('event')->where('id',$eventStudId)->delete();
        }
        //return Redirect::back();
    }

    function deleteFromWinners(){
        $winner_id = Input::get('w_id');
        if($winner_id!=null){
            DB::table('winners')->where('id',$winner_id)->delete();
        }
    }


    function deleteFeed(){
        if (Auth::check()) {
            $id = Input::get('fd_id');
            if('fd_id'!=null){
            DB::table('feeds')->where('id',$id)->delete();
                return Redirect('feed_get');
            }
        }else{
            return redirect('login');
        }
    }

    function deleteImage(){
        if (Auth::check()) {
            $id = Input::get('img_id');
            if('img_id'!=null){
                DB::table('images')->where('id',$id)->delete();
                return Redirect('gallery');
            }
        }else{
            return redirect('login');
        }
    }


}