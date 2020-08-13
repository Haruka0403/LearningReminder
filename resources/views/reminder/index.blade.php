@extends('layouts.common')

@section('title', 'リマインダー　一覧')


@section('content')
<div class="container">
  <div class="row justify-content-center">
   
  <h2 class="col-md-7">リマインダー</h2>
  
  <!--リマインダー新規作成ボタン-->
  <div class="col-md-2">
     <button type="" class="btn-border"> 
       <a href="{{ action('RemindController@add') }}" class="text-light">+リマインダー</a>
     </button>
  </div>
  
  
  <!--アーカイブテーブルのデータをひっぱてきて表示するコードを書く。テキスト１５参照-->
   <div class="col-md-6">
    
     <input type="hidden" name="id" value="{{$category_data->id}}">
    
    <div class="card">
    
     <div class="card-header">
       <h4 class="mb-0">{{$category_data->name}}</h4>
     </div>
   
    <div class="card-body pb-0">
     <h5>
      <span style="border-bottom: solid 5px powderblue;">Question</span>
     </h5>
     <p>問題文が表示される</p>
      
     <h5>
      <span style="border-bottom: solid 5px powderblue;">Answer</span>
     </h5>
     <p class="mb-0">解答文が表示される</p>
    </div>
    
     <div class="text-right mr-3 mb-2" style="font-size: 80%;">
      詳細&ensp;<a href=""><i class="fas fa-angle-double-right text-muted"></i></a>
     </div>

<!--点線-->
    <div class="col-md text-center">
     <hr class="dotline m-0">
    </div>
    
    <div class="row justify-content-center m-2">
     <div class="col-md-4 text-center">
      移動&ensp;<i class="fas fa-file-export"></i>
     </div>
     <div class="col-md-4 text-center">
       消去&ensp;<i class="far fa-trash-alt"></i>
     </div>
    </div>

<!--線-->
    <hr class="mt-0 mb-0">

   </div>
  </div>
    
  </div>
</div>


@endsection