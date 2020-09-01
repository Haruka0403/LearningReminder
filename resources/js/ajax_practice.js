$(function() {
     //ボタンを押すと色が変わる
     $('#change_color').click('on',function(){
         var colors = ['red', 'blue', 'yellow','white'];
         $('body').css("background-color", colors[getRandomIntInclusive(0,colors.length-1)]);
     });

     //HTMLを追加することもできる
     $('#add_hello').click('on',function(){
         var msg = '<p>hello</p>';
         $('.target_hello').append(msg);
     });

     //通信して取得したデータを元に、HTMLを追加することもできる
     $('#get_news').click('on', function(){
         $.ajax({
             url: 'api/category',
             type: 'GET',
             data: {}
         })

         .done(function(response) {
             console.log(response);
             var row;
             for(var i=0; i<Object.keys(response).length; i++){
                 row = row + "<tr>";
                 row = row + "<td>"+ response[i].id +"</td>";
                 row = row + "<td>"+ response[i].user_id +"</td>";
                 row = row + "<td>"+ response[i].name +"</td>";
                 row = row + "</tr>";
             }
             $('.news').append(row);
         })

         .fail(function() {
             alert('エラー');
         });
     })
     
   //宿題新規作成
   $('#submit').click('on', function(){
         $.ajaxSetup({
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
        });
         $.ajax({
             url: 'api/create',
             type: 'POST',
             dataType: 'json',
             data: {"name" :$('#name').val()}
         })

         .done(function(response) {
            alert ('登録完了');
            // 画面を消すコード
            // controllerからの変数を持ってきて、bladeに渡すコード
         })

         .fail(function(response) {
           var validation =  document.getElementsByClassName("validation");
             validation.textContent="入力がされていません";
         });
     })
     
    // category.blade.php 編集
//           $('.c_edit').click('on', function(){
            
//           // 編集ボタンに上から番号をつけて差別化する(0始まり)
//             var index = $('.c_edit').index(this);
            
//           // {{item->id}}を取得(投稿したカテゴリー全てが格納されている)
//             var category_ids = document.getElementsByClassName("edit_c_id");
          
//           // 配列category_ids[ {{item->id}} ]の該当する番号1つを指定する
//             var category_id = category_ids[index].value;
//             // console.log(category_ids[0].attr('value'));
            
//           $.ajaxSetup({
//             headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}
//           });
//           $.ajax({
//             url: 'api/category_edit',
//             type: 'POST',
//             dataType: 'json',
//             data: {"id" : category_id}
//             // data: {"id" : $('.edit_c_id').val()}
//           })
          
//         .done(function(response) {
//             console.log(response);
//             // console.log(response.name);
            
//         // 1.オブジェクトに変換したが、
//             // エラー(変数の中身は JSON 文字列ではなく、object ?)が出る
//             // var result = JSON.parse(response);
//             // console.log(result.name);
    
//         // 2.category.bladeのformのholderの中にカテゴリー名(name)を送りたい
//           var category_name = "上記で生成する予定の変数を入れる";
//           $('.name').val(category_name);
       
//         })

//         .fail(function() {
//             alert('エラー');
//         });
//     });
     
// });

 /*
   min-max間のランダムな整数を返す
 */
 function getRandomIntInclusive(min, max) {
     min = Math.ceil(min);
     max = Math.floor(max);
     return Math.floor(Math.random() * (max - min + 1)) + min; //The maximum is inclusive and the minimum is inclusive
 }