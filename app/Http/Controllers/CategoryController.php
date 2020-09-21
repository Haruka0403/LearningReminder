<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Category;

use App\Remind;

use App\Schedule;

use Illuminate\Support\Facades\Auth;

use Validator;

class CategoryController extends Controller
{
    public function top (Request $request)
    {
        $items = Category::all();
        $reminds = new Remind;
        return view('category.category',['items' => $items , 'reminds' => $reminds]);
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
    
      public function update (Request $request)
    {
        // sessionの中の調べかた
        // $data = $request->session()->all();
        // dd($data);
        
        $validator = Validator::make($request->all(), Category::$rules);
        
        if ($validator->fails()) {
          return redirect('/')->withErrors($validator)->withInput()->with('modal', 'modal02'.$request->id);
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
    
    
     public function delete (Request $request)
    {
        $categories = Category::find($request->id);
        $categories->delete();
 
        return redirect('/');
    }
    
    
    public function remind (Request $request)
    {
        $categories = Category::find($request->id);
        $reminds = $categories->reminds;
 
        return view('reminder.index',['categories' => $categories , 'reminds' => $reminds]);
    }
    
    public function search (Request $request)
    {
      $cond_title = $request->cond_title;
      
      if ($cond_title != '') {
        $reminds = Remind::where('question', 'like', '%'.$cond_title.'%')
        ->orWhere('answer', 'like', '%'.$cond_title.'%')
        ->orWhere('hint', 'like', '%'.$cond_title.'%')
        ->orWhere('comment', 'like', '%'.$cond_title.'%')
        ->get();
        // dd($reminds);

 // コントローラでcategory_nameを取得する方法
      //   $category_id = Remind::where('question', 'like', '%'.$cond_title.'%')
      //   ->orWhere('answer', 'like', '%'.$cond_title.'%')
      //   ->orWhere('hint', 'like', '%'.$cond_title.'%')
      //   ->orWhere('comment', 'like', '%'.$cond_title.'%')
      //   ->get('category_id');        
      //   // dd($category_id);
        
      //   $category_name = Category::where('id' , $category_id)->get();
      //   dd($category_name);
      // }
      // return view('category.search',['reminds'=>$reminds , 'cond_title'=>$cond_title , 'category_name'=>$category_name]);
      
      
//view側で 取得する方法
        $category = new Category;
      }
      return view('category.search',['reminds'=>$reminds , 'cond_title'=>$cond_title , 'category' =>$category ]);
    }
    
    public function ajax (Request $request)
    {
    // 実装できたらこっちに変更
      // $today = date("Y-m-d\TH:i");
      // $schedule = Schedule::where('remind_at' , $today)->first();
      // $remind = Remind::where('id' , $schedule->remind_id)->get();
        
    // テスト用
      $schedule = Schedule::where('remind_at' , '2020-09-17T13:09')->first();
      $remind = Remind::where('id' , $schedule->remind_id)->get();

        return $remind;
    }
    
    // 3.結果をresultテーブルに保存して　redirect back
    public function result (Request $request)
    {
      return redirect()->back();
    }
    
    public function giveup (Request $request)
    {
      return redirect()->back();
    }
}