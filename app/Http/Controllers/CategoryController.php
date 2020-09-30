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
      $items = Auth::user()->categories;
      $reminds = new Remind;
      return view('category.category',['items' => $items , 'reminds' => $reminds]);
    }

  
    public function create (Request $request)
    {
      // validation
      $validator = Validator::make($request->all(), Category::$rules);
      
      // validationに引っかかったらエラー文付けてmodalonloadで表示
      if ($validator->fails()) {
        return redirect('/')->withErrors($validator)->withInput()->with('modal', 'modal01');
      }
        
      $category = new Category;
      $form = $request->all();
      
      // user_id
      $category->user_id = Auth::id();
      
      unset($form['_token']);
      
      $category->fill($form);
      $category->save();
      
      return redirect('/');
    }

    
      public function update (Request $request)
    {
      $validator = Validator::make($request->all(), Category::$rules);
      
      if ($validator->fails()) {
        return redirect('/')->withErrors($validator)->withInput()->with('modal', 'modal02'.$request->id);
      }
      
      //Modelからデータを取得
      $category = Category::find($request->id);
      
      // 送信されてきたフォームデータを格納
      $category_name = $request->all();
      
      // token消去
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
      }
      
      return view('category.search',['reminds'=>$reminds , 'cond_title'=>$cond_title ]);
    }

    
    public function ajax (Request $request)
    {
    // 本番用
      $today = date("Y-m-d\TH:i");
      $schedule = Schedule::where('remind_at' , $today)->first();
        
    // テスト用
      // $schedule = Schedule::where('remind_at' , '2020-09-24T22:16')->first();
      
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
    // 2:ヒントを見て正解　
    // 3:降参 をそれぞれ保存
    
      $result = new Result;
      
    // schedule_id
      $result->schedule_id = $request->schedule_id;
      
    // result
      if ($request->hint == "hasHint"){
        $result->result = 2;
      }
      elseif($request->giveup == "hasGivup"){
         $result->result = 3;
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
    
    // dd($schedules_id);
    // dd($reminds_at);
    
    // 2.今日の日付を取得
      $today = date("Y-m-d\TH:i");
      // dd($today);

    // 3. 1で受け取ったremind_atの日付が未来なのか過去か確認。
      foreach ($reminds_at as $remind_at){
        // dd($remind_at->remind_at);
        $remindDate = $remind_at->remind_at >= $today;
        if($remindDate){
          break;
        }
      };
      //以下確認用。false(0)なら全部過去、true(1)なら未来有りで表示される
      // dd($remindDate);
    
    // 4.未来と過去で条件分岐。未来があれば、redirect->back、
    // 過去のものしか無ければ、resultへアクセスし、1で取得したremind_idと紐づくschedule_idを持っているresultを取得    
      if($remindDate){
        return redirect()->back();
      }
      else{
        $results = [0, 0, 0, 0];
        foreach($schedules_id as $schedule_id){
          $obj = Result::where('schedule_id' , $schedule_id->id)->first();
          // dd($results[$result->result]);
          // dd($obj);
          if($obj != null){
            $num = $obj->result;
            $results[$num]++;
          }
          // dd($schedule_id->id);
        }; 
        // dd($results); 
      
    // 5.リマインドの内容もviewに送るため取得
      $remind = Remind::find($request->id);
          
    // 6.viewへ
      return view('category.result',['results' => $results , 'remind' => $remind]);
  }
  }

}