@extends('layouts.common')

@section('title', 'リマインド結果')


@section('content')
<div class="container">
  <div class="row justify-content-center">
    <div class="col-md-7">
    
    <div class="card">
      <div class="card-body text-center">
        <h2 class>
          <span style="border-bottom: solid 5px powderblue;">結果発表</span>
        </h2>
        <p>お疲れ様です。全てのリマインドが終了しました。</p>
         
            
            <p>ヒントを見ないで正解した回数{{ $results[1] }}回</p><br>
            <p>ヒントを見て正解した回数{{ $results[2] }}回</p><br>
            <p>降参した回数{{ $results[3] }}回</p><br>
        
      </div>
    </div>

    </div>
  </div>
</div>
@endsection