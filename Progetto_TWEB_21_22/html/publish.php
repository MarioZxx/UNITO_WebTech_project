<?php include("top.html");?>

        <script type="module" src="../js/publish.js" type="text/javascript"></script>
    </head>
    <body>

      <?php include("banner.html");?>

    <div id="inputCont">
        <div id="firstRow">

          <div id="titleDiv">
            <label>Title</label>
                <div><input type="text" id="title" placeholder="Enter Title" required></div>
          </div>

          <div id="categoryDiv">
            <label>Category</label>
                <div>
                  <select id="category">
                    <option value="all">All categories</option>
                    <option value="electronics">Electronics</option>
                    <option value="clothings">Clothings</option>
                    <option value="forniture">Forniture</option>
                  </select>
                </div>
          </div>

          <div id="priceDiv">
            <label>Price</label>
              <div><input type="text" id="price" placeholder="Enter Price" required></div>
          </div>

        </div>


        <div id="secondRow">
          <label>Description</label>
            <div><textarea type="text" id="desc" placeholder="Enter Description" required></textarea></div>
        </div>
        <div id="thirdRow">
          <label>Image</label>
            <div><input type="text" id="image" placeholder="Enter Image" required></div>
        </div>
        <input type="submit" value="Publish" id="publishBtn" class="submitBtn">
        <br>
        <p id="msg"></p>

    </div>

       

<?php include("bottom.html"); 
    
?>
