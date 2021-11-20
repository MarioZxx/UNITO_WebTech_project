$(window).load(function() {

  initialization();
  $("#shufflebutton").click(shuffleClick);
});

var emptyX = 3;
var emptyY = 3;
const GRID_SIZE = 4;  //number of tiles
const TILE_SIZE = 100;  //px
var score = 0;
var countDown = null;

function initialization() {
  for(var i = 0; i < GRID_SIZE; i++){
    for(var j = 0; j < GRID_SIZE; j++){
      if(i * GRID_SIZE + j == GRID_SIZE*GRID_SIZE-1) break;
      $("#puzzlearea > div")[i * GRID_SIZE + j].id = coordToId(i,j);
      move(i, j, i, j);
      setBackgroundImage(i, j);
    }
  }
}

/*move tile to the destination position and refresh the image.
//parameters are initial position and destination position.
*/
function move(y, x, dy, dx, user) {
  if(Math.abs(y-dy)+Math.abs(x-dx)>1) return;
  
  $("#"+coordToId(y,x)).attr("id", coordToId(dy,dx));
  
  if(user){
    $("#"+coordToId(dy,dx)).animate({left: (TILE_SIZE*dx).toString() + "px"}, "fast");
    $("#"+coordToId(dy,dx)).animate({top: (TILE_SIZE*dy).toString() + "px"}, "fast");
  } else {
    $("#"+coordToId(dy,dx)).css("left",(TILE_SIZE*dx).toString() + "px");
    $("#"+coordToId(dy,dx)).css("top",(TILE_SIZE*dy).toString() + "px");
  }
  //document.getElementById(coordToId(y,x)).setAttribute("id", coordToId(dy,dx));
  // document.getElementById(coordToId(dy,dx))
  //   .style.left = (TILE_SIZE*dx).toString() + "px";
  // document.getElementById(coordToId(dy,dx))
  //   .style.top = (TILE_SIZE*dy).toString() + "px";
}

/*Set image for tiles
//pamameters are position of tile
//tileNumber is fixed for every tile, so i can locate image by this variable
*/
function setBackgroundImage(y, x) {
  var tileNumber = $("#"+coordToId(y,x)).text() - 1;

  $("#"+coordToId(y,x)).css("background-position", (-TILE_SIZE * (tileNumber % GRID_SIZE)).toString() + "px "
      + (-TILE_SIZE * Math.floor(tileNumber / GRID_SIZE)).toString() + "px");
  // var tileNumber = document.getElementById(coordToId(y,x)).innerText - 1; 
  // document.getElementById(coordToId(y,x))
  //   .style.backgroundPosition = (-TILE_SIZE * (tileNumber % GRID_SIZE)).toString() + "px "
  //   + (-TILE_SIZE * Math.floor(tileNumber / GRID_SIZE)).toString() + "px";
}

/*Set movable tile in movableTile class and give a listener
//pamameters are position of empty tile
*/
function setMovable(y, x) {
  $("div.movableTile").off("click");
  $("div.movableTile").removeClass();

  if(y > 0)  
    $("#"+coordToId(y-1,x)).attr("class", "movableTile");
  if(y < GRID_SIZE - 1)  
    $("#"+coordToId(parseInt(y)+1,x)).attr("class", "movableTile");
  if(x > 0)  
    $("#"+coordToId(y,x-1)).attr("class", "movableTile");
  if(x < GRID_SIZE - 1)  
    $("#"+coordToId(y,parseInt(x)+1)).attr("class", "movableTile");

  // if(y > 0)  document.getElementById(coordToId(y-1,x))
  //               .setAttribute("class", "movableTile");
  // if(y < GRID_SIZE - 1)  document.getElementById(coordToId(parseInt(y)+1,x))
  //               .setAttribute("class", "movableTile");
  // if(x > 0)  document.getElementById(coordToId(y,x-1))
  //               .setAttribute("class", "movableTile");
  // if(x < GRID_SIZE - 1)  document.getElementById(coordToId(y,parseInt(x)+1))
  //               .setAttribute("class", "movableTile");
  
  $("div.movableTile").on("click", function() {
    movementClick.call(this, true);
  });
}

//Do the movement and set the empty tile
//parameter bool user to controll if the movement is by user
function movementClick(user){
  var text = this.id;
  var posArray = text.split("_");
  let y = parseInt(posArray[1]);
  let x = parseInt(posArray[2]);
  move(y, x, emptyY, emptyX, user);
  emptyY = y;
  emptyX = x;
  setMovable(emptyY, emptyX);
  if(user){
    score++;
    $("#info").text("your score is: " + score);
    win();
  }
}

//check if the game is winned
function win() {
  if(emptyY != 3 || emptyX != 3) return;
  for(var i = 0; i < GRID_SIZE; i++){
    for(var j = 0; j < GRID_SIZE; j++){
      if(i * GRID_SIZE + j == GRID_SIZE*GRID_SIZE-1) break;
      if($("#" + coordToId(i,j)).text() != (i * GRID_SIZE + j + 1)) 
        return;
    }
  }
  $("#shufflebutton").text("New Game");
  $("#info").html("Congratulation, you win the game.<br>" + "your score is: " + score);
  $("#info").css("background-color", "yellow");
  $("div.movableTile").off("click");
  $("div.movableTile").removeClass();
  clearInterval(countDown);
}

//shuffle the grid
function shuffleClick() {
  $("#shufflebutton").text("Shuffle");
  setMovable(emptyY,emptyX);
  score = 0;
  for(var i = 0; i < 100; i++){
    var shuffleTile = $(".movableTile")[parseInt(Math.random() * ($(".movableTile").length))];
    movementClick.call(shuffleTile,false);
  }
  $("#timer").remove();
  $("#info").remove();
  $("#puzzlearea").after("<p id=\"timer\"></p>");
  $("#puzzlearea").after("<p id=\"info\">your score is: " + score + "</p>");
  clearInterval(countDown);
  setCountDown();
}

//convert coordinate to ID TODO impostarlo a tutti
function coordToId(y, x) {
  return "tile_" + y.toString() + "_" + x.toString();
}


function setCountDown() {
  var countDownTime = new Date().getTime();
  countDownTime += 1000 * 60 * 5 ; //timer of 5 minutes
  var color = 0x1a1a; //to switch the color
  countDown = setInterval(function() {
    var now = new Date().getTime();    
    var interval = countDownTime - now;  
    var minutes = Math.floor((interval % (1000 * 60 * 60)) / (1000 * 60));
    var seconds = Math.floor((interval % (1000 * 60)) / 1000);
    
    $("#timer").text("timer: " + minutes + "m " + seconds + "s ");

    if(minutes == 0 && seconds < 10 && seconds != 0) $("#timer").css("background-color","#ff" + (color*seconds).toString(16));
    if(seconds < 0){
      clearInterval(countDown);
      $("#timer").css("background-color","red");
      $("#timer").text("EXPIRED");
      $("div.movableTile").off("click");
    }
  }, 1000);
}
