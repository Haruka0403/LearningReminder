'use strict';

// モーダル　カテゴリー名編集用
window.onload = function(){
$('#exampleModal').on('show.bs.modal', function (event) {
  var button = $(event.relatedTarget) //モーダルを呼び出すときに使われたボタンを取得
  var recipient = button.data('whatever') //data-whatever の値を取得

  //Ajaxの処理はここに

  var modal = $(this)  //モーダルを取得
    console.log(recipient);
    modal.find('.modal-title').text('New message to ' + recipient) //
  modal.find('.modal-body input#recipient-name').val(recipient) //inputタグにも表示


})
};

//モーダル　カテゴリー新規作成用
$(function(){
    $('.js-modal-open').each(function(){
        $(this).on('click',function(){
            var target = $(this).data('target');
            var modal = document.getElementById(target);
            $(modal).fadeIn();
            return false;
        });
    });
    $('.js-modal-close').on('click',function(){
        $('.js-modal').fadeOut();
        return false;
    }); 
});



