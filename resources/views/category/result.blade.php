@extends('layouts.common')

@section('title', 'リマインド結果')


@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-7">
    
    <div class="card">
      <div class="card-body text-center">
        
        <h2>
          <span style="border-bottom: solid 5px powderblue;">結果発表</span>
        </h2>
        <h5 class="mt-4">お疲れ様です。以下のリマインドが全て終了しました！</h5>
        
        <div class= result_box>
          <h5>カテゴリー : {{ $remind->category->name }}</h5><br>
          <h5>問題 : {{ $remind->question }}</h5>
          <h5 class="mb-0">解答 : {{ $remind->answer }} </h5>
        </div>
  
          <div class="mt-3"> 
            <h5>ヒントを見ないで正解した回数 <i class="fas fa-angle-double-right"></i> {{ $results[1] }}回</h5><br>
            <h5>ヒントを見て正解した回数 <i class="fas fa-angle-double-right"></i> {{ $results[2] }}回<h5><br>
            <h5>降参した回数 <i class="fas fa-angle-double-right"></i> {{ $results[3] }}回</h5><br>
          </div>
          
        <!--点線-->
          <div class="col-md text-center">
           <hr class="dotline m-0">
          </div>          
        
        <!--詳細画面移動ボタン-->
         <h5 class= "mt-3">
           リマインダーを再設定する!
            <a href="{{ action('RemindController@detail',['id' => $remind->id ]) }}">
              <i class="fas fa-angle-double-right text-muted"></i>
            </a>
         </h5>
        
      </div>
    </div>

    </div>
  </div>
</div>
@endsection