<?php include("top.html")?>

       <script src="../js/login.js"></script>
       <!-- Xiao Zhao ligin page-->
  </head>
  <body>
    <div id="frame">
      <div id="loginBanner">
        <img src="../img/detra_logos/Detra_slogan.png" alt="banner logo" >
      </div>

      <div id="loginCont">

        <div id="msg"> </div> <!-- show the message -->

        <dl>
          <dt>Username</dt>
            <dd><input type="text" id="username" placeholder="Enter Username" required></dd>
          <dt>Password</dt> 
            <dd><input type="password" id="pwd" placeholder="Enter Password" required></dd>
          <dt></dt> 
            <dd><input type="submit" value="Login" class="submitBtn" id="loginBtn"></dd>
          <dt></dt> 
            <dd><input type="submit" value="Register" class="submitBtn" id="regisBtn"></dd>
        </dl>


<?php include("bottom.html")?>

