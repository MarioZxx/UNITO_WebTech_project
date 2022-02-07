
export function errorHandler(xhr, textStatus, error, json){
  console.log(xhr.statusText);
  console.log(textStatus);
  console.log(error);
  console.log(json);
}

export function printText(text){
  console.log(text);
}

export function completePage(temp, json){
  // if session has been set and username is found, then we WELCOME the user and 
  // we add logout button to each page
  if(json.isLogged){
    temp.text(json.name);
  } else {
      // if logged is false, then the session is not active and the user needs to log in
      $(window.location).attr('href', 'login.php');
  }
}   // end printName

export function goToLogin() {
  // if something goes wrong, go to login page
  $(window.location).attr('href', 'login.php');
}

export function logout() {
  // dismiss open session and redirect to login.php when logout button is pressed
  $("#logout").on("click", function(){
    $.get({
        url: "../php/logout.php",
        success: function() {
            $(window.location).attr('href', 'login.php');
        }
    })
  });
}

export function updateOffers(json){
  console.log(json);
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
          aTag.attr("id", "oid"+ item.id);
          html = html.replace("the_id", item.id);
          html = html.replace("the_date", item.time);
          html = html.replace("the_price", item.price);
          aTag.append(html);
          $("#offers").append(aTag);
          $("#offers #oid"+item.id+" .of_title").text(item.title);
          $("#offers #oid"+item.id+" .of_desc").text(item.description);
          $("#offers #oid"+item.id+" img").attr("src", item.image);

        },
        "html"
    );
  });
}

export function commonOffer() {
  $(document).on("click", ".offer", function() {
    $(window.location).attr('href', 'offer.php?id=' + $(this).attr('id'));     
  });

  $(document).on({
    mouseenter : function () {
      $(this).css({ "position": "absolute" });
      $(this).stop().animate({ height: "200%", width: "60%", left: "-10px", top: "-10px", zIndex: "1024" }, 400);      
    },
    mouseleave :function () {
      $(this).stop().animate({ height: "100%", width: "30%", left: "0px", top: "0px", zIndex: "0" }, 400);
    }
  }, ".offerImg");
}
