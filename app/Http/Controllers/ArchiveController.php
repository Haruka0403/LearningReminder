<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArchiveController extends Controller
{
    public function detail ()
    {
        return view('archive.detail');
    }
    
      public function edit ()
    {
        return view('archive.edit');
    }
}
