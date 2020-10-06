@extends('layouts.common')

@section('title', '検索結果')


@section('content')
<div class="container">
  <div class="row justify-content-center">
    
    <h2 class="col-md-8 mt-3">【{{$cond_title}}】の検索結果一覧</h2>


    <div class="col-md-6">
      @if (0 == count($reminds))
      <p class ="mt-1">一致するリマインダーが見つかりませんでした。</p>
      
      @else
      @foreach($reminds as $remind)    
      <div class="card mb-3">
      
        <!--id(hidden)-->
        <input type="hidden" name="id" value="{{$remind->id}}">
        <input type="hidden" name="category_id" value="{{--$remind->category_id--}}">
        
        <!--card-hedder-->
        <div class="card-header">
          <h4 class="mb-0">{{ $remind->category->name }}</h4>
        </div>
        
        <!--card-body-->
        <div class="card-body pb-0">
        <!--Question-->
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
          <a href="{{ action('RemindController@detail',['id' => $remind->id ]) }}" class="text-muted">
            <i class="fas fa-angle-double-right"></i>
          </a>
        </div>
      
      </div>
      @endforeach
    @endif
    </div>

  </div>
</div>
@endsection



