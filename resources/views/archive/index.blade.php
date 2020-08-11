@extends('layouts.common')

@section('title', 'アーカイブ一覧')


@section('content')
<div class="container">
  <div class="row justify-content-center">
   
  <h2 class="col-md-9">アーカイブ一覧</h2>
  
  <!--アーカイブテーブルのデータをひっぱてきて表示するコードを書く。テキスト１５参照-->
   
   <div class="col-md-8">
    <div class="card">
    
     <div class="card-header">
      <div class="row">
       <h4 class="mb-0">カテゴリー名 </h4>
   
  <!--移動（javascriptでポップアップが出てくる仕様にしてから編集画面へ移動-->
       <div class="offset-md-1 text-muted">
        <a class="text-muted" href="{{ action('ArchiveController@edit') }}">
        <i class="fas fa-file-export"></i></a>&ensp;移動
       </div>
  <!--消去-->
      <div class="offset-md-1 text-muted">
       <i class="far fa-trash-alt"></i>&ensp;消去
      </div>
      
      
    </div>
   </div>
   
  
  
    <div class="card-body">
     <div class="row">
     
     <a class="text-secondary" href="">
      <h5>Qestion</h5>
      <p>問題文が表示される</p>
      <h5>Answer</h5>
      <p>解答文が表示される</p>
      </a>
      
     </
     div>
   </div>
   
   </div>
  </div>
    
  </div>
</div>
@endsection