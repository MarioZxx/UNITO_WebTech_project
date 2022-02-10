import * as utils from './utils.js';
$(function() {
  // user's cart
  
  $.post({
      url: "../php/loginCheck.php", 
      datatype: "json",
      success: function(json) {
        utils.completePage($("#username"), json);
        updateWrapper();
      },
      error: utils.goToLogin,
  });
  
  $("#bannerTxt").text("My cart");

  utils.menuHandler();
  utils.commonOffer();

});

function updateWrapper(){
  $.ajax({
    type: 'POST',
    url: "../php/getSetCart.php",
    data: {getCart: "true"},
    success: utils.updateOffers,
    error: utils.errorHandler,
    dataType: "json"
  })
}

