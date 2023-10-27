<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use App\Repositories\FirmRepository;
use App\Repositories\TaskRepository;
use Illuminate\Http\Request;
use App\Number;
use App\Project;
use App\User;
use App\Firm;
use DB;
use Datatables;
use Session;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class NumberController extends Controller
{
    protected $variable0;
    protected $variable;
    public function __construct(){
        $this->middleware('auth');
    
    }
    public function index(UserRepository $userRepo){
        if(Auth::user()->permissions != 'Administrator'){
            return redirect()->route('login');
        }
        $user = $userRepo->getAllUsersbeznieaktywnych();
       $number=Number::all();
       
                return View('number.list', compact('user','number'));
            }
            public function edit($id, UserRepository $userRepo)
            {
                if(Auth::user()->permissions != 'Administrator'){
                    return redirect()->route('login');
                }
                
            $number = Number::find($id);
            $user = $userRepo->getAllUsersbeznieaktywnych();

           
            return view('number.edit',compact('id','number', 'user'));
            }    
            
            public function update(Request $request, $id, UserRepository $userRepo)
            {
                if(Auth::user()->permissions != 'Administrator'){
                    return redirect()->route('login');
                }
                $user = $userRepo->getAllUsersbeznieaktywnych();
                date_default_timezone_set('Europe/Warsaw');
                $today3=date('Y-m-d'); 
                $today2=date('H:i:s');

            $request->validate([
                    
             
                            
               ]);
                $number = Number::where('id', $id)
                ->update([
                    'user_id2'=>$request->input('user_id2'),
                    'liczba'=>$request->input('liczba'),
                    'modification_date'=>$today3,
                    'modification_time'=>$today2
                    
                ]);
               
               
               
            
               
            
                return redirect()->action('NumberController@index')->with('Dane zostały zaktualizowane');
               
            } 
           
            public function store(Request $request)
            {
                if(Auth::user()->permissions != 'Administrator'){
                    return redirect()->route('login');
                }
                date_default_timezone_set('Europe/Warsaw');
                $today3=date('Y-m-d'); 
                $today2=date('H:i:s');

                $this->validate($request, [
                    'user_id' => 'required | unique:numbers'
                ],
                [
                    'user_id.unique' => 'Użytkownik jest już zapisany na liście, żeby dodać liczbę dni urlopu wypoczynkowego do wykorzystania musisz zrobić to przez edycję danych',
                    
                ]
            
            
            
            
            );
             
               
                $number = new Number;
                $number ->user_id=$request->input('user_id');
                $number ->user_id2=$request->input('user_id2');
                $number ->liczba=$request->input('liczba');
                $number ->modification_date=$today3;
                $number ->modification_time=$today2;
                $number ->save();
               
                return redirect()->action('NumberController@index');
            
            }

public function delete($id)
{
    if(Auth::user()->permissions != 'Administrator'){
        return redirect()->route('login');
    }
    $number = Number::find($id);
    $number->delete();
    return redirect()->action('NumberController@index')->with('success', 'Dane zostały usunięte');
}

}
