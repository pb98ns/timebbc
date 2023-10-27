<?php

namespace App;
use App\User;
use App\Firm;
use App\Task;
use App\Project;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;
    protected $fillable= [
       'id', 'user_id', 'plan_date','plan_type'
     ];
     public function user(){
         return $this->belongsTo(User::class,'user_id');
     }
     
     public $timestamps = false;

}
