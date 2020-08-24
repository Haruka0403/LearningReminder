<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

use App\Remind;

class RemindController extends Controller
{
    // public function detail (Request $request)
    // {
    // 設定中
    // }
    
    public function add (Request $request)
    {
        $categories = Category::find($request->id);
        
        return view('reminder.create',['categories' => $categories]);
    }
    
    
    public function create(Request $request)
    {
      
      // Varidation
      $this->validate($request, Remind::$rules);

      $remind = new Remind;
      $form = $request->all();

      // フォームから画像が送信されてきたら$remind->image_path に画像のパスを保存する
      if (isset($form['image'])) {
        $path = $request->file('image')->store('public/image');
        $remind->image_path = basename($path);
      } else {
          $remind->image_path = null;
      }

      // フォームから送信されてきた_tokenを削除
      unset($form['_token']);
      // フォームから送信されてきたimageを削除
      unset($form['image']);

      // データベースに保存する
      $remind->fill($form);
      $remind->save();
      
    //直接viewへ繋げるパターン 
      // $categories= Category::where('id' , $request ->category_id)->first();
      // $reminds=Remind::where('category_id' , $categories->id)->get();
      // return view('reminder.index')->with(['reminds' => $reminds, 'categories'=> $categories]);
      
    // sessionを使用するパターン
    //  $request->session()->put('category_id', $request->category_id);
   
    return redirect(route('reminder', ['id' => $request->category_id]));
}

  
}

