<!doctype html>
 <html lang="{{ app()->getLocale() }}">
     <head>
         <meta name="csrf-token" content="{{ csrf_token() }}">
         <script src="{{ secure_asset('js/app.js') }}" defer></script>
        <link href="{{ secure_asset('css/app.css') }}" rel="stylesheet">
        <title>apiview</title>
     </head>
     <body>

         <div class='test'>hello view</div>
         <button id='change_color'>change color</button>
         <button id='add_hello'>add hello</button>
         <button id='get_news'>get news</button>

         <br>
         <div class='target_hello'></div>

         <br>
         <table class='news' border='2'>
             <tr>
                 <th>id</th>
                 <th>user_id</th>
                 <th>name</th>
             </tr>
         </table>

         <br>

         <h5>【課題】newsテーブルにデータを保存できるadd_newsボタンのAjaxを実装しましょう（値は決め打ちでokです）</h5>

         <!-- Button trigger modal -->
        <button  id='add_news' type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCentered">
         add news
        </button>
        
        <!-- Modal -->
        <div class="modal" id="exampleModalCentered" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenteredLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenteredLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
          <!--form-->
            <!--validation-->
              <div class ="validation"></div>
            <!--form-->
              <div class="modal-body">
               <input id="name" name="name" class="form-control" type="text" placeholder="Default input">
              </div>
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
         
         
         
         <br>
         ヒント：
         <ul>
             <li>Ajaxのdataに連想配列(json)を渡すことで、サーバーにデータの送信が可能です</li>
             <li>コントローラでデータを取得する方法→<a href='https://readouble.com/laravel/5.5/ja/requests.html'>JSON入力値の取得の項目</a></li>
         </ul>
         <h5>【応用】画面で入力した値をnewsテーブルに保存できるよう改修しましょう</h5>
     </body>
 </html>