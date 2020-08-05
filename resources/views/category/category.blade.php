@extends('layouts.common')

@section('title', '学習リマインダートップ')


@section('content')
<div class="container">
 <div class="row justify-content-center">
  <h2 class="col-md-7">カテゴリー　一覧</h2>
    <!--カテゴリー新規作成のポップアップが出てくるよう以下を後で編集する-->
    <div class="col-md-2">
     <a href="" class="btn-border">+カテゴリー</a>
   </div>
 
  <div class="col-md-8">

 　<table class="table table-light rounded">
  　 <thead class="text-muted">
  　  <tr>
  　    <th width=500>アーカイブ一覧</th>
  　   <!--アーカイブテーブルの中身をカウントして表示するコード--->
  　    <th width=200> 10&ensp; <a href="{{ action('CategoryController@archive') }}"><i class="fas fa-angle-double-right text-muted"></i></a></th>
  　    <th width=80></th>
       <th width=80></th>
  　  </tr>
  　</thead>

<!--消去、編集のコードはテキスト１６を参照する-->
  　 <tbody>
  　  <tr>
  　    <td width=500>リマインダーモデルへアクセスするコード</td>
  　   <!--アーカイブテーブルの中身をカウントして表示するコード--->
  　    <td width=200>10&ensp;<i class="fas fa-angle-double-right"></i</td>
  　    <td width=80><i class="far fa-edit"></i></td>
       <td width=80><i class="far fa-trash-alt"></i></td>
  　  </tr>
  　
  　  <tr>
  　    <td width=500>リマインダーモデルへアクセスするコード</td>
  　   <!--アーカイブテーブルの中身をカウントして表示するコード--->
  　    <td width=200>10&ensp;<i class="fas fa-angle-double-right"></i</td>
  　    <td width=80><i class="far fa-edit"></i></td>
       <td width=80><i class="far fa-trash-alt"></i></td>
  　  </tr>
  　</tbody> 
   </table>

  </div>
 </div>
</div>
  
@endsection
   