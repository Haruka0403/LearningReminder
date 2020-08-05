<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function top ()
    {
        return view('category.category');
    }
    
    public function search ()
    {
        return view('category.search');
    }
    
  public function archive ()
    {
        return view('archive.index');
    }
    
   public function remind ()
    {
        return view('reminder.index');
    }
}

