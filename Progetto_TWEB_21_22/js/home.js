import * as utils from './utils.js';
$(function() {
  //homepage
  
  $("#errMsg").hide();

  $.post({
      url: "../php/loginCheck.php", 
      datatype: "json",
      success: function(json) {
        utils.completePage($("#username"), json);
        updateWrapper();
      },
      error: utils.goToLogin,
  });

  $("#searchBtn").on("click", updateWrapper);

  utils.menuHandler();
  utils.commonOffer();
  
});

function updateWrapper() {
  $.ajax({
    type: 'POST',
    url: "../php/getOffers.php",
    data: {search: $("#searchText").val(), category: $("#searchSelect option:selected").val()},
    success: utils.updateOffers,
    error: utils.errorHandler,
    dataType: "json"
  })
}

