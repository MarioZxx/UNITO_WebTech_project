
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
