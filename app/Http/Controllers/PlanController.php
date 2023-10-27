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
use App\Project;
use App\Vacation;
use App\Number;
use App\Plan;
use Illuminate\Support\Facades\Auth;
use DB;
use Session;
use Carbon\Carbon;


class PlanController extends Controller

{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(){
        if(Auth::user()->permissions != 'Administrator' && Auth::user()->permissions != 'Pracownik'){
            return redirect()->route('permissions');
        }
        $auth_user_id = Auth::id();
        $showuserplan=Plan::where('user_id','=', $auth_user_id)->orderby('plans.plan_date',"desc")->get();       
      //  $showuserplan=Plan::join('users','plans.user_id','=','users.id')
      //  ->select("plans.*", "users.*")
      //  ->where("plans.user_id", "=", $auth_user_id)
      //  ->orderby('plans.plan_date',"desc")
      //  ->get();

        return View('plan',compact('showuserplan'));
}
public function index2(){
    if(Auth::user()->permissions != 'Administrator' && Auth::user()->permissions != 'Pracownik'){
        return redirect()->route('permissions');
    }

    $showuserplan=Plan::orderby('plans.plan_date',"desc")->get();       
  //  $showuserplan=Plan::join('users','plans.user_id','=','users.id')
  //  ->select("plans.*", "users.*")
  //  ->where("plans.user_id", "=", $auth_user_id)
  //  ->orderby('plans.plan_date',"desc")
  //  ->get();

    return View('planlist',compact('showuserplan'));
}
public function store(Request $request){
    $request->validate([
        'plan_date' => ['required'],
        'plan_type' => ['required']
        
    ]);
    date_default_timezone_set('Europe/Warsaw');
                $today3=date('Y-m-d'); 
                $today2=date('H:i:s');
    $plan = new Plan;
    $user_id = Auth::id();
    $plan->user_id=$user_id;
    $plan->plan_date=$request->input('plan_date');
    $plan->plan_type=$request->input('plan_type');
    $plan->modification_date=$today3;
    $plan->modification_time=$today2;
    $plan ->save();

    
    
        return redirect()->action('PlanController@index');
       


}

public function delete($id)
{
    if(Auth::user()->permissions != 'Administrator' && Auth::user()->permissions != 'Pracownik'){
        return redirect()->route('login');
    }
    $plan = Plan::find($id);
    $plan->delete();
    return redirect()->action('PlanController@index')->with('success', 'Dane zostały usunięte');
}
public function delete2($id)
{
    if(Auth::user()->permissions != 'Administrator' && Auth::user()->permissions != 'Pracownik'){
        return redirect()->route('login');
    }
    $plan = Plan::find($id);
    $plan->delete();
    return redirect()->action('PlanController@index2')->with('success', 'Dane zostały usunięte');
}
}
