import * as utils from './utils.js';
$(function() {
  // check login status, and if logged, gets the user name
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

  utils.logout()
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

