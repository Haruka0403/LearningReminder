<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    //varidation
    protected $guarded = array('id');

    public static $rules = array(
        'reminds_id'=> 'required',
        'question'=> 'required',
        'answer'=> 'required',
        'hint'=> 'required',
        'comment'=> 'required',
        'start_at'=> 'required',
      );
}

