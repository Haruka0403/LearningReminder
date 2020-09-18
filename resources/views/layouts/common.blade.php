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
$(function(){
    //10000ミリ秒ごとにajaxで新着コメントを問合せ
    setInterval(update, 10000);
  });
  
function update(){
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
    document.getElementById("remind_id").value = response[i].id;
    document.getElementById("remind_question").textContent　= response[i].question;
    document.getElementById("remind_hint").textContent = "ヒント！" + hint;
    document.getElementById("show_answer").textContent = "正解は" + answer + "でした!";
  } //forの閉じタグ

//(1.問題表示)→2.ヒント→3.降参,正解を表示してモーダルを閉じる 
  $("#remind_hint").hide();
  $("#hide_giveup").hide();
  $("#show_answer").hide();
  $("#remind_modal_close").hide();
  
//2.ヒント  
  $('#show_hint').click('on', function(){
    $('#hide_show_hint').hide();
    $("#remind_hint").show();
    
    $("#hide_giveup").show();
  });

// 答え提出（ajax使わないパターン)
    $('#remind_submit').click('on', function(){
      var toSend = $('#remind_answer').val();
      if(toSend == answer){
        alert('正解です！');
        $('#js_remind_modal').fadeOut();
        return false;
      }
      else{
       alert('不正解です。もう一度答えを記入してください。');
      }
    });
  
//3.降参 
  $('#giveup').click('on', function(){
    $('#hide_by_giveup').hide();
    $("#show_answer").show();
    $("#remind_modal_close").show();
  });

 // モーダルfadeIn
  var js_remind_modal = document.getElementById('js_remind_modal');
  console.log(js_remind_modal);
  $(js_remind_modal).fadeIn();
  return false;
  
  // 降参：モーダルをfadeOut
  // $(function(){
  $(document).on('click','#remind_modal_close', function() {
    alert('テスト');
    // $('#js_remind_modal').fadeOut();
    return false;
    });
  // });
  
}) //doneの閉じタグ
 
  .fail(function() {
    // console.log(response);
});
}


// 答えの正誤判断(AJAX)
// $(function(){ 
//   $('#remind_submit').click('on', function(){
//     // var tosend = $('#remind_answer').val();
//     var tosend = document.getElementById("remind_answer").value;
//     console.log("入力:"+tosend);
        // $.ajaxSetup({
        //     headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        // });
        // $.ajax({
        //     url: '/ajax/answer',
        //     type: 'POST',
        //     dataType: 'json',
        //     data: {
        //             "input_answer" :tosend ,
        //             "remind_id":$('#remind_id').val() 
        //           }
        // })

        // .done(function(response) {
        //   console.log("正解response:"+response);
        //   alert ('正解です！');
        //   $('#js_remind_modal').fadeOut();
        //     return false;
        // })

        // .fail(function(response) {
        //   console.log("不正解response:"+response);
        //   alert ('不正解です。もう一度答えを記入してください。')
        // });
    // })
// });
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
            <div class="input-group">
              <input type="text" class="form-control" placeholder="search">
              <span class="input-group-btn"><button type="button" class="btn btn-secondary form-control"><i class="fas fa-search"></i></button>
            </div>
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
          <!--id-->
            <input type="hidden" id="remind_id" value="">
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
            <label class="m-0" style="font-size: 80%;">答えを入力してください</label>
              <input type="form-control" id="remind_answer"><br>
              <button type="submit" class="btn-border mt-2" id="remind_submit">提出！</button>
          </div>
          
            <p id="show_answer"></p>
            <button type="button" class="btn-border mt-2" id="remind_modal_close">終了</button>
          
        </div>
      </div>
<!--ここまで-->
    
    <!--common_jquery.js-->
    <script src="{{ mix('js/common_jquery.js') }}"></script>
    
</body>
</html>
@yield('js')

