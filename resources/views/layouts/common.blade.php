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
    
    <!--Push.js-->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.9/push.min.js"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    {{-- 共通のcss --}}
    <link href="{{ secure_asset('css/common.css') }}" rel="stylesheet">
    
<!--通知モーダルjs-->
<script>
var modalon = false;

// モーダルが表示されている間は、次のモーダルが来ても表示しない
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
   
// push通知
  Push.create("Learning Reminder", {  
    body: "リマインダー時間になりました！問題を解きましょう！",  
    // icon: 'img/notification_icon.png',  
  });

    var answer = response['answer'];
    var hint = response['hint'];
    
    document.getElementById("remind_question").textContent　= response['question'];
    document.getElementById("hidden_remind_id").value = response['id'];
    document.getElementById("hidden_schedule_id").value　= response['schedule_id'];
    document.getElementById("hidden_schedule_id_giveup").value　= response['schedule_id'];
    document.getElementById("hidden_remind_id_giveup").value = response['id'];
    
    document.getElementById("show_answer").textContent = "正解は" + answer + "でした!";

// モーダルfadeIn ID
  var js_remind_modal = document.getElementById('js_remind_modal');
  console.log(js_remind_modal);

  
//↓1.問題表示→2.ヒント→3.降参,正解を表示してモーダルを閉じるプロセス↓

//1.問題表示→2.ヒント
 $("#remind_hint").hide();
 
    $('#show_hint').click('on', function(){
      if(hint == null || ""){
        document.getElementById("remind_hint").textContent = "ヒントが登録されていません";
      }
      else{
        document.getElementById("remind_hint").textContent = "ヒント！" + hint;
        document.getElementById("hidden_hint").value = "hasHint";
      }
      
      $('#hide_show_hint').hide();
      $("#remind_hint").show();
      $("#hide_giveup").show();
  });

// 答え提出
  $('#remind_submit').click('on', function(){
    var toSend = $('#remind_answer').val();
    if(toSend == answer){
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
  // $('#giveup').click('on', function(){ //動的に表示したボタンにイベントを付ける場合は以下のように記入する
  $(document).on('click','#giveup', function() {
    $('#hide_by_giveup').hide();
    $("#show_answer").show();
    $("#remind_modal_close").show();
    document.getElementById("hidden_giveup").value = "hasGivup";
    });
  });
 
// モーダルfadeIn
  $(js_remind_modal).fadeIn();
  modalon = true;
  return false;

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

        <div id="navbarDropdown" class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
          <a class="dropdown-item text-center p-0" href="{{ route('logout') }}"
             onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
            ログアウト
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

<section class="mt-1">
  <div id="app">
    @yield('content')
  </div>
</section>
    
<!--↓通知モーダルのview↓-->
      <div id="js_remind_modal" class="modal">
        <!--影-->
        <div class="modal__bg js-remind-modal-close"></div> 
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

          <!--question-->
          <h5>
            <span style="border-bottom: solid 5px powderblue;">問題</span>
          </h5>
            <p id="remind_question"></p>
            
          <!--answer-->
          <h5>
            <span style="border-bottom: solid 5px powderblue;">解答</span>
          </h5>
          
          <!--解答及びhint表示部-->
          <div id="hide_by_giveup">
            <form name="resultform" action="{{action('CategoryController@result')}}" method="post" enctype="multipart/form-data">
              
              <input type="hidden" id="hidden_remind_id" name="id" value="">
              <input type="hidden" id='hidden_schedule_id' name="schedule_id" value="">
              <input type="hidden" id="hidden_hint" name="hint" value="">
              
              <!--hint表示部-->
              <p id="remind_hint"></p>
              
              <!--解答フォーム-->
              <input type="text" class="form-control" id="remind_answer" placeholder="答えを入力してください"><br>

              {{ csrf_field() }}
              <button type="button" class="btn-border mt-1" id="remind_submit">提出！</button>
              
            </form>
          </div>
          
          <!--降参部-->
          <form action="{{action('CategoryController@result')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" id="hidden_giveup" name="giveup" value="">
            <input type="hidden" id="hidden_remind_id_giveup" name="id" value="">
            <input type="hidden" id='hidden_schedule_id_giveup' name="schedule_id" value="">
            
            <!--答え表示部-->
            <p id="show_answer"></p>
            
            {{ csrf_field() }}
            <button type="submit" class="btn-border mt-2" id="remind_modal_close">終了</button>
          </form>
          
        </div>
      </div>
<!--通知モーダルここまで-->

<!--modal.js-->
<script src="{{ mix('js/modal.js') }}"></script>
    
</body>
</html>

@yield('js')
