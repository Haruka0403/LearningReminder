<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
   {{-- 後の章で説明します --}}
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- 各ページごとにtitleタグを入れるために@yieldで空けておきます。 --}}
    <title>@yield('title')</title>

    <!-- Scripts -->
     {{-- Laravel標準で用意されているJavascriptを読み込みます --}}
    <script src="{{ secure_asset('js/app.js') }}" defer></script>
    <script src="{{ mix('js/common.js') }}"></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Raleway:300,400,600" rel="stylesheet" type="text/css">

    <!-- Styles -->
    {{-- Laravel標準で用意されているCSSを読み込みます --}}
    <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
    {{-- 共通のcss読み込み --}}
    <link href="{{ secure_asset('css/common.css') }}" rel="stylesheet">
    
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
      @yield('content')
    </section>
    
</body>
</html>