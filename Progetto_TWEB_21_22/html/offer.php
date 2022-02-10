<?php include("top.html");?>

        <script type="module" src="../js/offer.js"></script>
        <!-- Xiao Zhao show the offer clicked-->
    </head>
    <body>

        <?php include("banner.html");?>

        <div id="command">
          <input type="submit" id="deleteBtn" class="submitBtn" value="Delete this offer">
          <input type="submit" id="cartOpBtn" class="submitBtn" value="Add to cart">
        </div>


<div id="offers">  
  <div class="offer" id="<?=$_GET["id"] ?? 0 ?>">
    <div class="offerImg">
      <img id="of_img" src="../img/offers/default.png" alt="offer image" onerror="this.onerror=null; this.src='../img/offers/default.png'">
    </div>
    <div class="offerInfo">
      <span class="of_title" id="of_title">the_title</span>
      <span class="of_price" id="of_seller">the_seller</span>
      <span class="of_time" id="of_date">the_date</span>
      <span class="of_price" id="of_price">the_price €</span>
      <span class="of_desc" id="of_desc">the_desc</span>
    </div>
  </div>
</div>       

<?php include("bottom.html");?>