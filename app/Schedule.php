<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
  
   //varidation
    protected $guarded = array('id');

    public static $rules = array(
        'remind_at[]'=> 'required',
        );
      
  // 主テーブル
    public function remind(){
    return $this ->belongsTo('App\Remind');
    } 
  
}
