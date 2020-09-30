@extends('layouts.common')

@section('title', 'リマインダー詳細')

@section('content')
<div id="app">
  
<div class="container">
  <div class="row justify-content-center">
    <h2 class="col-md-9 mb-3">リマインダー　詳細</h2>
  
    <div class="col-md-7">
      <div class="card">
      
      <div class="card-header">
       <div class="row">

<!--カテゴリー名-->
      <h4 class="col-md-8 mb-0">{{ $categories->name }}</h4>

<!--一覧へ戻る-->
      <div class="mb-0　text-muted" style="font-size: 80%;">
        <a href="{{ action('CategoryController@remind') . '?id=' . $categories->id . '&name=' . $categories->name }}" class="text-muted">
          <i class="fas fa-backward"></i>
        </a>
        一覧へ戻る
      </div>

       </div>
     </div>
 
     <div class="card-body">

<!--id(hidden)-->
      <input type="hidden" name="id" value="{{ $categories->id }}">
      <input type="hidden" name="id" value="{{ $reminds->id }}">
      <input type="hidden" name="category_id" value="{{$reminds->category_id}}">
      @foreach($schedules as $schedule)
        <input type="hidden" name="id" value="{{ $schedule->id }}">
      @endforeach
        
<!--1.Question-->
       <h5>
        <span style="border-bottom: solid 5px powderblue;">Question</span>
       </h5>
      <p>{{ $reminds->question}}</p>
      <hr class="text-muted">
      
<!--2.Answer-->
      <h5>
        <span style="border-bottom: solid 5px powderblue;">Answer</span>
      </h5>
      <p>{{ $reminds->answer}}</p>
      <hr class="text-muted">
        
<!--3.Hint-->
      <h5>
        <span style="border-bottom: solid 5px powderblue;">ヒント</span>
      </h5>
      <p>{{ $reminds->hint != null || '' ? $reminds->hint : '登録されていません' }}</P>
      <hr class="text-muted">
        
<!--4.補足-->
      <h5>
        <span style="border-bottom: solid 5px powderblue;">補足</span>
      </h5>
       <p>{{ $reminds->comment != null || '' ? $reminds->comment : '登録されていません' }}</p>
       <hr class="text-muted">
        
<!--6.リマインド回数-->
      <h5>
        <span style="border-bottom: solid 5px powderblue;">リマインド回数</span>
      </h5>
      
      <table class="row">
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
      
<!--点線-->
    <div class="col-md text-center">
     <hr class="dotline">
    </div> 
    
<!--編集(変数が複数形。indexは単数なので統一する）-->
      <div class="row justify-content-center mt-3">
        <h5 class="col-md-4 text-center">
          編集
          <a href="{{ action('RemindController@edit',['id' => $reminds->id ]) }}" class="text-muted">
            <i class="far fa-edit text-dark"></i>
          </a>
        </h5>
        
<!--消去-->
      <!-- Button trigger modal -->
        <h5 class="col-md-4 text-center">
          消去
          <a href="" class="col-md-4 text-center text-muted p-0" data-toggle="modal" data-target="#exampleModal{{$reminds->id}}">
            <i class="far fa-trash-alt text-dark"></i>
          </a>
        </h5>
      </div>

      <!-- Modal -->
      <div class="modal fade" id="exampleModal{{$reminds->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
             
              <p>以下のリマインダーを消去しますが、よろしいでしょうか？</p>
              <p>消去したリマインドは元に戻せません。</p>
              <h5 class='text-center'>Question : {{$reminds->question}}</h5>
              <h5 class='text-center'>Answer : {{$reminds->answer}}</h5>
              
            </div>
            
            <div class="modal-footer">
              <button  type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
              <a href="{{ action('RemindController@delete',['id' => $reminds->id , 'category_id' => $reminds->category_id ]) }}"  type="button" class="btn btn-danger">消去</a>
            </div>
          </div>
        </div>
      </div>
        
      </div>
      
      
     </div>
   </div>
   
  </div>
</div>

</div>


<!--datetime.js-->
<script src="{{ mix('js/datetime.js') }}"></script>

@endsection