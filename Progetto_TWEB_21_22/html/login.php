<!-- login page -->

<?php include("top.html")?>

       <script src="../js/login.js" type="text/javascript"></script>
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
        </dl>


      </div>

      <div id="w3c">
				<a href="http://validator.w3.org/check/referer"> 
					<img width="88" src="https://upload.wikimedia.org/wikipedia/commons/b/bb/W3C_HTML5_certified.png" alt="Valid HTML5!">
				</a>
				<a href="http://jigsaw.w3.org/css-validator/check/referer">
					<img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS" >
				</a>
			</div>

    </div>
  </body>
</html>

