<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Category;



class CategoryController extends Controller
{
    public function top (Request $request)
    {
        $posts = Category::all();
        return view('category.category',['posts' => $posts]);
    }
  
    public function create (Request $request)
    {
        $this->validate($request, Category::$rules);

        $category = new Category;
        $form = $request->all();
        
        // 以下あってもなくても良い？
        $category->user_id = null;
        
        unset($form['_token']);
        
        $category->fill($form);
        $category->save();
        
        return redirect('/');
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

