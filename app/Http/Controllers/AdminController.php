<?php namespace App\Http\Controllers;
use App\Blueg;
use App\Event;
use App\Eventname;
use App\Feeds;
use App\Greeng;
use App\Images;
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
use Maatwebsite\Excel\Facades\Excel;


class AdminController extends Controller
{

    function eventpop(){

      //  $evname = array("100m Race Boys","100m Race Girls","110m Hurdles Boys","200m Race Boys","200m Race Girls","200m Hurdles Boys","400m Race Boys","400m Race Girls","800m Race Boys","800m Race Girls","1500m Race Boys","3000m Race Boys","3km Walking Boys","1km Walking Girls","2km Walking Girls","Shotput Boys","Shotput Girls","Discus throw Boys","Discus throw Girls","Javelin throw Boys","Javelin throw Girls","Hammer throw Boys","Hammer throw Girls","Broad Jump Boys","Broad Jump Girls","Triple Jump Boys","Triple Jump Boys","Pentathlon");
        //$evcode=  array("e1",            "e2",             "e3",               "e4",            "e5",             "e6",               "e7",            "e8",             "e9",            "e10",            "e11",            "e12",             "e13",            "e14",              "e15",              "e16",         "e17",          "e18",              "e19",               "e20",               "e21",                "e22",              "e23",               "e24",            "e25",             "e26",            "e27",              "e28");
       //  $evtype = array("i",             "i",  );

      //  $evname = array("Volley ball","Cricket","Table tennis","Football","Badminton Boys","Badminton Girls","4x100 Relay Boys","4x100 Relay Girls","4x200 Relay Boys");
        //$evcode = array("e30",        "e31",    "e32",         "e33",     "e34",           "e35",            "e36",             "e37",               "e38");
  /*          $evname = array("Medlay Relay");
        $evcode = array("e39");
        for($i=0;$i<sizeof($evcode);$i++){
            $model = new Eventname();
            $model->name = $evname[$i];
            $model->code = $evcode[$i];
            $model->type = "g";
            $model->specialtype = "sp";
            $model->save();
        }*/


    }

    function newEvent(){
      //  DB::table('eventname')->where('code', 'e34')->update(['name'=>'Badminton Boys (Doubles)']);
        //DB::table('eventname')->where('code', 'e35')->update(['name'=>'Badminton Girls (Doubles)']);

        $newevent = new Eventname();
        $newevent->name = "Badminton Boys (Singles)";
        $newevent->code = "e40";
        $newevent->type = "g";
        $newevent->specialtype = "n";
        $newevent->save();

        $newevent = new Eventname();
        $newevent->name = "Badminton Girls (Singles)";
        $newevent->code = "e41";
        $newevent->type = "g";
        $newevent->specialtype = "n";
        $newevent->save();







        //$newevent->name = "Badminton Boys (Singles)";




    }



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



    function getEvent(){
        if (Auth::check()) {

            $eventId = Input::get('ev');

        $evName = Input::get('name');
        $evGroup = Input::get('group');
        $evYear = Input::get('year');
        $evClass = Input::get('class');
        if($eventId!=null){
            $eventNameTable = DB::table('eventname')->where('code',$eventId)->first();
            if($evName!=null&&$evYear!=null&&$evGroup!=null&&$evClass!=null){
                $evList = new Event();
                $evList->name = $evName;
                $evList->event = $eventId;
                $evList->group = $evGroup;
                $evList->year = $evYear;
                $evList->class = $evClass;
                $evList->save();
            }

            return view('admin.EventList')->with('eventNameTable',$eventNameTable);
        }
        }else{
            return redirect('login');

        }
    }



    function getWinners(){
        if (Auth::check()) {

            $eventId = Input::get('ev');

        $evPos = Input::get('pos');
         $evName = Input::get('name');
        $evGroup = Input::get('group');
        $evYear = Input::get('year');
        $evClass = Input::get('class');


        if($eventId!=null){
            $eventNameTable = DB::table('eventname')->where('code',$eventId)->first();
            if($evName!=null&&$evYear!=null&&$evGroup!=null&&$evClass!=null&&$evPos!=null){
                $winList = new Winners();
                $winList->name = $evName;
                $winList->pos = $evPos;
                $winList->event = $eventId;
                $winList->group = $evGroup;
                $winList->year = $evYear;
                $winList->class = $evClass;
                $winList->save();
            }

            return view('admin.WinnersList')->with('eventNameTable',$eventNameTable);
        }
        }else{
            return redirect('login');

        }

    }





    function imageUpload()
    {
        if (Auth::check()) {

            if (Input::hasFile('img')) {
        $imageFile = Input::file('img');
            $filename = time().'.'.$imageFile->getClientOriginalExtension();
            $imageModel = new Images();
            $imageModel->name = $filename;
            $imageModel->ext = $imageFile->getClientOriginalExtension();
            $imageModel->save();
            $imageFile->move('uploads',$filename);
    }
        return view('admin.ImageUpload');
        }else{
            return redirect('login');

        }
    }

function openGallery(){
    if (Auth::check()) {
    return view('admin.Gallery');
    }else{
        return redirect('login');
    }

}

    function excelView(){
        if (Auth::check()) {
            return view('admin.ExcelParse');
        }else{
            return redirect('login');
        }
    }

function excelParse()
{
    if (Auth::check()) {

        $class = Input::get('class');
    $year = Input::get('year');

    if (Input::hasFile('exl')) {
        $exlFile = Input::file('exl');
        $result = Excel::load($exlFile)->get();
          //dd($result[0]->toArray());

         if ($class != null && $year != null && $result != null) {

         foreach ($result as $res) {
             if ($res->blue != null) {
                 $blueModel = new Blueg();
                 $blueModel->name = $res->blue;
                 $blueModel->class = $class;
                 $blueModel->year = $year;
                 $blueModel->save();
             }
             if ($res->green != null) {
                 $greenModel = new Greeng();
                 $greenModel->name = $res->green;
                 $greenModel->class = $class;
                 $greenModel->year = $year;
                 $greenModel->save();
             }
             if ($res->yellow != null) {
                 $yellowModel = new Yellowg();
                 $yellowModel->name = $res->yellow;
                 $yellowModel->class = $class;
                 $yellowModel->year = $year;
                 $yellowModel->save();
             }
             if ($res->red != null) {
                 $redModel = new Redg();
                 $redModel->name = $res->red;
                 $redModel->class = $class;
                 $redModel->year = $year;
                 $redModel->save();
             }

         }
     }

        return Redirect('group_blue');

    }else{
echo 'Failed ';
    }
    }else{
        return redirect('login');
    }
}


    function getFeeds(){
        if (Auth::check()) {

            $mainString = Input::get('mstring');
            $subString = Input::get('sstring');
            $author = Input::get('author');
            //$mainString = Input::get('mstring');
            $filename ="";
            $ext ="";
            if($subString == null ){
                $subString ="";
            }
            if($author == null){
                $author = "";
            }

            if($mainString!=null){
                if(Input::hasFile('img')){
                    $imageFile = Input::file('img');
                    $filename = time().'.'.$imageFile->getClientOriginalExtension();
                    $imageFile->move('feedimages',$filename);
                    $ext = $imageFile->getClientOriginalExtension();
                }else{

                }
                $feedModel = new Feeds();
                $feedModel->mainstring = $mainString;
                $feedModel->substring = $subString;
                $feedModel->author = $author;
                $feedModel->image = $filename;
                $feedModel->imagepath = 'feedimages';
                $feedModel->ext = $ext;
                $feedModel->save();


            }
            return view('admin.Feeds');
        }else{
            return redirect('login');
        }
    }





}