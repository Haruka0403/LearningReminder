<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    // protected $fillable = ['result'];
    
  // 主テーブル
    public function schedule(){
    return $this ->belongsTo('App\Schedule');
    }
}
