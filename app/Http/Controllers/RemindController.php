<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Category;
use App\Remind;
use App\Schedule;

class RemindController extends Controller
{

    public function add (Request $request)
    {
        $categories = Category::find($request->id);
        return view('reminder.create',['categories' => $categories]);
    }
    
    
    public function create(Request $request)
    {
    // Varidation
      $this->validate($request, Remind::$rules);
      
    //リマインドテーブルsave
      $remind = new Remind;
      $form = $request->all();
      $reminds_at = $form['remind_at']; 

      unset($form['remind_at']);
      unset($form['_token']);
            
      $remind->fill($form)->save();
    
    // データ型確認（結果:stringだった）
    // $data = $request->remind_at;
    // foreach ($data as $value) {
    //     echo gettype($value), "\n";
    // }
    
    // スケジュールテーブルsave
      foreach($reminds_at as $remind_at){
        $schedule = new Schedule;
        $schedule->remind_id = $remind->id;
        
        $schedule->remind_at = $remind_at;
        $schedule->save();
      }
      
    return redirect(route('reminder', ['id' => $request->category_id]));
  }


    public function edit (Request $request)
    {
      $reminds = Remind::find($request->id);
      
      $categories = $reminds->category;
      
      $schedules = Schedule::where('remind_id' , $reminds->id)->get();
      // dd($schedules);
      
      return view('reminder.edit',['categories' => $categories , 'reminds' => $reminds , 'schedules' => $schedules]);
    }

    
    public function update(Request $request)
    {
      
      // Varidation
      $this->validate($request, Remind::$rules);
      
      //リマインドテーブルupdate
      $remind = Remind::find($request->id);
      $remind_form = $request->all();
      
      $reminds_at = $remind_form['remind_at']; 
      unset($remind_form['remind_at']);
      
      unset($remind_form['_token']);
      
      $remind->fill($remind_form)->save();
      
      //↓スケジュールテーブルsaveプロセス↓
      //1.既存のデータをすべて消す 
        $oldschedule=Schedule::where('remind_id' , $request->id)->get();
        $oldschedule->each->delete();
        
      //2.保存しなおす
        foreach($reminds_at as $remind_at){
          $schedule = new Schedule;
          $schedule->remind_id = $remind->id;
          
          $schedule->remind_at = $remind_at;
          $schedule->save();
        }
      
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
      
      $schedules = Schedule::where('remind_id' , $reminds->id)->get();
      // dd($schedules);
      
      return view('reminder.detail',['categories' => $categories , 'reminds' => $reminds , 'schedules' => $schedules]);
    }
      
}
