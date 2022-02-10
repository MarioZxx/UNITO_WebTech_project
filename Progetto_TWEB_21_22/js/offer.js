import * as utils from './utils.js';
$(function() {
  //display the selected offer

  $("#msg").hide();
  $("#deleteBtn").hide();
  $("#cartOpBtn").show();


  $.post({
      url: "../php/loginCheck.php", 
      datatype: "json",
      success: function(json) {
        if(json.offerNA){
          $(window.location).attr('href', 'home.php');
          return;
        }
        utils.completePage($("#username"), json);
        showOfferWrapper();
      },
      error: utils.goToLogin,
  });

  utils.menuHandler();

  $("#deleteBtn").on("click",function(){
    var check = confirm("Are you sure you want to delete?");
    if(check){
      $.ajax({
        type: 'POST',
        url: "../php/deleteOffer.php",
        data: {id: $(".offer").attr("id")},
        success: function() {
          $(window.location).attr('href', 'home.php');
        },
        error: utils.errorHandler
      }) 
    }
  });

  $("#cartOpBtn").on("click",function(){
      var cartOp = $("#cartOpBtn").val() == "Delete from the cart" ? "delete" : "add";
      $.ajax({
        type: 'POST',
        url: "../php/getSetCart.php",
        data: {id: $(".offer").attr("id"), cartOp: cartOp},
        success: function() {
          if(cartOp == "add") 
            $("#cartOpBtn").attr('value', 'Delete from the cart');
          else $("#cartOpBtn").attr('value', 'Add to cart');
        },
        error: utils.errorHandler
      })
  });

if($("#username").text() == "admin@email.com") {
  $("#deleteBtn").show();
  $("#cartOpBtn").show();
}
  
});

function showOfferWrapper() {
  $.ajax({
    type: 'POST',
    url: "../php/getOffers.php",
    data: {id: $(".offer").attr("id")},
    success: showOffer,
    error: function(){
      $(window.location).attr('href', 'home.php');
    },
    dataType: "json"
  }) 
}

function showOffer(json) {
  //if the current user is admin, deleteBtn will be always shown
  if(json.admin) $("#deleteBtn").show();
  if(json.cartCheck) $("#cartOpBtn").val("Delete from the cart");

  json = json.offers[0];
  var offerId = $(".offer").attr("id");
  $("#of_img").attr("src", json.image);
  $("#of_img").attr("onerror", "this.onerror=null; this.src='../img/offers/default.png'");
  $("#of_title").text(json.title);

  $("#of_seller").text(json.email);
  if(json.email == $("#username").text()) {
    $("#deleteBtn").show();
    $("#cartOpBtn").hide();
  }

  $("#of_date").text(json.time);
  $("#of_price").text(json.price + " €");
  $("#of_desc").text(json.description);
  $(".offerImg").css({"float":"none","width":"auto"});
  $(".offerInfo").css({"float":"none","width":"auto","border-left":"0","border-top":"1px solid #45728f"});
  $(".offerInfo > span").css({"white-space":"normal", "overflow":"auto", "text-overflow":"clip"});
  $(".offer").css({"overflow":"auto","height":"auto"});
}



