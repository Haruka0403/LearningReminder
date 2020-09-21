<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
  // 主テーブル
    public function schedule(){
    return $this ->belongsTo('App\Schedule');
    }
}
