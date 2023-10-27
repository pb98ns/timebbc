<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Firm extends Model
{
  
    protected $fillable = [
        'name',
        'number',
        'place',
        'nip',
        'status',
        'kpir',
        'kh',
        'placezus'
        
    ];
    public $timestamps = false;
}