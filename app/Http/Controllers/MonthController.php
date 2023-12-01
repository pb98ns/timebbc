<?php

namespace App\Http\Controllers;
use App\Repositories\UserRepository;
use App\Repositories\FirmRepository;
use App\Repositories\TaskRepository;
use App\Repositories\MonthRepository;
use Illuminate\Http\Request;
use App\Firm;
use App\User;
use App\Month;
use Illuminate\Support\Facades\Auth;

use DB;
class MonthController extends Controller

{
    public function __construct(){
        $this->middleware('auth');
    }
    public function index(UserRepository $userRepo, FirmRepository $firmRepo, TaskRepository $taskRepo,MonthRepository $monthRepo){
        if(Auth::user()->permissions != 'Administrator' && Auth::user()->permissions != 'Pracownik'){
            return redirect()->route('login');
        }
        if(empty($start_date)){
            $start_date = date('Y-m-01');
        }
        if(empty($end_date)){
            $end_date = date('Y-m-d');
        }
       
        $user = $userRepo->getAllUsers();
        $firm = $firmRepo->getAllFirmsActive();
        $task = $taskRepo->getAllTasks();
        $month = $monthRepo->getAllMonths();
        $auth_user_id = Auth::id();
        date_default_timezone_set('Europe/Warsaw');
        $today=now();
        $today2=date('H:i:s');
        $today3=date('Y-m-d');
        $today4=date('Y-m-01');
        $variable0=$today3;
        $variable=$today4;
        session()->put('variable0', $variable0);
        session()->put('variable', $variable);


        $project2=Month::when($today4, function ($project3, $today4) {
            return $project3->where('close_date', '>=', $today4);
        })
        // ->where('date', '<=', $end_date)
        ->when($today3, function ($project3, $today3) {
        return $project3->where('close_date', '<=', $today3);
        })
        ->where("months.user_id", "=", $auth_user_id)->where("months.status1", "=", "W trakcie realizacji")->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 

        $project5=Month::when($today4, function ($project3, $today4) {
            return $project3->where('close_date', '>=', $today4);
        })
        // ->where('date', '<=', $end_date)
        ->when($today3, function ($project3, $today3) {
        return $project3->where('close_date', '<=', $today3);
        })
        ->where("months.user_id", "=", $auth_user_id)->where("months.status1", "=", "Zaplanowano")->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 

$project4=Month::when($today4, function ($project4, $today4) {
    return $project4->where('close_date', '>=', $today4);
})
// ->where('date', '<=', $end_date)
->when($today3, function ($project4, $today3) {
return $project4->where('close_date', '<=', $today3);
})
->where("months.user_id", "=", $auth_user_id)->where("months.status1", "=", "Potwierdzone")->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 
return View('month.list',compact('project2','today','user','firm','task','today2','today3','project4','today4','start_date','end_date','month','project5'));
}

public function searchperiod(Request $request, UserRepository $userRepo, FirmRepository $firmRepo,MonthRepository $monthRepo){
        
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    
    if(empty($start_date)){
        $start_date = date('Y-m-01');
    }
    if(empty($end_date)){
        $end_date = date('Y-m-d');
    }
    $user = $userRepo->getAllUsers();
    $firm = $firmRepo->getAllFirmsActive();
    $month = $monthRepo->getAllMonths();
    $auth_user_id = auth::id();
    date_default_timezone_set('Europe/Warsaw');
    $today4=$request->input('start_date');
    $today3=$request->input('end_date');
    $today=now();
    $today2=date('H:i:s');
    $project2=Month::when($today4, function ($project3, $today4) {
        return $project3->where('close_date', '>=', $today4);
    })
    // ->where('date', '<=', $end_date)
    ->when($today3, function ($project3, $today3) {
    return $project3->where('close_date', '<=', $today3);
    })
    ->where("months.user_id", "=", $auth_user_id)->where("months.status1", "=", "W trakcie realizacji")->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 

    $project5=Month::when($today4, function ($project3, $today4) {
        return $project3->where('close_date', '>=', $today4);
    })
    // ->where('date', '<=', $end_date)
    ->when($today3, function ($project3, $today3) {
    return $project3->where('close_date', '<=', $today3);
    })
    ->where("months.user_id", "=", $auth_user_id)->where("months.status1", "=", "Zaplanowano")->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 

$project4=Month::when($today4, function ($project4, $today4) {
return $project4->where('close_date', '>=', $today4);
})
// ->where('date', '<=', $end_date)
->when($today3, function ($project4, $today3) {
return $project4->where('close_date', '<=', $today3);
})
->where("months.user_id", "=", $auth_user_id)->where("months.status1", "=", "Potwierdzone")->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 

    $variable0=$start_date;
    $variable=$end_date;
    session()->put('variable0', $variable0);
    session()->put('variable', $variable);
  
    return View('month.list',compact('today','user','firm','today2','project2','today3','project4','today4','start_date','end_date','month','project5'));
}
public function store(Request $request)
{
    if(Auth::user()->permissions != 'Administrator' && Auth::user()->permissions != 'Pracownik'){
        return redirect()->route('login');
    }
    date_default_timezone_set('Europe/Warsaw');
    $today2=date('H:i:s');
    $month = new Month;
    $month ->firm_id=$request->input('firm_id');
    $month ->user_id=$request->input('user_id');
    $month ->user_id2=$request->input('user_id2');
    $month ->close_date=$request->input('close_date');
    $month ->close_date2=$request->input('close_date2');
    $month ->close_time=$today2;
    $month ->close_time2=$request->input('close_time2');
    $month ->close_date3=$request->input('close_date3');
    $month ->close_time3=$request->input('close_time3');
    $month ->uwagi=$request->input('uwagi');
    $month ->uwagidokorekty=$request->input('uwagidokorekty');
    $month ->amortyzacja=$request->input('amortyzacja');
    $month ->status1=$request->input('status1');
    $month ->cit=$request->input('cit');
    $month ->jpk=$request->input('jpk');
    $month ->vat=$request->input('vat');
    $month ->pit5_cit=$request->input('pit5_cit');
    $month ->pismo=$request->input('pismo');
    $month ->korekta=$request->input('korekta');
    $month ->vat_ue=$request->input('vat_ue');
    $month ->vat_uea=$request->input('vat_uea');
    $month ->vat_ueb=$request->input('vat_ueb');
    $month ->vat_uec=$request->input('vat_uec');
    $month ->vat_27=$request->input('okres');
    $month ->akc=$request->input('akc');
    $month ->cit_st=$request->input('cit_st');
    $month ->przelew=$request->input('przelew');
    $month ->uwagidodeklaracji=$request->input('uwagidodeklaracji');
    $month ->save();

    return redirect()->action('MonthController@index');

}
public function updatedeclaration(Request $request, $id)
{  

    $month = Month::find($id);
    $month ->firm_id=$request->input('firm_id');
    $month ->uwagi=$request->input('uwagi');
    $month ->vat=$request->input('vat');
    $month ->vat_27=$request->input('okres');
    $month ->save();
    return redirect()->action('MonthController@index');
}
public function edit($id)
{
    if(Auth::user()->permissions != 'Administrator' && Auth::user()->permissions != 'Pracownik'){
        return redirect()->route('login');
    }
$month = Month::find($id);
return view('month.edit', compact('firm', 'id'));
}
public function show($id, UserRepository $userRepo, FirmRepository $firmRepo)
{
    if(Auth::user()->permissions != 'Administrator' && Auth::user()->permissions != 'Pracownik'){
        return redirect()->route('login');
    }
    $today=now();
    $month = Month::find($id);

    $user = $userRepo->getAllUsers();
    $usertwo = $userRepo->getAllUsers();
    $user2 = $userRepo->getAllUsers();
    $firm = $firmRepo->getAllFirms();
    return view('month.list6',compact('id','month', 'user', 'firm','today','usertwo'));

}
public function showkpir($id, UserRepository $userRepo, FirmRepository $firmRepo)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    $today=now();
    $month = Month::find($id);

    $user = $userRepo->getAllUsers();
    $usertwo = $userRepo->getAllUsers();
    $user2 = $userRepo->getAllUsers();
    $firm = $firmRepo->getAllFirms();
    return view('month.show123',compact('id','month', 'user', 'firm','today','usertwo'));

}
public function showkh($id, UserRepository $userRepo, FirmRepository $firmRepo)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    $today=now();
    $month = Month::find($id);

    $user = $userRepo->getAllUsers();
    $usertwo = $userRepo->getAllUsers();
    $user2 = $userRepo->getAllUsers();
    $firm = $firmRepo->getAllFirms();
    return view('month.show456',compact('id','month', 'user', 'firm','today','usertwo'));

}
public function revision($id, UserRepository $userRepo, FirmRepository $firmRepo)
{
    if(Auth::user()->permissions != 'Administrator' && Auth::user()->permissions != 'Pracownik'){
        return redirect()->route('login');
    }
    date_default_timezone_set('Europe/Warsaw');
    $today=now();
    $month = Month::find($id);

    $user = $userRepo->getAllUsers();
    $usertwo = $userRepo->getAllUsers();
    $user2 = $userRepo->getAllUsers();
    $firm = $firmRepo->getAllFirms();
    return view('month.list9',compact('id','month', 'user', 'firm','today','usertwo'));

}
public function update(Request $request, $id)
{
    if(Auth::user()->permissions != 'Administrator' && Auth::user()->permissions != 'Pracownik'){
        return redirect()->route('login');
    }
    date_default_timezone_set('Europe/Warsaw');
    $today2=date('H:i:s');
    $today3=date('Y-m-d'); 
    $tak="TAK";
    

    $month = Month::find($id);
    if (is_null($month->uwagidokorekty)) {
       $value = $today3.' '.$today2.' '.$request->input('uwagidokorekty').'';
    }
    else{
        $first = $month->uwagidokorekty;
        $value = $first.' '.$today3.' '.$today2.' '.$request->input('uwagidokorekty').'';
    }
    
  
   
    $month ->close_time3=$today2;
    $month ->close_date3=$today3;
    $month ->uwagidokorekty=$value;
    $month ->korekta=$tak;
    $month ->user_id2=NULL;
    $month ->status1="W trakcie realizacji";
    $month ->close_date2=NULL;
    $month ->close_time2=NULL;

    $month ->save();

    return redirect()->action('MonthController@index');
}
public function updatekpir(Request $request, $id)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    date_default_timezone_set('Europe/Warsaw');
    $today2=date('H:i:s');
    $today3=date('Y-m-d'); 
    $tak="TAK";
    $auth_user_id = auth::id();


    $month = Month::find($id);
    if (is_null($request->input('uwagidodeklaracji'))) {
       $value = NULL;
    }
    else{
        $first = $month->uwagidodeklaracji;
        $value = $first.' '.$today3.' '.$today2.' '.$request->input('uwagidodeklaracji').'';
    }
if (is_null($request->input('vat_ueb'))) {
        $valueprzelew2 = "";
     }
     else{
        $valueprzelew2 = $request->input('vat_ueb');
        
     }
    $second = $month->przelew;
        $valueprzelew = $second.' '.$today3.' '.$today2.' '.$request->input('przelew').' '.$valueprzelew2;
  
   
    $month ->close_time2=$today2;
    $month ->close_date2=$today3;
    $month ->uwagidodeklaracji=$value;
    $month ->user_id2=$auth_user_id;
    $month ->status1="Potwierdzone";
    $month ->przelew=$valueprzelew;
    $month ->vat_ueb=$valueprzelew2;

    $month ->save();

    return redirect()->action('MonthController@indexkpir');
}

public function updatekh(Request $request, $id)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    date_default_timezone_set('Europe/Warsaw');
    $today2=date('H:i:s');
    $today3=date('Y-m-d'); 
    $tak="TAK";
    $auth_user_id = auth::id();


    $month = Month::find($id);
    if (is_null($request->input('uwagidodeklaracji'))) {
       $value = NULL;
    }
    else{
        $first = $month->uwagidodeklaracji;
        $value = $first.' '.$today3.' '.$today2.' '.$request->input('uwagidodeklaracji').'';
    }
if (is_null($request->input('vat_ueb'))) {
        $valueprzelew2 = "";
     }
     else{
        $valueprzelew2 = $request->input('vat_ueb');
        
     }
    $second = $month->przelew;
    $valueprzelew = $second.' '.$today3.' '.$today2.' '.$request->input('przelew').' '.$valueprzelew2;
  
   
    $month ->close_time2=$today2;
    $month ->close_date2=$today3;
    $month ->uwagidodeklaracji=$value;
    $month ->user_id2=$auth_user_id;
    $month ->status1="Potwierdzone";
    $month ->przelew=$valueprzelew;
    $month ->vat_ueb=$valueprzelew2;

    $month ->save();

    return redirect()->action('MonthController@indexkh');
}
public function updatedec($id)
{
    date_default_timezone_set('Europe/Warsaw');
    $today2=date('H:i:s');
    $today3=date('Y-m-d'); 
   
    $month = Month::find($id);
    $month ->close_time=$today2;
    $month ->close_date=$today3;
    $month ->status1="W trakcie realizacji";
    $month ->save();

    return redirect()->action('MonthController@index');
}
public function editdeclaration($id, UserRepository $userRepo, FirmRepository $firmRepo, TaskRepository $taskRepo,MonthRepository $monthRepo)
{
    $project = Month::find($id);
    $user = $userRepo->getAllUsers();
        $firm = $firmRepo->getAllFirmsActive();
        $task = $taskRepo->getAllTasks();
        $month = $monthRepo->getAllMonths();
        $auth_user_id = Auth::id();
        date_default_timezone_set('Europe/Warsaw');
        $today=now();
    return View('month.listedit', compact('today', 'user', 'firm', 'task','month','auth_user_id','project'));
}
public function delete($id)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    $month = Month::find($id);
    $month->delete();
    return redirect()->action('MonthController@indexkpir')->with('success', 'Dane zostały usunięte');
}
public function delete2($id)
{
  
    $month = Month::find($id);
    $month->delete();
    return redirect()->action('MonthController@index')->with('success', 'Dane zostały usunięte');
}
public function deletekh($id)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    $month = Month::find($id);
    $month->delete();
    return redirect()->action('MonthController@indexkh')->with('success', 'Dane zostały usunięte');
}
public function indexkpir(UserRepository $userRepo, FirmRepository $firmRepo, TaskRepository $taskRepo,MonthRepository $monthRepo){
    if(Auth::user()->permissions != 'Administrator' && Auth::user()->permissions != 'Pracownik'){
        return redirect()->route('login');
    }
    if(empty($start_date)){
        $start_date = date('Y-m-01');
    }
    if(empty($end_date)){
        $end_date = date('Y-m-d');
    }
   
    $user = $userRepo->getAllUsers();
    $firm = $firmRepo->getAllFirmsActive();
    $task = $taskRepo->getAllTasks();
    $month = $monthRepo->getAllMonths();
    $auth_user_id = Auth::id();
    date_default_timezone_set('Europe/Warsaw');
    $today=now();
    $today2=date('H:i:s');
    $today3=date('Y-m-d');
    $today4=date('Y-m-01');
    $variable0=$today3;
    $variable=$today4;
    session()->put('variable0', $variable0);
    session()->put('variable', $variable);


    $project2=Month::join('firms','months.firm_id','=','firms.id')->select("months.id as czas",'months.*','firms.*')->where("months.status1", "=", "Potwierdzone")->where("firms.kpir", "=", "KPiR")->when($today4, function ($project3, $today4) {
        return $project3->where('close_date', '>=', $today4);
    })
    // ->where('date', '<=', $end_date)
    ->when($today3, function ($project3, $today3) {
    return $project3->where('close_date', '<=', $today3);
    })
    ->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 
    $project22=Firm::leftJoin('months','months.firm_id','=','firms.id')->select('firms.*')->whereNotIn('firms.id', function ($query) use ($today4, $today3){
        $query->select('months.firm_id')->from('months')->when($today4, function ($project3, $today4) {
            return $project3->where('close_date', '>=', $today4);
        })
        // ->where('date', '<=', $end_date)
        ->when($today3, function ($project3, $today3) {
        return $project3->where('close_date', '<=', $today3);
        })
    ;
    })
    ->where("firms.kpir", "=", "KPiR")
    ->where("firms.status", "=", "Aktywny")
    ->groupBy('firms.name')
    ->get();
    $suma=DB::table("months")
    ->join('firms','months.firm_id','=','firms.id')
    ->select('months.*','firms.*')
    ->where("firms.kpir", "=", "KPiR")
    ->where("months.status1", "=", "W trakcie realizacji")
    ->get();


$project4=Month::join('firms','months.firm_id','=','firms.id')->select("months.id as czas",'months.*','firms.*')->where("months.status1", "=", "W trakcie realizacji")->where("firms.kpir", "=", "KPiR")->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 
$project6=Month::join('firms','months.firm_id','=','firms.id')->select("months.id as czas",'months.*','firms.*')->where("months.status1", "=", "Zaplanowano")->where("firms.kpir", "=", "KPiR")->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 

return View('month.list8',compact('project2','today','user','firm','task','today2','today3','project4','today4','start_date','end_date','month','suma','project22','project6'));
}

public function searchkpir(Request $request, UserRepository $userRepo, FirmRepository $firmRepo,MonthRepository $monthRepo){
        
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    
    if(empty($start_date)){
        $start_date = date('Y-m-01');
    }
    if(empty($end_date)){
        $end_date = date('Y-m-d');
    }
    $user = $userRepo->getAllUsers();
    $firm = $firmRepo->getAllFirmsActive();
    $month = $monthRepo->getAllMonths();
    $auth_user_id = auth::id();
    date_default_timezone_set('Europe/Warsaw');
    $today4=$request->input('start_date');
    $today3=$request->input('end_date');
    $today=now();
    $today2=date('H:i:s');
    $project2=Month::join('firms','months.firm_id','=','firms.id')->select("months.id as czas",'months.*','firms.*')->where("months.status1", "=", "Potwierdzone")->where("firms.kpir", "=", "KPiR")->when($today4, function ($project3, $today4) {
        return $project3->where('close_date', '>=', $today4);
    })
    // ->where('date', '<=', $end_date)
    ->when($today3, function ($project3, $today3) {
    return $project3->where('close_date', '<=', $today3);
    })
    ->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 
    
    $suma=DB::table("months")
    ->join('firms','months.firm_id','=','firms.id')
    ->select('months.*','firms.*')
    ->where("firms.kpir", "=", "KPiR")
    ->where("months.status1", "=", "W trakcie realizacji")
    ->get();

    $project22=Firm::leftJoin('months','months.firm_id','=','firms.id')->select('firms.*')->whereNotIn('firms.id', function ($query) use ($today4, $today3){
        $query->select('months.firm_id')->from('months')->when($today4, function ($project3, $today4) {
            return $project3->where('close_date', '>=', $today4);
        })
        // ->where('date', '<=', $end_date)
        ->when($today3, function ($project3, $today3) {
        return $project3->where('close_date', '<=', $today3);
        })
    ;
    })
    ->where("firms.kpir", "=", "KPiR")
    ->where("firms.status", "=", "Aktywny")
    ->groupBy('firms.name')
    
    ->get();
$project4=Month::join('firms','months.firm_id','=','firms.id')->select("months.id as czas",'months.*','firms.*')->where("months.status1", "=", "W trakcie realizacji")->where("firms.kpir", "=", "KPiR")->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 
 
    $variable0=$start_date;
    $variable=$end_date;
    session()->put('variable0', $variable0);
    session()->put('variable', $variable);
  $project6=Month::join('firms','months.firm_id','=','firms.id')->select("months.id as czas",'months.*','firms.*')->where("months.status1", "=", "Zaplanowano")->where("firms.kpir", "=", "KPiR")->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 

    return View('month.list8',compact('today','user','firm','today2','project2','today3','project4','today4','start_date','end_date','month','project22','project6'));
}
public function searchkh(Request $request, UserRepository $userRepo, FirmRepository $firmRepo,MonthRepository $monthRepo){
        
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    
    if(empty($start_date)){
        $start_date = date('Y-m-01');
    }
    if(empty($end_date)){
        $end_date = date('Y-m-d');
    }
    $user = $userRepo->getAllUsers();
    $firm = $firmRepo->getAllFirmsActive();
    $month = $monthRepo->getAllMonths();
    $auth_user_id = auth::id();
    date_default_timezone_set('Europe/Warsaw');
    $today4=$request->input('start_date');
    $today3=$request->input('end_date');
    $today=now();
    $today2=date('H:i:s');
    $project2=Month::join('firms','months.firm_id','=','firms.id')->select("months.id as czas",'months.*','firms.*')->where("months.status1", "=", "Potwierdzone")->where("firms.kh", "=", "KH")->when($today4, function ($project3, $today4) {
        return $project3->where('close_date', '>=', $today4);
    })
    // ->where('date', '<=', $end_date)
    ->when($today3, function ($project3, $today3) {
    return $project3->where('close_date', '<=', $today3);
    })
    ->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 
    
    $suma=DB::table("months")
    ->join('firms','months.firm_id','=','firms.id')
    ->select('months.*','firms.*')
    ->where("firms.kh", "=", "KH")
    ->where("months.status1", "=", "W trakcie realizacji")
    ->get();

    $project22=Firm::leftJoin('months','months.firm_id','=','firms.id')->select('firms.*')->whereNotIn('firms.id', function ($query) use ($today4, $today3){
        $query->select('months.firm_id')->from('months')->when($today4, function ($project3, $today4) {
            return $project3->where('close_date', '>=', $today4);
        })
        // ->where('date', '<=', $end_date)
        ->when($today3, function ($project3, $today3) {
        return $project3->where('close_date', '<=', $today3);
        })
    ;
    })
    ->where("firms.kh", "=", "KH")
    ->where("firms.status", "=", "Aktywny")
    ->groupBy('firms.name')
    
    ->get();
$project4=Month::join('firms','months.firm_id','=','firms.id')->select("months.id as czas",'months.*','firms.*')->where("months.status1", "=", "W trakcie realizacji")->where("firms.kh", "=", "KH")->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 
 
    $variable0=$start_date;
    $variable=$end_date;
    session()->put('variable0', $variable0);
    session()->put('variable', $variable);
  $project6=Month::join('firms','months.firm_id','=','firms.id')->select("months.id as czas",'months.*','firms.*')->where("months.status1", "=", "Zaplanowano")->where("firms.kh", "=", "KH")->orderby('close_date',"desc")->orderby('close_time',"desc")->get();  

    return View('month.list10',compact('today','user','firm','today2','project2','today3','project4','today4','start_date','end_date','month','project22','project6'));
}
public function indexkh(UserRepository $userRepo, FirmRepository $firmRepo, TaskRepository $taskRepo,MonthRepository $monthRepo){
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    if(empty($start_date)){
        $start_date = date('Y-m-01');
    }
    if(empty($end_date)){
        $end_date = date('Y-m-d');
    }
   
    $user = $userRepo->getAllUsers();
    $firm = $firmRepo->getAllFirmsActive();
    $task = $taskRepo->getAllTasks();
    $month = $monthRepo->getAllMonths();
    $auth_user_id = Auth::id();
    date_default_timezone_set('Europe/Warsaw');
    $today=now();
    $today2=date('H:i:s');
    $today3=date('Y-m-d');
    $today4=date('Y-m-01');
    $variable0=$today3;
    $variable=$today4;
    session()->put('variable0', $variable0);
    session()->put('variable', $variable);


    $project2=Month::join('firms','months.firm_id','=','firms.id')->select("months.id as czas",'months.*','firms.*')->where("months.status1", "=", "Potwierdzone")->where("firms.kh", "=", "KH")->when($today4, function ($project3, $today4) {
        return $project3->where('close_date', '>=', $today4);
    })
    // ->where('date', '<=', $end_date)
    ->when($today3, function ($project3, $today3) {
    return $project3->where('close_date', '<=', $today3);
    })
    ->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 
    $project22=Firm::leftJoin('months','months.firm_id','=','firms.id')->select('firms.*')->whereNotIn('firms.id', function ($query) use ($today4, $today3){
        $query->select('months.firm_id')->from('months')->when($today4, function ($project3, $today4) {
            return $project3->where('close_date', '>=', $today4);
        })
        // ->where('date', '<=', $end_date)
        ->when($today3, function ($project3, $today3) {
        return $project3->where('close_date', '<=', $today3);
        })
    ;
    })
    ->where("firms.kh", "=", "KH")
    ->where("firms.status", "=", "Aktywny")
    ->groupBy('firms.name')
    ->get();
    $suma=DB::table("months")
    ->join('firms','months.firm_id','=','firms.id')
    ->select('months.*','firms.*')
    ->where("firms.kh", "=", "KH")
    ->where("months.status1", "=", "W trakcie realizacji")
    ->get();


$project4=Month::join('firms','months.firm_id','=','firms.id')->select("months.id as czas",'months.*','firms.*')->where("months.status1", "=", "W trakcie realizacji")->where("firms.kh", "=", "KH")->orderby('close_date',"desc")->orderby('close_time',"desc")->get(); 
$project6=Month::join('firms','months.firm_id','=','firms.id')->select("months.id as czas",'months.*','firms.*')->where("months.status1", "=", "Zaplanowano")->where("firms.kh", "=", "KH")->orderby('close_date',"desc")->orderby('close_time',"desc")->get();  

return View('month.list10',compact('project2','today','user','firm','task','today2','today3','project4','today4','start_date','end_date','month','suma','project22','project6'));}

public function updatekpirstatus($id)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
  


    $month = Month::find($id);
    
  
   
    $month ->close_time2=NULL;
    $month ->close_date2=NULL;
    $month ->uwagidodeklaracji=NULL;
    $month ->user_id2=NULL;
    $month ->status1="W trakcie realizacji";
    $month ->przelew=NULL;


    $month ->save();

    return redirect()->action('MonthController@indexkpir');
}
public function updatekhstatus($id)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
  


    $month = Month::find($id);
    
  
   
    $month ->close_time2=NULL;
    $month ->close_date2=NULL;
    $month ->uwagidodeklaracji=NULL;
    $month ->user_id2=NULL;
    $month ->status1="W trakcie realizacji";
    $month ->przelew=NULL;


    $month ->save();

    return redirect()->action('MonthController@indexkh');
}
}
