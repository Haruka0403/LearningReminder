<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Category;

use App\Remind;

use Illuminate\Support\Facades\Auth;

use Validator;

class CategoryController extends Controller
{
    public function top (Request $request)
    {
        $items = Category::all();
        return view('category.category',['items' => $items]);
    }
  
    public function create (Request $request)
    {
        $validator = Validator::make($request->all(), Category::$rules);
        
      if ($validator->fails()) {
          return redirect('/')->withErrors($validator)->withInput()->with('modal', 'modal01');
        }
        
        $category = new Category;
        $form = $request->all();
        
        // user_idをAuthから引っ張って来る
        $category->user_id = Auth::id();
        
        unset($form['_token']);
        
        $category->fill($form);
        $category->save();
        
        return redirect('/');
      
    }
    
    // public function edit (Request $request)
    // {
    //     $category = Category::find($request->id);
    //     // if (empty($news)) {
    //     // abort(404);    
    //     // }
    //     //retunの場所をどこにするべきか分からない
    //     return view('category.category',['category_data' => $category]);
    // }
    
      public function update (Request $request)
    {
        $validator = Validator::make($request->all(), Category::$rules);
        
        if ($validator->fails()) {
          return redirect('/')->withErrors($validator)->withInput()->with('modal', 'modal02');
        }
        
        //Modelからデータを取得
        $category = Category::find($request->id);
        
        // 送信されてきたフォームデータを格納
        $category_name = $request->all();
        
        unset($category_name['_token']);

        // 該当するデータを上書きして保存する
        $category->fill($category_name)->save();

        return redirect('/');
    }
    
    public function remind (Request $request)
    {
        $categories = Category::find($request->id);
        $reminds = $categories->reminds;
 
        return view('reminder.index',['categories' => $categories , 'reminds' => $reminds]);
    }
    
 
    public function search ()
    {
        return view('category.search');
    }
 
 
//  ajax練習
    public function apiview()
    {
        return view('category.apiview');
    }     
}