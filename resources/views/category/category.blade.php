@extends('layouts.common')

@section('title', 'トップ Learning Reminder')


@section('content')
<div id="app">
 
 <div class="container">
  <div class="row justify-content-center">
   <h2 class="col-md-6 mb-3">カテゴリー</h2>
   
 <!--モーダルボタン:新規作成-->
     <div class="col-md-2">
      <div class="js-modal-open" data-target="modal01">
       <button type="" class="btn-border mb-3"> + カテゴリー</button>
      </div>
     </div>
     
 <!--リマインダー関連-->
  　<table class="table table-light table-bordered rounded col-md-6">
   　 <tbody>
   　  @foreach($items as $item)
   　  
 <!--id(hidden)@createから送信されたカテゴリー名をredirect→@topを通し、viewに表示するためにidが必要-->
  　  <input type="hidden" name="id" value="{{$item->id}}">
   　  
 <!--リマインダーカテゴリ一覧--> 
   　  <tr>
    　  <td class="item_name" width=500>{{ \Str::limit($item->name, 50)}}</td>
    　   <!--中身をカウントして表示するコードを後で入れる-->
       <td width=200>10&ensp;
        <a href="{{ action('CategoryController@remind',['id' => $item->id ,'name' => $item->name]) }}">
         <i class="fas fa-angle-double-right text-dark"></i>
        </a>
       </td>
       
 <!--モーダルボタン：カテゴリ編集-->
 <!--<div class="modal" id="modal02{{$item->id}}" ←カテゴリ新規作成と同じモーダルを使用する場合これを利用する-->
        <td width=80>
          <a href="" class="js-modal-open" data-target="modal02{{$item->id}}">
            <i class="far fa-edit text-dark"></i>
          </a>          
        </td>
      
 <!--モーダルボタン：カテゴリ消去-->
    <!-- Button trigger modal -->
    <td width=80>
      <a href="" class="col-md-4 text-center text-muted" data-toggle="modal" data-target="#exampleModal{{$item->id}}">
       <i class="far fa-trash-alt text-dark"></i>
      </a>
    </td>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal{{$item->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-body">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
           
            <p>以下のカテゴリーを消去しますが、よろしいでしょうか？</p>
            <p>中のリマインダーも一緒に消去されます。</p>
            <p>消去したカテゴリー、リマインダーは元に戻せません。</p>
            <h5 class='text-center'>カテゴリー : {{$item->name}}</h5>

          </div>
          
          <div class="modal-footer">
            <button  type="button" class="btn btn-secondary" data-dismiss="modal">やめる</button>
            <a href="{{ action('CategoryController@delete',['id' => $item->id ]) }}"  type="button" class="btn btn-danger">消去</a>
          </div>
        </div>
      </div>
    </div>
    
   　  </tr>
   　@endforeach
   　</tbody> 
    </table>
 
   </div>
  </div>
 
 <!--モーダル新規作成-->
 <div id="modal01" class="modal js-modal">
  
  <div class="modal__bg js-modal-close"></div>
  
  <div class="modal__content">
   <p>新規カテゴリー作成</p>
   
    <form name="addcategory" action="{{ action('CategoryController@create') }}" method="post" enctype="multipart/form-data">
    @if (count($errors) > 0)
     <ul>
       @foreach($errors->all() as $e)
         <li>{{ $e }}</li>
       @endforeach
     </ul>
    @endif
    
    <div class="form-group">
     <input type="text" class="form-control" name="name" value="{{ old('name')}}">
    </div>
   
    {{ csrf_field() }}
    {{--<button type="submit" class="js-modal-close btn-border">作成</button>--}}
    <button type="submit" class="btn-border">作成</button>
   </form>
  </div>
  
 </div>

<!--モーダル編集-->
 @foreach($items as $item)
 <div id="modal02{{$item->id}}" class="modal js-modal">
  
  <div class="modal__bg js-modal-close"></div>
  
  <div class="modal__content">
   <p>カテゴリー名編集</p>
   
    <form name="addcategory" action="{{action('CategoryController@update')}}" method="post" enctype="multipart/form-data">
    @if (count($errors) > 0)
     <ul>
       @foreach($errors->all() as $e)
         <li>{{ $e }}</li>
       @endforeach
     </ul>
    @endif
    
    <div class="form-group">
     <input type="text" class="form-control" name="name" value="{{$item->name}}">
    </div>
   
    <input type="hidden" name="id" value="{{$item->id}}">
    {{ csrf_field() }}
    <button type="submit" class="btn-border">変更</button>
   </form>
  </div>
  
 </div>
@endforeach

</div>
@endsection

@section('js')
@php
if (Session::has('modal')) {
  $modal = session('modal');
} else {
  $modal = null;
}
@endphp
<script>
  window.onload = function() {
    @if(isset($modal))
      var target = '{{$modal}}';
      console.log('enter onload');
      console.log(target);
      if (target != null && target != '') {
        var modal = document.getElementById(target);
        $(modal).fadeIn();
      }
    @endif
    return false;
}
</script>
@endsection