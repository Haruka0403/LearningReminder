@extends('layouts.common')

@section('title', 'リマインダー　一覧')


@section('content')
<div class="container">
  <div class="row justify-content-center">
  
<!--index-->
  <div class="col-md-12 pb-3"  style="font-size: 80%;">
    <a href="{{ action('CategoryController@top') }}" class="text-muted">カテゴリー 一覧</a>
    ＞ 
    リマインダー【{{ $categories->name }}】一覧
  </div>

  <h2 class="col-md-6 mb-3">リマインダー</h2>

<!--リマインダー新規作成ボタン-->
  <div class="col-md-2 mb-3">
    <a href="{{ action('RemindController@add',['id' => $categories->id ,'name' => $categories->name]) }}">
      <button class="btn-border">+ リマインダー</button>
    </a>
  </div>
  
<!--↓リマインダー中身一覧↓-->
  <div class="col-md-6">
    <div class="card mb-5">
  <!--カテゴリータイトル-->
      <div class="card-header">
        <div class="row">
          <h4 class="col-md-8 mb-0">{{$categories->name}}</h4>
        </div>
      </div>
 <!--↓リマインダー中身↓-->
    @if (0 == count($categories->reminds))
      <div class="card-body">
        リマインダーが登録されていません
      </div>

    @else
      @foreach($reminds as $remind)
       
  <!--id(hidden)-->
      <input type="hidden" name="id" value="{{$remind->id}}">
      <input type="hidden" name="category_id" value="{{$remind->category_id}}">

  <!--Question-->
      <div class="card-body pb-0">
       <h5>
        <span style="border-bottom: solid 5px powderblue;">Question</span>
       </h5>
       <p>{{\Str::limit ($remind->question), 100}}</p>

  <!--Answer-->
       <h5>
        <span style="border-bottom: solid 5px powderblue;">Answer</span>
       </h5>
       <p class="mb-0">{{\Str::limit ($remind->answer), 100}}</p>
      </div>
    
  <!--詳細画面移動ボタン-->
     <div class="text-right text-muted mr-3 mb-2" style="font-size: 80%;">
       詳細
        <a href="{{ action('RemindController@detail',['id' => $remind->id ]) }}">
          <i class="fas fa-angle-double-right text-muted"></i>
        </a>
     </div>

  <!--点線-->
    <div class="col-md text-center">
     <hr class="dotline m-0">
    </div>

  <!--↓編集と消去部↓-->
    <div class="row justify-content-center m-2">
     <!--編集--> 
     <div class="col-md-4 text-center text-dark">
      編集
      <a href="{{ action('RemindController@edit',['id' => $remind->id ]) }}">
        <i class="far fa-edit text-dark"></i>
      </a>
      </div>
     
    <!--消去-->
      <!-- ボタン -->
      <div class="col-md-4 text-center text-dark">
        消去
        <a href="" data-toggle="modal" data-target="#exampleModal{{$remind->id}}">
          <i class="far fa-trash-alt text-dark"></i>
        </a>
      </div>

      <!-- モーダル -->
      <div class="modal fade" id="exampleModal{{$remind->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-body">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
             
              <p>以下のリマインダーを消去しますが、よろしいでしょうか？</p>
              <p>消去したリマインドは元に戻せません。</p>
              <h5 class='text-center'>Question : {{$remind->question}}</h5>
              <h5 class='text-center'>Answer : {{$remind->answer}}</h5>
              
            </div>
            
            <div class="modal-footer">
              <button  type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
              <a href="{{ action('RemindController@delete',['id' => $remind->id , 'category_id' => $remind->category_id ]) }}"  type="button" class="btn btn-danger">消去</a>
            </div>
          </div>
        </div>
      </div>
 
    </div>

    <!--線-->
    <hr color=#ccc class="mt-0 mb-0">
    
    @endforeach
    @endif

    </div>
  </div>
    
  </div>
</div>

@endsection