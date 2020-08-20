<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Remind extends Model
{
     //varidation
    protected $guarded = array('id');

    public static $rules = array(
        'question'=> 'required',
        'answer'=> 'required',
        'hint'=> 'required',
        'comment'=> 'required',
        'start_at'=> 'required',
    );
}
