@extends('layouts.common')

@section('title', 'アーカイブリマインダー移動')


@section('content')
<div class="container">
  <div class="row justify-content-center">
   
  <h2 class="col-md-9">アーカイブ リマインダー　移動</h2>
  
    <!--アーカイブテーブルのデータをひっぱてきて表示するコードを書く。テキスト１５参照-->
     <div class="col-8">
      <div class="card">
      
      <div class="card-header">
       <div class="row">
        <h4 class="mb-0">カテゴリー名 </h4>
      <!--以下リマインダーモデルへ移動と消去のアクションを追加する-->
        <div class="offset-md-3 text-muted">
     　  <a class="text-muted" href="{{ action('CategoryController@archive') }}">
        <i class="fas fa-backward"></i>
       </a>
        &ensp;一覧へ戻る
      </div>
     </div>
     </div>
 
     <div class="card-body">
        
        <div class="form-group mb-0">
         <label for="question" class="mb-0 h3">Question</label>
         <textarea class="form-control" name="question" rows="5">編集前のデータ</textarea>
        </div>
        <div class="form-group">
         <label for="image" class="mb-0">画像</label>
         <input type="file" class="form-controle h5" name="image">
        </div>
        
        <div class="form-group">
         <label for="answer" class="mb-0 h3">Answer</label>
         <textarea class="form-control" name="answer" rows="5">編集前のデータ</textarea>
        </div>
         
        <div class="form-group">
         <label for="hint" class="mb-0 h3">ヒント</label>
         <input type="text" class="form-control" name="hint" value="編集前のデータ">
        </div> 
   
        <div class="form-group">
         <label for="comment" class="mb-0 h3">補足</label>
         <textarea class="form-control" name="comment" rows="5">編集前のデータ</textarea>
        </div>
        
        <div class="form-group">
         <label for="start" class="mb-0 h3">リマインド開始日</label>
         <input type="date" class="form-control" name="start" value="<?php echo date('Y-m-d');?>" min="<?php echo date('Y-m-d');?>">
        </div>
        
       
       <!--入力できるデータ型を正の整数のみにしたい。mim="1"で合っていますか？
       整数以外が入力されたらエラーになるようにする　←これは、コントローラの中にアクションを作らなくてはならないでしょうか？　-->
        <div class="form-inline">
          <label for="interval" class="mb-0 mr-5 h3">リマインド間隔</label>
            <input type="number" class="form-control" name="interval" style="width:50px" value="1" min="1" step="1">日おき
   　　     　 <a href="" class="btn-border">リマインドを作る</a>
        </div>
        
       <!--上記、リマインド間隔が表示されたら、5回分自動で計算され表示されるように設定する　←これも、上記と同じアクションに記入ですよね？
       タグはformでOK?-->
        <h3 class="mt-3">リマインド回数</h3>
         <table class ="remindtime">
          <!--↓for等で自動表示可能？-->
          <td width=200>1回目</td>
          <!--↓日付と時刻を一緒に選択できるUIにしたい-->
          <td width=200>2020/01/01</td>
          <td width=200>18:00</td>
         </table>
         
         <table class ="remindtime">
          <!--↓forとかで自動表示可能？-->
          <td width=200>2回目</td>
          <!--↓日付と時刻を一緒に選択できるUIにしたい-->
          <td width=200>2020/01/01</td>
          <td width=200>18:00</td>
        
         </table>
        </div>
 
     </div>
   </div>
   
  </div>
</div>
@endsection