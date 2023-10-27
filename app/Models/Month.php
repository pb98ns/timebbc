<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\User;
use App\Firm;
use App\Project;

class Month extends Model
{
    use HasFactory;
  
    protected $fillable = [
       'id','firm_id','user_id','user_id2','close_date','close_time','close_time2','close_date2','close_time3','close_date3','uwagi','uwagidokorekty','amortyzacja','cit','jpk','vat','pit5_cit','pismo','korekta','vat_ue','vat_uea','vat_ueb','vat_uec','vat_27','akc','cit_st','status1','przelew','uwagidodeklaracji'
        
    ];
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function firm(){
       return $this->belongsTo(Firm::class,'firm_id');
   }
    public $timestamps = false;
}