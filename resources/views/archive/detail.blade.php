@extends('layouts.common')

@section('title', 'アーカイブリマインダー詳細')


@section('content')
<div class="container">
  <div class="row justify-content-center">
   
  <h2 class="col-md-9">アーカイブ リマインダー　詳細</h2>
  
 
   <div class="col-md-8">
    <div class="card">
     
  <!-- アーカイブテーブルのデータをひっぱてきて表示するコードを書く。テキスト１５参照-->
  <!--カテゴリー名-->
  <div class="card-header">
   <div class="row">
     <h4 class="mb-0">カテゴリー名 </h4>
  <!--移動（javascriptでポップアップが出てくる仕様にしてから編集画面へ移動-->
     <div class="offset-md-1 text-muted">
      <a class="text-muted" href="{{ action('ArchiveController@edit') }}">
       <i class="fas fa-file-export"></i></a>&ensp;移動
     </div>
  <!--消去-->
      <div class="offset-md-1 text-muted"><i class="far fa-trash-alt"></i>&ensp;消去</div>
  <!--一覧へ戻る-->
      <div class="offset-md-1 text-muted">
     　<a class="text-muted" href="{{ action('CategoryController@archive') }}">
        <i class="fas fa-backward"></i>
       </a>
        &ensp;一覧へ戻る
      </div>
    </div>
   </div>
 
  
  
   <div class="card-body">
    
     <h3>Qestion</h3>
      <p>問題文が表示される</p>
     <h3>Answer</h3>
      <p>解答文が表示される</p>
     <h3>ヒント</h3>
      <p>ヒント文が表示される</p>
     <h3>補足</h3>
      <p>補足文が表示される</p>
     
     <h3>リマインダースタート日</h3>
      <p>2020/01/01</p>
      
     <h3>リマインド間隔</h3>
      <table class ="remindtime">
       <td width=200>1回目</td>
       <td width=200>2020/01/01</td>
       <td width=200>18:00</td>
       <td width=200>済</td>
      </table>
     
      <!--<p>1回目　2020/01/03 18:00 済</p>-->
    </div>
    
   </div>
  </div>
 </div>
</div>
@endsection