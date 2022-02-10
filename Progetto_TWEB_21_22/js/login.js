$(function() {
  $("#msg").hide();
  
  $.get("../php/getMsg.php", printMsg, "json");

  $("#loginBtn").on("click", function(){
      if(!validation()) {
        $("#msg").show();
        $("#msg").text("Please, enter a valid username");
        return;
      };
      if($("#pwd").val() == "") {
        $("#msg").show();
        $("#msg").text("The password cannot be empty");
        return;
      };
      $.ajax({
          type: 'POST',
          url: "../php/loginCheck.php",
          data: {username: $("#username").val(), pwd: $("#pwd").val()},
          success: goToHome,
          error: errorHandler,
          dataType: "json"
        })
  });

  $("#regisBtn").on("click", function(){
    $(window.location).attr('href', 'register.php');
});

});

function validation() {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{1,4})+$/;
    return regex.test($("#username").val());
}

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