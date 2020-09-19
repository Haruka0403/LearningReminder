<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    {{-- 共通のcss --}}
    <link href="{{ secure_asset('css/common.css') }}" rel="stylesheet">
    
<!--通知モーダルjs-->
<script>
var modalon=false;

function erasemodal(){
  document.getElementById('remind_answer').value = "";
  $('#js_remind_modal').fadeOut();
  modalon = false;
  return false;
}

$(function(){
    setInterval(update, 10000);
  });
  
function update(){
  if (modalon) {
    return false;
  }
  
//ajaxでデータ取得 
$.ajax({
  url: '/ajax', 
  type: 'GET', 
  data: {},
  dataType: 'json' 
    })

 .done(function(response) {
   console.log(response);
   
  for(var i=0; i<Object.keys(response).length; i++){
    var answer = response[i].answer;
    var hint = response[i].hint;
    // document.getElementById("remind_id").value = response[i].id;
    document.getElementById("hidden_remind_id").value = response[i].id;
    document.getElementById("hidden_remind_id_giveup").value = response[i].id;
    document.getElementById("remind_question").textContent　= response[i].question;
    
    if(hint == null || ""){
      document.getElementById("remind_hint").textContent = "ヒントが登録されていません";
    }
    else{
      document.getElementById("remind_hint").textContent = "ヒント！" + hint;
    }
    
    document.getElementById("show_answer").textContent = "正解は" + answer + "でした!";
  } //forの閉じタグ


// モーダルfadeIn
  var js_remind_modal = document.getElementById('js_remind_modal');
  console.log(js_remind_modal);
  
//1.問題表示→2.ヒント→3.降参,正解を表示してモーダルを閉じる
//1.問題表示→2.ヒント
 $("#remind_hint").hide();
 
  $('#show_hint').click('on', function(){
    $('#hide_show_hint').hide();
    $("#remind_hint").show();
    
    $("#hide_giveup").show();
  });

// 答え提出（ajax使わないパターン)
  $('#remind_submit').click('on', function(){
    var toSend = $('#remind_answer').val();
    if(toSend == answer){
      // alert('正解です！');
      // return erasemodal();
      
    // 1.htmlにidを送る ※for内に記入しないと送信できなかった為、上記63行目。
    	document.resultform.action="/result";
    	document.resultform.method="post";
    	document.resultform.submit();
    	
    	 alert('正解です！');
  }
    
    else{
     alert('不正解です。もう一度答えを記入してください。');
    }
  });
  
//2.ヒント→3.降参
$("#hide_giveup").hide();
$("#show_answer").hide();
$("#remind_modal_close").hide();
  
  $(function(){
  $(document).on('click','#giveup', function() {
  // $('#giveup').click('on', function(){
    $('#hide_by_giveup').hide();
    $("#show_answer").show();
    $("#remind_modal_close").show();
    });
  });
  
  $(js_remind_modal).fadeIn();
  modalon = true;
  return false;
  
// 降参：モーダルをfadeOut
//   $(function(){
//   $(document).on('click','#remind_modal_close', function() {
//   //   alert('テスト');
//   //   return erasemodal();
  
//   document.giveupform.action="/giveup";
// 	document.giveupform.method="post";
// 	document.giveupform.submit();
// 	});
// });
  
}) //doneの閉じタグ
 
  .fail(function() {
    // console.log(response);
});
}
</script>
    
</head>

    
<body>

     <nav class="navbar navbar-expand shadow-sm">
      <div class="container">
             
        <!--ロゴ-->
        <a class ="navbar-brand text-muted" href="{{ action('CategoryController@top') }}">
          Learning Reminder
        </a> 
        
        
        <ul class="navbar-nav ml-auto">
          
          <!--検索-->
          <li class="nav-item">
            <form action="{{ action('CategoryController@search') }}" method="get">
              <div class="input-group">
                
                <!--検索フォーム-->
                  <input type="text" class="form-control" name="cond_title" placeholder="search">
                
                <!--ボタン-->
                  
                  <span class="input-group-btn">
                  {{ csrf_field() }}
                  <button type="submit" class="btn btn-secondary form-control">
                    <i class="fas fa-search"></i>
                  </button>
                  
              </div> 
           </form>
          </li> 
       
       
          <!--ログイン-->
          @guest
          <li class="nav-item">
            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
          </li>
                    
          <!--ログアウト-->
          @else
         <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-muted" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            {{ Auth::user()->name }} <span class="caret"></span>
            </a>

            <div id="navbarDropdown" class="dropdown-menu" aria-labelledby="navbarDropdown">
              <a class="dropdown-item" href="{{ route('logout') }}"
                 onclick="event.preventDefault();
                               document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>
            
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
              　@csrf
              </form>
            </div>
          </li> 
          @endguest
          
        </ul>
      </div>      
    </nav>

    <section class="mt-3">
      <div id="app">
        @yield('content')
      </div>
    </section>
    
<!--通知モーダル-->
      <div id="js_remind_modal" class="modal">
       <div class="modal__bg js-remind-modal-close"></div> <!--影-->
          <div class="modal__content">

<!--ヒントを表示する-->
          <div id="hide_show_hint" style="font-size: 60%;" class="text-muted text-right">
            <a id="show_hint"><i class="far fa-lightbulb"></i></a>
            ヒントを表示する
          </div>
<!--降参する-->
          <div id="hide_giveup" style="font-size: 60%;" class="text-muted text-right">
            <a id="giveup"><i class="far fa-dizzy"></i></a>
            降参する
          </div>
<!--hint-->
          <p id="remind_hint"></p>
<!--question-->
          <h5>
            <span style="border-bottom: solid 5px powderblue;">問題</span>
          </h5>
            <p id="remind_question"></p>
<!--回答-->
          <h5>
            <span style="border-bottom: solid 5px powderblue;">解答</span>
          </h5>
          
          <div id="hide_by_giveup">
            <form name="resultform" action="{{action('CategoryController@result')}}" method="post" enctype="multipart/form-data">
            
              <input type="text" name="id" id="hidden_remind_id" value="">
              <input type="text" class="form-control" id="remind_answer" placeholder="答えを入力してください"><br>

              {{ csrf_field() }}
              <button type="button" class="btn-border mt-1" id="remind_submit">提出！</button>
              
            </form>
          </div>
          
          <form name="giveupform" action="{{action('CategoryController@giveup')}}" method="post" enctype="multipart/form-data">
            <p id="show_answer"></p>
            <input type="text" name="id" id="hidden_remind_id_giveup" value="">
            {{ csrf_field() }}
            <!--<button type="button" class="btn-border mt-2" id="remind_modal_close">終了</button>-->
            <button type="submit" class="btn-border mt-2" id="remind_modal_close">終了</button>
          </form>
          
        </div>
      </div>
<!--ここまで-->
    
    <!--common_jquery.js-->
    <script src="{{ mix('js/common_jquery.js') }}"></script>
    
</body>
</html>
@yield('js')

