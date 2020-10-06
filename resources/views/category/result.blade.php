@extends('layouts.common')

@section('title', 'リマインド結果')


@section('content')
<div class="container mt-3">
  <div class="row justify-content-center">
    <div class="col-md-7">
    
      <div class="card">
        <div class="card-body text-center">
          
          <h2>
            <span style="border-bottom: solid 5px powderblue;">結果発表</span>
          </h2>
          
          <p class="mt-4">お疲れ様です。以下のリマインドが全て終了しました！</p>
          
          <!--点線-->
          <div class="col-md text-center">
           <hr class="dotline">
          </div> 

            <h5>カテゴリー : {{ $remind->category->name }}</h5>
            
            <p>
              <span style="border-bottom: solid 5px powderblue;">問題</span><br>
              {{ $remind->question }}
            </p>
            
            <p class="mb-0">
              <span style="border-bottom: solid 5px powderblue;">解答</span><br>
              {{ $remind->answer }} 
            <p>
    
          <div class="ribbon13-wrapper"> 
            <div class="ribbon13 mb-4">
              <p>Congratulations!</p>
            </div>
            <p><i class="fas fa-laugh-squint"></i>ヒントを見ないで正解した回数 : {{ $results[1] }}回<p>
            <p><i class="fas fa-grin"></i>ヒントを見て正解した回数 : {{ $results[2] }}回<p>
            <p><i class="fas fa-dizzy"></i>降参した回数 : {{ $results[3] }}回<p>
          </div>
            
          <!--点線-->
          <div class="col-md text-center">
           <hr class="dotline m-0">
          </div>          
          
          <!--詳細画面移動ボタン-->
            <h5 class= "mt-3">
            リマインダーを再設定する!
              <a href="{{ action('RemindController@detail',['id' => $remind->id ]) }}">
                <i class="fas fa-angle-double-right"></i>
              </a>
            </h5>
          
        </div>
      </div>

    </div>
  </div>
</div>
@endsection