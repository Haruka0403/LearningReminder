'use strict';

var minCount = 1;
var maxCount = 10;


$(function(){
  
  // ここから
  var demoarea = document.getElementsById("demo-area");
      for(var i = 0; i < 6; i++){
      ;
      }
  // ここまで
  
$('#demo-plus').on('click', function(){
  var inputCount = $('#demo-area .unit').length;
  if (inputCount < maxCount){
    var element = $('#demo-area .unit:last-child').clone(true);
    var inputList = element[0].querySelectorAll('input[type="datetime-local"]');
   
    for (var i = 0; i < inputList.length; i++) {
      inputList[i].value = "";
      
    }
    $('#demo-area .unit').parent().append(element);
    
  }
    var elements = document.getElementsByClassName("input-group-text")
      for(var i = 0; i < elements.length; i++){
      elements[i].textContent=String(i+1)+"回目";
    }
});


// フォーム消去
$('.demo-minus').on('click', function(){
  var inputCount = $('#demo-area .unit').length;
  if (inputCount > minCount){
    $(this).parents('.unit').remove();
  
  var elements = document.getElementsByClassName("input-group-text")
      for(var i = 0; i < elements.length; i++){
      elements[i].textContent=String(i+1)+"回目";
    }
  }
});
});
