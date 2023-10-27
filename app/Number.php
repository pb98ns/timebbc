<?php

namespace App;
use App\User;
use App\Firm;
use App\Task;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Number extends Model
{
    use HasFactory;
    protected $fillable= [
       'id', 'user_id', 'user_id2', 'liczba', 'modification_date', 'modification_time'
     ];
     public function user(){
         return $this->belongsTo(User::class,'user_id');
     }
     public function otheruser(){
        return $this->belongsTo(User::class,'user_id2');
    }
   
    protected $dates = [
        'modification_date', 'modification_time'
    ];
     public $timestamps = false;

}

