<?php include("top.html");?>

        <script type="module" src="../js/offer.js" type="text/javascript"></script>
    </head>
    <body>

        <?php include("banner.html");?>

        <div id="command">
          <input type="submit" id="deleteBtn" class="submitBtn" value="Delete this offer">
          <input type="submit" id="cartOpBtn" class="submitBtn" value="Add to cart">
        </div>



<div id="offers">  
  <div class="offer" id="<?=$_GET["id"]?>">
    <div class="offerImg">
      <img id="of_img" src="the_img" alt="offer image" onerror="this.onerror=null; this.src='../img/offers/default.png'">
    </div>
    <div class="offerInfo">
      <span class="of_title" id="of_title">the_title</span>
      <span class="of_price" id="of_seller">the_seller</span><br>
      <span class="of_time" id="of_date">the_date</span><br>
      <span class="of_price" id="of_price">the_price €</span><br>
      <span class="of_desc" id="of_desc">the_desc</span><br>
    </div>
  </div>
</div>
       

<?php include("bottom.html"); 
    
?>
