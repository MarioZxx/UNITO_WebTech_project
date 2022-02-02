<?php include("top.html");?>

        <script type="module" src="../js/home.js" type="text/javascript"></script>
    </head>
    <body>

        <?php include("banner.html");?>

        <div id="searchCont">
          <div id="searchTextCont">
            <input type="text" id="searchText" placeholder="Search for anything" required>
            <select id="searchSelect">
              <option value="all">All categories</option>
              <option value="electronics">Electronics</option>
              <option value="clothings">Clothings</option>
              <option value="forniture">Forniture</option>
            </select>
          </div>
          <input type="submit" id="searchBtn" class="submitBtn" value="Search">
        </div>



<div id="offers">  
  
</div>
       

<?php include("bottom.html"); 
    
?>
