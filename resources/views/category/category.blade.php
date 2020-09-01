@extends('layouts.common')

@section('title', '学習リマインダートップ')


@section('content')
<div id="app">
 
 <div class="container">
  <div class="row justify-content-center">
   <h2 class="col-md-6 mb-3">カテゴリー</h2>
   
 <!--モーダルボタン:新規作成-->
     <div class="col-md-2">
      <div class="js-modal-open" data-target="modal01">
       <button type="" class="btn-border mb-3"> +カテゴリー</button>
      </div>
     </div>
     
 <!--リマインダー関連-->
  　<table class="table table-light rounded col-md-6">
   　 <tbody>
   　  @foreach($items as $item)
   　  
 <!--id(hidden)@createから送信されたカテゴリー名をredirect→@topを通し、viewに表示するためにidが必要-->
  　  <!--<input type="hidden" id="id" name="id" value="{{$item->id}}">-->
   　  
 <!--リマインダーカテゴリ一覧--> 
   　  <tr>
    　  <td class="item_name" width=500>{{ \Str::limit($item->name, 50)}}</td>
    　   <!--中身をカウントして表示するコードを後で入れる-->
       <td width=200>10&ensp;
        <a href="{{ action('CategoryController@remind',['id' => $item->id ,'name' => $item->name]) }}">
         <i class="fas fa-angle-double-right text-dark"></i>
        </a>
       </td>
       
 <!--モーダルボタン：リマインダーカテゴリ編集-->
       <td width=80 class="pt-1 pb-0">
        <!--category_idをajaxに送る-->
        <input type="hidden" class="edit_c_id" name="id" value="{{$item->id}}">
        
        <!--3.レイアウト崩れ-->
          <button class='c_edit btn-white' type="submit" data-toggle="modal" data-target="#exampleModalCentered">
            <i class="far fa-edit text-dark"></i>
          </button>
       </td>
       
      <!-- Modal -->
        <div class="modal" id="exampleModalCentered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredLabel">カテゴリー名編集</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
      <!--form-->
            <!--validation表示用-->
              <div class ="validation"></div>
            <!--form-->
              <div class="modal-body">
                <input class="name" name="name" class="form-control" type="text" value="{{$item->name}}">
              </div>
            <!--編集データのテスト-->
              <div class="test"></div>
      <!--button-->
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
               
                <button type="button" class="btn btn-primary" id="submit" name="submit">
                 送信
                </button>
              </div>
            </div>
          </div>
        </div>
       
       
       
 <!--モーダルボタン：リマインダーカテゴリ消去-->
       <td width=80>
        <a class="js-modal-open" href="" data-target="modal03">
         <i class="far fa-trash-alt text-dark"></i>
         </a>
       </td>
       　
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

 
 <!--モーダル消去ボタン-->
 <div id="modal03" class="modal js-modal">
  
  <div class="modal__bg js-modal-close"></div>
  
  <div class="modal__content">
   
     <input type="hidden" name="id" value="">
     <p>『○○』を消去しますか？</p>
     
     <button type="submit" class="js-modal-close btn btn-danger">消去</bottun>
  </div>
  
 </div>

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