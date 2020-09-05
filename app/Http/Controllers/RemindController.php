<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Category;

use App\Remind;

class RemindController extends Controller
{

    public function add (Request $request)
    {
        $categories = Category::find($request->id);
        
        return view('reminder.create',['categories' => $categories]);
    }
    
    
    public function create(Request $request)
    {
      dd($request->remind_at);
      
      // Varidation
      $this->validate($request, Remind::$rules);
      
//リマインドテーブル
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
      
//   ファンクションテーブル 
      foreach($request->remind_at as $remind_at){
// 質問1、以下のエラー(テーブル名がfunctionだから？名前変更したほうがいいですか？)　A.名前を変更する
      $function = new Function;
      
// 質問2、リマインドテーブルとファンクションテーブルはなぜ分けたのでしょうか？ A.レコードが何個になるかわからないものを保存する為

      
// 質問4、リマインドスタート日(リマインドテーブル）と回数は必要ですか？A.いらない

// 質問5、リマインド回数は、countでも取得できる？(countは配列の中身を数えるので、どこかで配列を作らないといけない？）いらない
// （jqueryで作成したelements.lengthが回数にあたるので、その数をここに反映できるならそっちのほうが良い？） A.そもそもいらない
//     remind_times
//       $function->remind_times = count()
      
// 質問6、レコードが何個になるかわからないものを保存する場合(googleシート) A.viewでnameの箇所を配列[]にする
// 　　remind_at

// 　　  データベースに保存する
//       $function->fill($form);
//       $function->save();
    return redirect(route('reminder', ['id' => $request->category_id]));
    }

    public function edit (Request $request)
    {
      $reminds = Remind::find($request->id);
      
      // $categories = [$reminds->category->id , $reminds->category->name];
      $categories = $reminds->category;
      
      // $functions = Function::find($request->id);
      
      return view('reminder.edit',['categories' => $categories , 'reminds' => $reminds]);
    }
    
    public function update(Request $request)
    {
      
      // Varidation
      $this->validate($request, Remind::$rules);
      
//リマインドテーブル
      $remind = Remind::find($request->id);
      $remind_form = $request->all();
      unset($remind_form['_token']);
      

      $remind->fill($remind_form)->save();
      return redirect(route('reminder', ['id' => $request->category_id]));
      }
      
      public function delete(Request $request)
    {
      $remind = Remind::find($request->id);
      $remind->delete();
      
      return redirect(route('reminder', ['id' => $request->category_id]));
    }
    
    
    
    public function detail(Request $request)
    {
      $reminds = Remind::find($request->id);
      $categories = $reminds->category;
      // $functions = Function::find($request->id);
      
      return view('reminder.detail',['categories' => $categories , 'reminds' => $reminds]);
    }
      
}
