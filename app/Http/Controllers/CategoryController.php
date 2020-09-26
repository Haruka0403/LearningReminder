<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Category;

use App\Remind;

use App\Schedule;

use App\Result;

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
        
    // テスト用
      $schedule = Schedule::where('remind_at' , '2020-09-26T10:00')->first();
      
      $remind = Remind::find($schedule->remind_id);
      
      $response = array();
      $response['id'] = $remind->id;
      $response['question'] = $remind->question;
      $response['answer'] = $remind->answer;
      $response['hint'] = $remind->hint;
      $response['schedule_id'] = $schedule->id;

        return $response;
    }
    

    public function result (Request $request)
    {
    // 1:ヒントを見ずに正解
    // 2:ヒントを見て正解　 この数字のどちらかをResultテーブルに保存する
      $result = new Result;
    // schedule_id
      $result->schedule_id = $request->schedule_id;
    // result
      if ($request->hint == "hasHint"){
        $result->result = 2;
      }
      else{
        $result->result = 1;
      }
      unset($request['_token']);
      $result->save();
      
//↓リマインドが最終だった場合、オンロードで結果を表示する過程↓
  // 1.スケジュールテーブルへアクセスし、$request->id(remind_id)と一致するidとremind_atを全て取得
    $schedules_id = Schedule::where('remind_id' , $request->id)->get('id');
    $reminds_at = Schedule::where('remind_id' , $request->id)->get('remind_at');
    // dd($schedules_id->toArray());
    // dd($reminds_at);
    
  // 2.今日の日付を取得
    $today = date("Y-m-d\TH:i");
    // dd($today);

  // 3.1で受け取った日付の中に、未来があれば、redirect->back、
      //今日より過去のものしか無ければ、resultへアクセスし、1で取得したremind_idと紐づくschedule_idを持っているresultを取得
        foreach ($reminds_at as $remind_at){
          // dd($remind_at->remind_at);
          $remindDate = $remind_at->remind_at >= $today;
          if($remindDate){
            break;
          }
        };//foreach閉じタグ
        //false(0)なら全部過去、true(1)なら未来有りで表示される
        // dd($remindDate);
        
        if($remindDate){
          return redirect()->back();
        }
        else{
// 質問:以下の部分、remind_idに紐づく全てのschedule_idを保持するresult取得できていないといけないが、collectionの型のままだったら１番最後のschedule_idしか反映されなかった為配列に直した。
          $results = [0, 0, 0, 0];
          foreach($schedules_id as $schedule_id){
            $obj = Result::where('schedule_id' , $schedule_id->id)->first();
            // dd($results[$result->result]);
            if($obj != null){
              $num = $obj->result;
              $results[$num]++;
            }
            // dd($schedule_id->id); //←collectionの場合:id:38
            // dd($results); //←collectionの場合:データなし
          }; //foreach閉じタグ
          // dd($results); //←collectionの場合:id:40のみのresult /  配列の場合:3次元配列で全て取得できた
          
  // 4.3で取得した、リマインド及びスケジュールに紐づくresltの2つの結果(1:ヒント無し、2:ヒント付き)をそれぞれ数えた数を変数に入れてviewへ送る。
          //1.
          // return redirect()->back()->withInput()->with('results' , $results);
          
          //2.
          // $previousUrl = app('url')->previous();
          // return redirect()->to($previousUrl.'?'. http_build_query(['results'=>$results]))->withInput();
          
          //3.
          return redirect(route('result', ['results' => $results]));
        }
  }
    
    public function giveup (Request $request)
    
    {
    // 3:降参
      $result = new Result;
      $result->schedule_id = $request->schedule_id;
      $result->result = 3;
      unset($request['_token']);
      $result->save();
      return redirect()->back();
    }
}