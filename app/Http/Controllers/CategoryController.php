<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Category;

use Illuminate\Support\Facades\Auth;

use Validator;



class CategoryController extends Controller
{
    public function top (Request $request)
    {
        $posts = Category::all();
        return view('category.category',['posts' => $posts]);
    }
  
    public function create (Request $request)
    {
        // 以下のコードだったら、自動で元の画面に戻る
        // $this->validate($request, Category::$rules);
        
        // varidatorのインスタンスを作る
        $validator = Validator::make($request->all(), Category::$rules);
        // varidorを実行して、もしエラーがあったら、
        if ($validator->fails()) {
        // withInput(エラーの対象のデータをそのまま渡す)
        // return...with('modal','modal01') 変数$modal= modal01 
          return redirect('/')->withErrors($validator)->withInput()->with('modal', 'modal01');
        }

        $category = new Category;
        $form = $request->all();
        
        // user_idをAuthから引っ張って来る
        $category->user_id = Auth::id();
        
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
        return view('reminder.index',['category_data' => $category]);
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
    
    // public function update (Request $request)
    // {
    //     // varidation
    //     $this->validate($request, Category::$rules);
        
    //     //Modelからデータを取得
    //     $category = Category::find($request->id);
        
    //     // 送信されてきたフォームデータを格納
    //     $category_deta = $request->all();
    //     unset($category_deta['_token']);

    //     // 該当するデータを上書きして保存する
    //     $category->fill($category_deta)->save();

    //     return redirect('/');
    // }
    
     public function get (Request $request)
    {
        $category = Category::find($request->id);
    
        return view('category.category',['category_delete' => $category]);
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

