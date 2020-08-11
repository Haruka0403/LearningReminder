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
        // $category->user_id = null;
        
        unset($form['_token']);
        
        $category->fill($form);
        $category->save();
        
        // もしエラーがあったら、モーダルウィンドウ のままエラーを表示
        // なければトップ画面に戻る
        // if (count($errors) > 0) {
            
        // }
        return redirect('/');
    }
    
    public function remind (Request $request)
    {
        $category = Category::find($request->id);
    // 以下を入力すると、そっちが反映されるのはなぜか（idをhiddnにしているから..?
    //     if (empty($cotegory)) {
    //     abort(404);    
    //   }
        return view('reminder.index',['category_deta' => $category]);
    }
    
    
    
    
    public function search ()
    {
        return view('category.search');
    }
    
  public function archive ()
    {
        return view('archive.index');
    }
    
   
}

