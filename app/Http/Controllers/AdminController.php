<?php namespace App\Http\Controllers;
use App\Blueg;
use App\Greeng;
use App\Redg;
use App\Yellowg;


use App\User;
use App\Score;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;


class AdminController extends Controller
{

    function createUser(){
        $user = new User();
        $user->name = 'mnf';
        $user->username = 'mnfadmin';
        $user->password=Hash::make('adminsportz');
        $user->save();

    }


    function loginPage()
    {
        if (Auth::check()) {
        return redirect('home');
        } else {
        return view('admin.login');
    }
    }

    function login(){
        $username = Input::get('username');
        $password = Input::get('password');
        if (Auth::attempt(['username' => $username, 'password' => $password])) {
            // Authentication passed...
            return redirect('home');
        }else{
            echo "invalid credentials";
        }
    }

    function logout(){
        Auth::logout();
        return redirect('/login');
    }

    function home(){
        if (Auth::check()) {
            $scoreTable = DB::table('score')->where('id', 1)->first();
            $iblue = Input::get('blue');
            $igreen = Input::get('green');
            $iyellow = Input::get('yellow');
            $ired = Input::get('red');
            if($iblue!=null){
                DB::table('score')->where('id', 1)->update(['b'=>$iblue]);
                //$scoreTable->b = $iblue;
               // $scoreTable->save();

            }
            if($igreen!=null){
                DB::table('score')->where('id', 1)->update(['g'=>$igreen]);

                //$scoreTable->g = $igreen;
              //  $scoreTable->save();
            }
            if($iyellow!=null){
                DB::table('score')->where('id', 1)->update(['y'=>$iyellow]);

                //  $scoreTable->y = $iyellow;
               // $scoreTable->save();
            }
            if($ired!=null){
                DB::table('score')->where('id', 1)->update(['r'=>$ired]);

                //  $scoreTable->r = $ired;
               // $scoreTable->save();
            }


            $scoreTable = DB::table('score')->where('id', 1)->first();

            if ($scoreTable != null) {

            //dd($scoreTable);
            $bl = $scoreTable->b;
            $gr = $scoreTable->g;
            $ye=$scoreTable->y;
            $re = $scoreTable->r;
            return view('admin.home')->with(['blue'=>$bl,'green'=>$gr,'yellow'=>$ye,'red'=>$re]);
        }
        }else{
            return redirect('login');
        }
        }


    function getBlue(){
        if (Auth::check()) {
            $name = Input::get("name");
            $year = Input::get("year");
            $class = Input::get("class");
            if($name!=null&&$year!=null&&$class!=null){
            $blue_member = new Blueg();
                $blue_member->name = $name;
                $blue_member->year = $year;
                $blue_member->class = $class;
                $blue_member->save();
            }
            return view('admin.groups.blue');
        }else{
            return redirect('login');

        }
    }

    function getGreen(){
        if (Auth::check()) {
            $name = Input::get("name");
            $year = Input::get("year");
            $class = Input::get("class");
            if($name!=null&&$year!=null&&$class!=null){
                $blue_member = new Greeng();
                $blue_member->name = $name;
                $blue_member->year = $year;
                $blue_member->class = $class;
                $blue_member->save();
            }
            return view('admin.groups.green');
        }else{
            return redirect('login');

        }
    }


    function getYellow(){
        if (Auth::check()) {
            $name = Input::get("name");
            $year = Input::get("year");
            $class = Input::get("class");
            if($name!=null&&$year!=null&&$class!=null){
                $blue_member = new Yellowg();
                $blue_member->name = $name;
                $blue_member->year = $year;
                $blue_member->class = $class;
                $blue_member->save();
            }
            return view('admin.groups.yellow');
        }else{
            return redirect('login');

        }
    }

    function getRed(){
        if (Auth::check()) {
            $name = Input::get("name");
            $year = Input::get("year");
            $class = Input::get("class");
            if($name!=null&&$year!=null&&$class!=null){
                $blue_member = new Redg();
                $blue_member->name = $name;
                $blue_member->year = $year;
                $blue_member->class = $class;
                $blue_member->save();
            }
            return view('admin.groups.red');
        }else{
            return redirect('login');

        }
    }



}