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
        $category = Category::find($request->id);
        
        return view('reminder.create',['category' => $category]);
    }
    
    
    public function create(Request $request)
        {
      
      // Varidation
      $this->validate($request, Remind::$rules);

      $remind = new Remind;
      $form = $request->all();

      // category_id(なくてもいいような気がする)
      // $remind->category_id = $form['category_id'];

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
      
      // remindテーブルの値について、トップからのアクセスでは正常に反映できているが、新規作成からだとエラーになってしまう（保存はできている）
      // 以下のredirectが問題であるっぽい（パラメータはリダイレクトでは送れない）
      
      // withの使い方を確認後、以下三行のコーディングを新たに実装する
      // いじるファイル:1.R.Contoroller@create 2.R.Contoroller@remind 3.remind/index.blade
      // $category_id = $form['category_id'];
      // $posts = Remind::where('category_id' , $category_id)->get(['id' , 'category_id' , 'question' , 'answer']);
      // return redirect('/reminder') ->with('posts' , $posts);
      
      // ↓こいつが問題
      return redirect('/reminder');
}

}

