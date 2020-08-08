<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Function extends Model
{
  
   //varidation
    protected $guarded = array('id');

    public static $rules = array(
      'reminds_id'=> 'required',
      'remind_times'=> 'required',
      'remind_at'=> 'required',
      );
}
