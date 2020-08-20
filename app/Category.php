<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    //varidation
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required'
    );
    
    // 主モデルCategoryへ子モデルRemindの関連付けを記入
    public function reminds()
    {
      return $this->hasMany('App\Remind');

    }
}
