$(function() {
  $("#msg").hide();

  // print flash message if it has been set
  $.get("../php/getMsg.php", printMsg, "json");
  
  $("#loginBtn").on("click", function(){
      $.ajax({
          type: 'POST',
          url: "../php/loginCheck.php",
          data: {username: $("#username").val(), pwd: $("#pwd").val()},
          success: goToHome,
          error: errorHandler,
          dataType: "json"
        })
  });

});

function errorHandler(xhr, textStatus, error){
    console.log(xhr.statusText);
    console.log(textStatus);
    console.log(error);
}


function printMsg(json){
  // if isSet is true, then the message is set up and displayed
  if(json.isSet){
      $("#msg").show();
      $("#msg").text(json.msg);
  } // hide message container if there is no message to show
  else
       $("#msg").hide();
}

function goToHome(json){
  // go to index if it's logged
  if(json.isLogged){
      $(window.location).attr('href', 'home.php');
  }
  else {
      $(window.location).attr('href', 'login.php');
  }
}