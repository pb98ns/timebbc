<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use App\Repositories\FirmRepository;
use App\Repositories\TaskRepository;
use App\Repositories\ProjectRepository;
use Illuminate\Http\Request;
use App\Firm;
use App\User;
use App\Task;
use App\Number;
use App\Project;
use App\Vacation;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;


class VacationController extends Controller

{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        if(Auth::user()->permissions != 'Administrator' && Auth::user()->permissions != 'Pracownik'){
            return redirect()->route('permissions');
        }
        $today2 = date('Y-01-01');
        $today3 = date('Y-12-31');
        $auth_user_id = Auth::id();
        $vacations=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$today2, $today3])->groupBy('vacation_date')->get(); 
        $vacationscount=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$today2, $today3])->groupBy('vacation_date')->count(); 
        $vacations_ch=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$today2, $today3])->groupBy('vacation_date')->get(); 
        $vacationscount_ch=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$today2, $today3])->groupBy('vacation_date')->count(); 
        $test2=DB::table("vacations")
        ->where("user_id", "=", $auth_user_id)
        ->where("type_vacation", "=", "UW")
        ->where("status1", "=", "Potwierdzony")
        ->whereBetween('vacation_date', [$today2, $today3])
        ->groupBy('vacation_date')
        ->get(); 
        $test=$test2->sum('size');

        $chest2=DB::table("vacations")
        ->where("user_id", "=", $auth_user_id)
        ->where("type_vacation", "=", "CH")
        ->where("status1", "=", "Potwierdzony")
        ->whereBetween('vacation_date', [$today2, $today3])
        ->groupBy('vacation_date')
        ->get(); 
        $chest=$chest2->sum('size');

         $dni = Number::where("user_id", "=", $auth_user_id)->first(); 
  
return View('vacation.list', compact('vacations','today2','today3','vacationscount','vacations_ch','vacationscount_ch','test','chest','dni'));
}
public function index2(){
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    $start_date = date('Y-m-d');
    $today = date('Y-m-d');
    $today2 = date('Y-01-01');
    $today3 = date('Y-12-31');
    $variable6=$today2;
                    $variable7=$today3;
                    session()->put('variable6', $variable6);
                    session()->put('variable7', $variable7);
    $vacations=Vacation::join('users','vacations.user_id','=','users.id')->where("users.permissions", "!=", "Nieaktywny")->where("status1", "=", "Potwierdzony")->where("vacation_date", "=", $today)->orderBy('users.surname', "asc")->groupBy('user_id')->get(); 
    $vacations_uw=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("sum(`size`) as czas"))->where("users.permissions", "!=", "Nieaktywny")->where("type_vacation", "=", "UW")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$today2, $today3])->orderBy('users.surname', 'asc')->groupBy('user_id')->distinct('vacation_date')->get(); 
    $vacations_ch=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("sum(`size`) as czas"))->where("users.permissions", "!=", "Nieaktywny")->where("type_vacation", "=", "CH")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$today2, $today3])->orderBy('users.surname', 'asc')->groupBy('user_id')->get(); 
 $vacations_uw_suma=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("sum(`size`) as czas23"))->where("users.permissions", "!=", "Nieaktywny")->where("type_vacation", "=", "UW")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$today2, $today3])->orderBy('users.surname', 'asc')->distinct('vacation_date')->get(); 
    $vacations_ch_suma=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("sum(`size`) as czas23"))->where("users.permissions", "!=", "Nieaktywny")->where("type_vacation", "=", "CH")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$today2, $today3])->orderBy('users.surname', 'asc')->groupBy('user_id')->get(); 
return View('vacation.vacation', compact('vacations','today','vacations_uw','vacations_ch','today2','today3','vacations_ch_suma','vacations_uw_suma'));
}


public function confirm(){
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }

    $vacations=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.id as czas",'vacations.*','users.*')->where("users.permissions", "!=", "Nieaktywny")->where("status1", "=", "Oczekuje na potwierdzenie")->orderBy('users.surname', "asc")->orderBy('vacation_date', "asc")->get(); 


return View('vacation.confirm', compact('vacations'));
}

public function confirmvacation($id)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    



    $vacation = Vacation::find($id);

    $vacation ->status1="Potwierdzony";
    



    $vacation ->save();

$number2=Number::select('id')->where('user_id', '=', $vacation->user_id)->first();

    if(($vacation->type_vacation === "UW" ) && $number2 != NULL )
{
    $number=Number::select('id')->where('user_id', '=', $vacation->user_id)->first();
    //$number->liczba=$number->liczba;  
    $number->decrement('liczba', $vacation->size);
    $number ->save();
}

    return redirect()->action('VacationController@confirm');
}
public function deletevacation($id)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
   



    $vacation = Vacation::find($id);

    $vacation ->status1="Odrzucony";
    



    $vacation ->save();

    return redirect()->action('VacationController@confirm');
}
public function rollbackvacation($id)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
   



    $vacation = Vacation::find($id);
 $vacation22 = Vacation::find($id);

    $vacation ->status1="Oczekuje na potwierdzenie";
    



    $vacation ->save();

$number2=Number::select('id')->where('user_id', '=', $vacation->user_id)->first();

    if(($vacation->type_vacation === "UW" )&& ($vacation22->status1 === "Potwierdzony" ) && $number2 != NULL )
    {
        $number=Number::select('id')->where('user_id', '=', $vacation->user_id)->first();
        //$number->liczba=$number->liczba;  
        $number->increment('liczba', $vacation->size);
        $number ->save();
    }

    return redirect()->action('VacationController@confirm');
}

public function store(Request $request){
    $auth_user_id = Auth::id();
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    $system = $request->input('system');
    $type_vacation = $request->input('type_vacation');
    $size = $request->input('size');

    if ($start_date == null)
    {
        return redirect()->action('VacationController@index')->with('message', 'Niezdefiniowana data początkowa urlopu');
    }
    if ($end_date == null)
    {
        return redirect()->action('VacationController@index')->with('message', 'Niezdefiniowana data końcowa urlopu');
    }
    if ($end_date < $start_date)
{
    return redirect()->action('VacationController@index')->with('message', 'Niepoprawny zakres dat');
}

else{


    if ($system == "1") 
    {
        DB::select('call week(?,?,?,?,?)',array($auth_user_id,$start_date,$end_date,$type_vacation,$size)); 
    }
 
    if ($system == "2") 
    {
        DB::select('call saturday(?,?,?,?,?)',array($auth_user_id,$start_date,$end_date,$type_vacation,$size)); 
    }
    if ($system == "3") 
    {
        DB::select('call sunday(?,?,?,?,?)',array($auth_user_id,$start_date,$end_date,$type_vacation,$size)); 
    }

    
    return redirect()->action('VacationController@index');
    }
}
public function searchvacation(Request $request)
{
    $start_date = $request->input('start_date2');
    $end_date = $request->input('end_date2');

                    if(empty($start_date)){
                        $start_date = date('Y-01-01');
                    }
                    if(empty($end_date)){
                        $end_date = date('Y-12-31');
                    }
                    $today2=$request->input('start_date2');
                    $today3=$request->input('end_date2');
                    $auth_user_id = Auth::id();
                    $vacations=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$start_date, $end_date])->get(); 
                    $vacationscount=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$today2, $today3])->groupBy('vacation_date')->count(); 
                    $vacations_ch=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$start_date, $end_date])->groupBy('vacation_date')->get(); 
                    $vacationscount_ch=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $auth_user_id)->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$today2, $today3])->groupBy('vacation_date')->count(); 
                  
                    $test2=DB::table("vacations")
                    ->where("user_id", "=", $auth_user_id)
                    ->where("type_vacation", "=", "UW")
                    ->where("status1", "=", "Potwierdzony")
                    ->whereBetween('vacation_date', [$start_date, $end_date])
                    ->groupBy('vacation_date')
                    ->get(); 
                    $test=$test2->sum('size');
            
                    $chest2=DB::table("vacations")
                    ->where("user_id", "=", $auth_user_id)
                    ->where("type_vacation", "=", "CH")
                    ->where("status1", "=", "Potwierdzony")
                    ->whereBetween('vacation_date', [$start_date, $end_date])
                    ->groupBy('vacation_date')
                    ->get(); 
                    $chest=$chest2->sum('size');
 $dni = Number::where("user_id", "=", $auth_user_id)->first(); 
                    return View('vacation.list', compact('vacations','today2','today3','vacationscount','vacations_ch','vacationscount_ch','test','chest','dni'));
                }
                public function searchday(Request $request, UserRepository $userRepo, FirmRepository $firmRepo){
        
                    $today = $request->input('start_date');
                    if(empty($today)){
                        $today = date('Y-m-d');
                    }
                    $today2 = date('Y-01-01');
                    $today3 = date('Y-12-31');
                   
                    $vacations=Vacation::join('users','vacations.user_id','=','users.id')->where("users.permissions", "!=", "Nieaktywny")->where("vacation_date", "=", $today)->where("status1", "=", "Potwierdzony")->orderBy('users.surname', "asc")->groupBy('user_id')->get();  
                    $vacations_uw=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("sum(`size`) as czas"))->where("type_vacation", "=", "UW")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$today2, $today3])->orderBy('users.surname', 'asc')->groupBy('user_id')->get(); 
                    $vacations_ch=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("sum(`size`) as czas"))->where("type_vacation", "=", "CH")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$today2, $today3])->orderBy('users.surname', 'asc')->groupBy('user_id')->get(); 
$vacations_uw_suma=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("sum(`size`) as czas23"))->where("type_vacation", "=", "UW")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$today2, $today3])->get(); 
                    $vacations_ch_suma=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("sum(`size`) as czas23"))->where("type_vacation", "=", "CH")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$today2, $today3])->get();                 
                  
                    return View('vacation.vacation',compact('vacations','today','today2','today3','vacations_uw','vacations_ch','vacations_uw_suma','vacations_ch_suma'));
                }
                public function searchperiod(Request $request, UserRepository $userRepo, FirmRepository $firmRepo){
                    $today = date('Y-m-d');
                    $start_date = $request->input('start_date2');
                    $end_date = $request->input('end_date2');
                                    
                                    if(empty($start_date)){
                                        $start_date = date('Y-01-01');
                                    }
                                    if(empty($end_date)){
                                        $end_date = date('Y-12-31');
                                    }
                                    $today2=$request->input('start_date2');
                                    $today3=$request->input('end_date2');

                  $vacations=Vacation::join('users','vacations.user_id','=','users.id')->where("users.permissions", "!=", "Nieaktywny")->where("vacation_date", "=", $today)->where("status1", "=", "Potwierdzony")->orderBy('users.surname', "asc")->get(); 
                    $vacations_uw=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("sum(`size`) as czas"))->where("users.permissions", "!=", "Nieaktywny")->where("type_vacation", "=", "UW")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$start_date, $end_date])->orderBy('surname', 'asc')->groupBy('user_id')->get(); 
                    $vacations_ch=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("sum(`size`) as czas"))->where("users.permissions", "!=", "Nieaktywny")->where("type_vacation", "=", "CH")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$start_date, $end_date])->orderBy('surname', 'asc')->groupBy('user_id')->get(); 
$vacations_uw_suma=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("sum(`size`) as czas23"))->where("users.permissions", "!=", "Nieaktywny")->where("type_vacation", "=", "UW")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$start_date, $end_date])->orderBy('surname', 'asc')->get(); 
                    $vacations_ch_suma=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("sum(`size`) as czas23"))->where("users.permissions", "!=", "Nieaktywny")->where("type_vacation", "=", "CH")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$start_date, $end_date])->orderBy('surname', 'asc')->get();                    
 $variable6=$start_date;
                    $variable7=$end_date;
                    session()->put('variable6', $variable6);
                    session()->put('variable7', $variable7);
                    return View('vacation.vacation',compact('vacations','today','today2','today3','vacations_uw','vacations_ch','vacations_uw_suma','vacations_ch_suma'));
                }
                public function show2($user_id, UserRepository $userRepo, TaskRepository $taskRepo, FirmRepository $firmRepo)
                {
                    if(Auth::user()->permissions != 'Administrator'){
                        return redirect()->route('login');
                    }
                    $variable6 = session()->get('variable6');
                    if(empty($variable6)){
                        $variable6 = date('Y-01-01');
                    }
                    $variable7 = session()->get('variable7');
                    if(empty($variable7)){
                        $variable7 = date('Y-12-31');
                    }
                $vacations=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $user_id)->where("type_vacation", "=", "UW")->whereBetween('vacation_date', [$variable6, $variable7])->groupBy('vacation_date')->get(); 
                $vacations_count=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("sum(`size`) as czas"))->orderBy('vacation_date', 'desc')->where("user_id", "=", $user_id)->where("type_vacation", "=", "UW")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$variable6, $variable7])->groupBy('user_id')->get(); 
                $vacations2=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $user_id)->where("type_vacation", "=", "UW")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$variable6, $variable7])->groupBy('vacation_date')->limit(1)->get(); 

               
            

    
                $user = $userRepo->getAllUsers();
                $firm = $firmRepo->getAllFirms();
                $task = $taskRepo->getAllTasks();
                return view('vacation.list3',compact('user_id','vacations', 'user', 'firm', 'task','variable6','variable7','vacations_count','vacations2'));
                }  
                public function delete($id)
                {
                    if(Auth::user()->permissions != 'Administrator'){
                        return redirect()->route('login');
                        }
                    $project = Vacation::find($id);
$project22 = Vacation::find($id);
                    $project->delete();


                    $number2=Number::select('id')->where('user_id', '=', $project->user_id)->first();

                    if(($project->type_vacation === "UW" )&& ($project22->status1 === "Potwierdzony" ) && $number2 != NULL )
                    {
                        $number=Number::select('id')->where('user_id', '=', $project->user_id)->first();
                        //$number->liczba=$number->liczba;  
                        $number->increment('liczba', $project->size);
                        $number ->save();
                    }


                    return redirect()->action('VacationController@index2')->with('success', 'Dane zostały usunięte');
                }
                public function show4($user_id, UserRepository $userRepo, TaskRepository $taskRepo, FirmRepository $firmRepo)
                {
                    if(Auth::user()->permissions != 'Administrator'){
                        return redirect()->route('login');
                    }
                    $variable6 = session()->get('variable6');
                    if(empty($variable6)){
                        $variable6 = date('Y-01-01');
                    }
                    $variable7 = session()->get('variable7');
                    if(empty($variable7)){
                        $variable7 = date('Y-12-31');
                    }
                $vacations=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $user_id)->where("type_vacation", "=", "CH")->whereBetween('vacation_date', [$variable6, $variable7])->groupBy('vacation_date')->get(); 
                $vacations_count=Vacation::join('users','vacations.user_id','=','users.id')->select("vacations.*",DB::raw("sum(`size`) as czas"))->orderBy('vacation_date', 'desc')->where("user_id", "=", $user_id)->where("type_vacation", "=", "CH")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$variable6, $variable7])->groupBy('user_id')->get(); 
                $vacations2=Vacation::orderBy('vacation_date', 'desc')->where("user_id", "=", $user_id)->where("type_vacation", "=", "CH")->where("status1", "=", "Potwierdzony")->whereBetween('vacation_date', [$variable6, $variable7])->groupBy('vacation_date')->limit(1)->get(); 

               
            

    
                $user = $userRepo->getAllUsers();
                $firm = $firmRepo->getAllFirms();
                $task = $taskRepo->getAllTasks();
                return view('vacation.list5',compact('user_id','vacations', 'user', 'firm', 'task','variable6','variable7','vacations_count','vacations2'));
                }  
}
