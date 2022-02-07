$(function() {
  $("#msg").hide();
  
  $("#regisBtn").on("click", function(){
      if(!usernameValidation()) {
        $("#msg").show();
        $("#msg").text("Please, enter a valid username");
        return;
      };
      if(!pwdValidation()) {
        $("#msg").show();
        $("#msg").text("The password cannot be empty or different");
        return;
      };
      $.ajax({
          type: 'POST',
          url: "../php/addUser.php",
          data: {username: $("#username").val(), pwd: $("#pwd").val()},
          success: function(json){
            $("#msg").show();
            $("#msg").text(json.msg);
            setTimeout(function(){ window.location = "login.php"; }, 5000);
          },
          dataType: "json"
        })
  });

});

function usernameValidation() {
    var regex = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{1,4})+$/;
    return regex.test($("#username").val());
}

function pwdValidation() {
  return $("#pwd").val() != "" && $("#pwd").val()==$("#rePwd").val();
}

function errorHandler(xhr, textStatus, error){
    console.log(xhr.statusText);
    console.log(textStatus);
    console.log(error);
}
