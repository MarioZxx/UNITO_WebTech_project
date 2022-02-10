import * as utils from './utils.js';
$(function() {
  //user's offers page

  $.post({
      url: "../php/loginCheck.php", 
      datatype: "json",
      success: function(json) {
        utils.completePage($("#username"), json);
        updateWrapper();
      },
      error: utils.goToLogin,
  });

  $("#bannerTxt").text("My offers");

  utils.menuHandler();
  utils.commonOffer();


});

function updateWrapper(){
  $.ajax({
    type: 'POST',
    url: "../php/getOffers.php",
    data: {myOffers: "true"},
    success: utils.updateOffers,
    error: utils.errorHandler,
    dataType: "json"
  })
}

