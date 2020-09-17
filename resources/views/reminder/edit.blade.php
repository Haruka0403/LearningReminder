@extends('layouts.common')

@section('title', 'リマインダー編集')

@section('content')
<div id="app">
  
<div class="container">
  <div class="row justify-content-center">
   
  <h2 class="col-md-9">リマインダー　編集</h2>
  
    <div class="col-md-7">
      <div class="card">
      
      <div class="card-header">
       <div class="row">

<!--カテゴリー名-->
      <h4 class="col-md-8 mb-0">{{ $categories->name }}</h4>

<!--一覧へ戻る-->
      <div class="mb-0" style="font-size: 80%;">
        <a href="{{ action('CategoryController@remind') . '?id=' . $categories->id . '&name=' . $categories->name }}" class="text-muted">
          <i class="fas fa-backward"></i>&ensp;一覧へ戻る
        </a>
      </div>

       </div>
     </div>
 
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
　　<div class="row">
      <h3 class="ml-3">リマインド回数</h3>

      <!--revise-->
        <a href="" id="remindAt_revise" class="ml-3" data-toggle="modal" data-target="#exampleModal">
          <i class="far fa-edit mt-2"></i>
        </a>
        
      <!--return-->
        <a href="" id="remindAt_return" class="ml-3" data-toggle="modal" data-target="#exampleModal2">
          <i class="fas fa-undo-alt mt-2"></i>
        </a>
      </div>
        
        <!--Modal(revise) -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                
                <p>リマインド回数を編集します。</p>
                <p>現在登録されているリマインド回数が全てリセットされます。</p>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                <button id="remindAt_edit" type="button" class="btn btn-primary">編集する</button>
              </div>
            </div>
          </div>
        </div>
      
        <!--Modal2(return) -->
        <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-body">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                
                <p>リマインド回数を元に戻しますか？</p>
                
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
                <button id="remindAt_edit2" type="button" class="btn btn-primary">戻す</button>
              </div>
            </div>
          </div>
        </div>
      
<!--編集前-->
      <table id="remindAt_table" class="row">
        <thead>
          <tr>
            @for ($i = 1; $i <= count($schedules); $i++)
            <th class= "table01">{{ $i }} 回目 <i class="fas fa-angle-double-right"></i> </th>
            @endfor
          </tr>
        </thead>

        <tbody>
          <tr>
            @foreach($schedules as $schedule)
            <td class = "table02">{{ $schedule -> remind_at }}</td>
            @endforeach
          </tr>
        </tbody>
      </table>
      
<!--編集画面-->
      <div id="remindAt_form">
        <div id="demo-area" class="form-group">
          <div class="unit input-group mb-2">
            
            <div class="input-group-prepend">
              <span class="input-group-text">1回目</span>
            </div>
            
          @php
          $today = date("Y-m-d\TH:i");
          @endphp
          
          {{--質問1--}}
            <input type="datetime-local" class="form-control" name="remind_at[]" value="{{ $today }}" min="{{ $today }}">
            <!--<input type="datetime-local" class="form-control" name="remind_at[]" value="{{-- $schedule -> remind_at --}}">-->
  
            <div class="demo-minus input-group-append">
              <span class="btn btn-danger">-</span>
            </div>
            
          </div>
        </div>

        <div id="demo-plus" class="btn btn-primary btn-sm">+追加</div>
      </div>
      
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

</div>

<!--datetime.js-->
<script src="{{ mix('js/datetime.js') }}"></script>
@endsection




