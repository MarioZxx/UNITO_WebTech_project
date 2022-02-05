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

  utils.logout();

  $("#publishBtn").on("click",function(){
    if( !(/^\d*$/.test($("#price").val())) ) {
      $("#msg").show();
      $("#msg").text("The price should be numbers");
      $("#price").css("border-color","red");
      return;
    };
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



