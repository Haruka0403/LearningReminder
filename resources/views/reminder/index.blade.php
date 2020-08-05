@extends('layouts.common')

@section('title', 'リマインダー　一覧')


@section('content')
<div class="container">
  <div class="row">
   
  <h2 class="col-9 mx-auto">リマインダー　一覧</h2>
  
  <!--リマインダーテーブルのデータをひっぱてきて表示するコードを書く。テキスト１５参照-->
   <div class="col-8 pt-2 pb-2 mb-3 mx-auto bg-light rounded">
     <h4 class="mb-0">カテゴリー名 </h4>
   </div>
  </div>
  
  <!--消去、編集のコードを追記-->
  <div class="row">
   <div class="offset-md-8 text-secondary">
    <i class="fas fa-file-export"></i>移動 &ensp;
    <i class="far fa-trash-alt"></i>消去
    </div>
  </div>
  
  <div class="row">
   <div class="col-8 mb-2 mx-auto bg-light rounded">
    
    <a class="text-secondary" href="">
     <h5>Qestion</h5>
     <p>問題文が表示される</p>
     
     <h5>Answer</h5>
     <p>解答文が表示される</p>
     </a>
     
    </div>
  </div>
  
  
  
  <!--以下テスト表示-->
   <div class="row">
   <div class="offset-md-8 text-secondary">
    <i class="fas fa-file-export"></i>移動 &ensp;
    <i class="far fa-trash-alt"></i>消去
    </div>
  </div>
  
  <div class="row">
  <div class="col-8 mb-2 mx-auto bg-light rounded">
   <a class="text-secondary" href="">
    <h5>Qestion</h5>
    <p>問題文が表示される</p>
    <h5>Answer</h5>
    <p>解答文が表示される</p>
    </a>
  </div>
  </div>
 
</div>
@endsection