@extends('layouts.common')

@section('title', 'リマインダー新規作成')

@section('content')
<div id="app">
  
<div class="container">
  <div class="row justify-content-center">
   
  <h2 class="col-md-9">リマインダー　新規作成</h2>
  
    <div class="col-md-8">
      <div class="card">

<!--↓ヘッダー部↓-->
      <div class="card-header">
       <div class="row">
         
  <!--カテゴリー名-->
        <h4 class="col-md-9 mb-0">{{$categories->name}} </h4>

  <!--一覧へ戻る-->
        <div class="mb-0" style="font-size: 80%;">
          <a href="{{action('CategoryController@remind') . '?id=' . $categories->id . '&name=' . $categories->name}}" class="text-muted">
            <i class="fas fa-backward"></i>&ensp;一覧へ戻る
          </a>
        </div>

       </div>
     </div>

<!--↓ボディ部(リマインダー作成部)↓-->
     <div class="card-body">
      <form action="{{ action('RemindController@create') }}" method="post" enctype="multipart/form-data">
      
  <!--varidation-->
      @if (count($errors) > 0)
      <ul>
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
      @endif 
      
  <!--id(hidden)-->
        <input type="hidden" name="category_id" value="{{$categories->id}}" >
        
  <!--1.Question-->
        <div class="form-group mb-0">
         <label for="question" class="mb-0 h3">Question</label>
         <textarea class="form-control" name="question" rows="5">
           {{ old('question') }}
         </textarea>
        </div>
        <hr class="text-muted">
        
  <!--2.Answer-->
        <div class="form-group">
         <label for="answer" class="mb-0 h3">Answer</label>
         <textarea class="form-control" name="answer" rows="5">
           {{ old('answer') }}
         </textarea>
        </div>
        <hr class="text-muted">
        
  <!--3.Hint-->
        <div class="form-group">
         <label for="hint" class="mb-0 h3">ヒント</label>
         <input type="text" class="form-control" name="hint" value="{{ old('hint') }}">
        </div> 
        <hr class="text-muted">
        
  <!--4.補足-->
        <div class="form-group">
         <label for="comment" class="mb-0 h3">補足</label>
         <textarea class="form-control" name="comment" rows="5">
           {{ old('comment') }}
         </textarea>
        </div>
        <hr class="text-muted">
        
  <!--5.リマインド回数-->
      <h3 class="mt-3">リマインド日程</h3>
      
      <div id="demo-area" class="form-group">
        <div class="unit input-group mb-2">
          
          <div class="input-group-prepend">
            <span class="input-group-text">1回目</span>
          </div>
        
          @php
          $today = date("Y-m-d\TH:i");
          @endphp
          
          <input id="remind_at" type="datetime-local" class="form-control" name="remind_at[]" value="{{ $today }}" min="{{ $today }}">

          <div class="demo-minus input-group-append">
            <span class="btn btn-danger">-</span>
          </div>
          
        </div>
      </div>

      <div id="demo-plus" class="btn btn-primary btn-sm">+追加</div>
      <hr class="text-muted">
         
  <!--6.作成ボタン-->
          <div class="form-row text-center mt-1">
            <div class="col-12">
              {{ csrf_field() }}
              <button type="submit" class="btn-border2">作 成</button>
            </div>
          </div>
         
         </form>
        </div>
 
     </div>
   </div>
   
  </div>
</div>

</div>

<!--datetime.js-->
<script src="{{ mix('js/datetime.js') }}"></script>
@endsection




