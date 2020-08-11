@extends('layouts.common')

@section('title', '学習リマインダートップ')


@section('content')

 
<div class="container">
 <div class="row justify-content-center">
  <h2 class="col-md-7">カテゴリー</h2>
  
    <!--モーダルボタン-->
    <div class="col-md-2">
     <div id="open">
      <button type="" class="btn-border"> +カテゴリー</button>
     </div>
    </div>
 
 　<table class="table table-light rounded col-md-6">
  　 <thead class="text-muted">
  　  <tr>
  　    <th width=500>アーカイブ一覧</th>
  　   <!--アーカイブテーブルの中身をカウントして表示するコード--->
  　    <th width=200> 10&ensp; <a href="{{ action('CategoryController@archive') }}"><i class="fas fa-angle-double-right text-muted"></i></a>
 　     </th>
  　    <th width=80></th>
       <th width=80></th>
  　  </tr>
  　</thead>

<!--消去、編集のコードはテキスト１６を参照する-->
  　 <tbody>
  　  @foreach($posts as $category)
  　  
  　  <input type="hidden" name="id" value="{{$category->id}}">
  　  
  　  <tr>
   　  <td width=500>{{ \Str::limit($category->name, 100)}}</td>
   　   <!--アーカイブテーブルの中身をカウントして表示するコードを後で入れる-->
      <td width=200>10&ensp;
       <a href="{{ action('CategoryController@remind',['id' => $category->id ,'name' => $category->name]) }}">
        <i class="fas fa-angle-double-right text-dark"></i>
       </a>
      </td>
 　    <td width=80><i class="far fa-edit"></i></td>
      <td width=80><i class="far fa-trash-alt"></i></td>
  　  </tr>
  　@endforeach
  　</tbody> 
   </table>

  </div>
 </div>
</div>

<!--モーダル設定-->
<!--背景-->
<div id="mask" class="hidden"></div>
 
<!--中身-->
<section id ="modal" class="hidden">
 
  <p>新規カテゴリー作成</p>
  
  
  <form action="{{ action('CategoryController@create') }}" method="post" enctype="multipart/form-data">
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
  
  <div id="make">
   {{ csrf_field() }}
   <button type="submit" class="btn-border">作成</button>
  </div>
 </form>
 
</section>
@endsection