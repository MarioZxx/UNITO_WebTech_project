import * as utils from './utils.js';
$(function() {

  $("#errMsg").hide();

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

  // dismiss open session and redirect to login.php when logout button is pressed
  $("#logout").on("click",function() {
      $.get({
          url: "../php/logout.php",
          success: function() {
              $(window.location).attr('href', 'login.php');
          }
      })
  });

  $("#searchBtn").on("click", updateWrapper);

  $(document).on("click", ".offer", function() {
          $(window.location).attr('href', 'offer.php?id=' + $(this).attr('id'));     
  });
  
});

function updateWrapper() {
  $.ajax({
    type: 'POST',
    url: "../php/getOffers.php",
    data: {search: $("#searchText").val(), category: $("#searchSelect option:selected").val()},
    success: updateOffers,
    error: utils.errorHandler,
    dataType: "json"
  })
}

function updateOffers(json) {
  //connect to db and get offers by search constraints
  $("#offers").html("");

  if(json.errMsg) {
    var errMsg = $("<p></p>");
    errMsg.attr("id","msg");
    errMsg.text(json.errMsg);
    $("#offers").append(errMsg);
    return;
  }

  json.offers.forEach(function(item){
    $.get( "../html/offerSkeleton.html", 
        function(html){
          var aTag = $("<a></a>");
          aTag.attr("href", "offer.php?id="+ item.id);
          html = html.replace("the_id", item.id);
          html = html.replace("the_img", item.image);
          html = html.replace("the_title", item.title);
          html = html.replace("the_date", item.time);
          html = html.replace("the_price", item.price);
          html = html.replace("the_desc", item.description);
          aTag.append(html);
          $("#offers").append(html);
        },
        "html"
    );
  });
}
