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
    const answer = response[i].answer;
    let loc = 0;
    
    document.getElementById("remind_question").innerText = '問題：' + response[i].question;
    document.getElementById("remind_answer").textContent =  answer;
 

    document.addEventListener('keydown', e => {
      if(e.key !== answer[loc]){
      return;
    }
      loc++;
      remind_answer.textContent ='_ '.repeat(loc) + answer.substring(loc);
  }); 
  }
     
   // モーダル
    var js_remind_modal = document.getElementById('js_remind_modal');
    console.log(js_remind_modal);
    $(js_remind_modal).fadeIn();
    return false;
    
}) //これは消さない！ 
 
  .fail(function() {
    console.log(response);
    // alert('一致データなし');
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
            <p id="remind_question"></p>
            <p>答えを入力してください</p>
            <p id="remind_answer"></p>
            <button type="submit" class="btn-border">閉じる</button>
          </div>
      </div>
<!--ここまで-->
    
    <!--common_jquery.js-->
    <script src="{{ mix('js/common_jquery.js') }}"></script>
    
</body>
</html>
@yield('js')

