@extends('layouts.common')

@section('title', 'リマインダー編集')

@section('content')
<div id="app">
  
<div class="container">
  <div class="row justify-content-center">
    
  <!--index-->
  <div class="col-md-12 pb-3"  style="font-size: 80%;">
    <a href="{{ action('CategoryController@top') }}" class="text-muted">カテゴリー</a>
    ＞ 
    <a href="{{action('CategoryController@remind') . '?id=' . $categories->id . '&name=' . $categories->name}}" class="text-muted">リマインダー{{ $categories->name }}一覧</a>
    ＞
    リマインダー編集
  </div>
   
  <h2 class="col-md-8 mb-3">リマインダー　編集</h2>
  
    <div class="col-md-7">
      <div class="card mb-5">
 
 <!--カテゴリー名-->     
      <div class="card-header">
        <div class="row">
          <h4 class="col-md-8 mb-0">{{ $categories->name }}</h4>
        </div>
      </div>

<!--↓編集画面↓-->
     <div class="card-body">
      <form action="{{ action('RemindController@update') }}" method="post" enctype="multipart/form-data">
<!--varidation-->
      @if (count($errors) > 0)
      <ul>
        @foreach($errors->all() as $e)
          <li>{{ $e }}</li>
        @endforeach
      </ul>
      @endif 
      
<!--id(hidden)-->
      <input type="hidden" name="id" value="{{ $categories->id }}">
      <input type="hidden" name="id" value="{{ $reminds->id }}">
      <input type="hidden" name="category_id" value="{{$reminds->category_id}}">
      
<!--1.Question-->
        <div class="form-group mb-0">
         <label for="question" class="mb-0 h3">Question</label>
         <textarea class="form-control" name="question" rows="5">
           {{ $reminds->question}}
         </textarea>
        </div>
        <hr class="text-muted">
        
<!--2.Answer-->
        <div class="form-group">
         <label for="answer" class="mb-0 h3">Answer</label>
         <textarea class="form-control" name="answer" rows="5">
           {{ $reminds->answer}}
         </textarea>
        </div>
        <hr class="text-muted">
        
<!--3.Hint-->
        <div class="form-group">
         <label for="hint" class="mb-0 h3">ヒント</label>
         <input type="text" class="form-control" name="hint" value="{{ $reminds->hint }}">
        </div> 
        <hr class="text-muted">
        
<!--4.補足-->
        <div class="form-group">
         <label for="comment" class="mb-0 h3">補足</label>
         <textarea class="form-control" name="comment" rows="5">
           {{ $reminds->comment}}
         </textarea>
        </div>
        <hr class="text-muted">
        
<!--5.リマインド回数-->
      <h3>リマインド回数</h3>

      <div id="demo-area" class="form-group">
        @php $i = 1; @endphp
        @foreach($schedules as $schedule)
          <div class="unit input-group mb-2">
            
            <div class="input-group-prepend">
              <span class="input-group-text">{{$i}}回目</span>
            </div>

            <input type="datetime-local" class="form-control" name="remind_at[]" value="{{ $schedule -> remind_at }}" min="">
          
            <div class="demo-minus input-group-append">
              <span class="btn btn-danger">-</span>
            </div>
            
          </div>
        @php $i++; @endphp
        @endforeach
      </div>

      <div id="demo-plus" class="btn btn-primary btn-sm">+追加</div>
      
      <hr class="text-muted">
         
<!--6.作成ボタン-->
          <div class="form-row text-center mt-1">
            <div class="col-12">
              {{ csrf_field() }}
              <button type="submit" class="btn-border2">更 新</button>
            </div>
          </div>
         
         </form>
 
     </div>
   </div>
   
  </div>
</div>

</div>

<!--datetime.js-->
<script src="{{ mix('js/datetime.js') }}"></script>
@endsection

