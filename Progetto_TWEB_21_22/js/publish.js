import * as utils from './utils.js';
$(function() {
  $("#msg").hide();

  $.post({
      url: "../php/loginCheck.php", 
      datatype: "json",
      success: function(json) {
        utils.completePage($("#username"), json);
      },
      error: utils.goToLogin,
  });

  $("#bannerTxt").text("Publish new offer!");

  $("#logout").on("click",function(){
      $.get({
          url: "../php/logout.php",
          success: function() {
              $(window.location).attr('href', 'login.php');
          }
      })
  });

  $("#publishBtn").on("click",function(){
    $.ajax({
      type: 'POST',
      url: "../php/publishOffer.php",
      data: {title: $("#title").val(), category: $("#category option:selected").val(), 
              desc: $("#desc").val(), price: $("#price").val(), image: $("#image").val()},
      success: function(json){
        if(json.msg) {
          $("#msg").show();
          $("#msg").text(json.msg);
        }
      },
      error: utils.errorHandler,
      dataType: "json"
    })
  });
  
});



