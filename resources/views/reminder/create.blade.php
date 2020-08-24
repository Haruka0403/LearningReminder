@extends('layouts.common')

@section('title', 'リマインダー新規作成')

@section('content')
<div id="app">
  
<div class="container">
  <div class="row justify-content-center">
   
  <h2 class="col-md-9">リマインダー　新規作成</h2>
  
    <div class="col-md-8">
      <div class="card">
      
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
      
<!--カテゴリーid(hidden)-->
        <input type="hidden" name="category_id" value="{{$categories->id}}" >
        
<!--1.Question-->
        <div class="form-group mb-0">
         <label for="question" class="mb-0 h3">Question</label>
         <textarea class="form-control" name="question" rows="5">
           {{ old('question') }}
         </textarea>
        </div>
<!--Question 画像-->
        <div class="form-group">
         <label for="image" class="mb-0">画像</label>
         <input type="file" class="form-controle-file h5" name="image">
        </div>
      
<!--点線-->
      <div class="col-md text-center">
        <hr class="dotline">
      </div>
        
<!--2.Answer-->
        <div class="form-group">
         <label for="answer" class="mb-0 h3">Answer</label>
         <textarea class="form-control" name="answer" rows="5">
           {{ old('answer') }}
         </textarea>
        </div>
        
<!--点線-->
      <div class="col-md text-center">
        <hr class="dotline">
      </div>
        
<!--3.Hint-->
        <div class="form-group">
         <label for="hint" class="mb-0 h3">ヒント</label>
         <input type="text" class="form-control" name="hint" value="{{ old('hint') }}">
        </div> 
        
<!--点線-->
      <div class="col-md text-center">
        <hr class="dotline">
      </div>  
        
<!--4.補足-->
        <div class="form-group">
         <label for="comment" class="mb-0 h3">補足</label>
         <textarea class="form-control" name="comment" rows="5">
           {{ old('comment') }}
         </textarea>
        </div>
        
<!--点線-->
      <div class="col-md text-center">
        <hr class="dotline">
      </div>
        
<!--5.リマインド開始日-->
        <div class="form-group">
         <label for="start" class="mb-0 h3">リマインド開始日</label>
         <input type="date" class="form-control" name="start_at" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}">
        </div>
        
<!--点線-->
      <div class="col-md text-center">
        <hr class="dotline">
      </div>
        
<!--6.リマインド間隔-->
        <!--リマインド間隔が表示されたら、下の回数に5回分自動で計算され表示されるように設定する-->
        <h3 class="mt-3">リマインド間隔</h3>
          <table>
            <tbody>
              
            <td width=100>
              <input type="number" class="form-control" name="" style="width:100px" value="1" min="1" step="1">
            </td>
              
            <td width=100>
              <p class="mb-0">日おき</p>
            </td>

            <td width=300>
              <a href="" class="btn btn-primary btn-sm">リマインドを作る</a>
            </td>
            
            </tbody>
          </table>
          
<!--点線-->
      <div class="col-md text-center">
        <hr class="dotline">
      </div>
      
<!--7.リマインド回数-->
      <h3 class="mt-3">リマインド回数</h3>
      
      <div id="demo-area" class="form-group">
        <div class="unit input-group mb-2">
          
          <div class="input-group-prepend">
            <span class="input-group-text">1回目</span>
          </div>
          
<!--name=remind_atを後で追加-->
          <input type="datetime-local" class="form-control" name="" value="{{ date('Y-m-d') }}" min="{{ date('Y-m-d') }}">

          <div class="demo-minus input-group-append">
            <span class="btn btn-danger">-</span>
          </div>
        </div>
      </div>
      
      <div id="demo-plus" class="btn btn-primary btn-sm">+追加</div>
      
<!--点線-->
      <div class="col-md text-center">
        <hr class="dotline">
      </div>
         
<!--8.作成ボタン-->
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




