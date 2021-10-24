<!-- Xiao Zhao, Corso B, php del lab03 -->

<?php
  $movie = $_GET["film"] ?? "matrix";
  $allReviews = glob("$movie/review*.txt");
  $numReviews = count($allReviews);
  list($name, $year, $rate) = file("$movie/info.txt", FILE_IGNORE_NEW_LINES); //h1
  $big = ($rate > 60) ? "fresh" : "rotten"; //image of rating
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<title>Rancid Tomatoes</title>
    <link rel="icon" href="https://courses.cs.washington.edu/courses/cse190m/11sp/homework/2/rotten.gif">

		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link href="movie.css" type="text/css" rel="stylesheet">
	</head>

	<body>
		<div class="banner">
			<img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/banner.png" alt="Rancid Tomatoes">
		</div>

		<h1><?=$name?> (<?=$year?>)</h1>

    <div class="contenitor">

      <div class="synthesis">
        <div>
          <img src="<?= $movie?>/overview.png" alt="general_overview">
        </div>

        <dl>
        <?php
          $overview = file("$movie/overview.txt", FILE_IGNORE_NEW_LINES);
          foreach($overview as $line) {
            $line = explode(":", $line);
        ?>
        <dt><?= $line[0]?></dt>
        <dd><?= $line[1]?></dd>
        <?php
          }
        ?>
        </dl>
      </div>

      <div class="rating">

        <div class="rate">        
          <img src="https://courses.cs.washington.edu/courses/cse190m/11sp/homework/2/<?=$big?>big.png" alt="<?=ucwords($big)?>">
          <span><?= $rate?>%</span>
        </div>

        <div class="left">
          <?php
            for($i = 0; $i < min(5, $numReviews/2); $i++){
              $review = file($allReviews[$i], FILE_IGNORE_NEW_LINES);
          ?>

          <p class="review">
            <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/<?= strtolower($review[1]) ?>.gif" alt="<?= ucwords(strtolower($review[1])) ?>">
            <q><?= $review[0] ?></q>
          </p>
          <p class="critic">
            <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic">
            <?= $review[2] ?><br>
            <span class="publication"><?= $review[3] ?></span>
          </p>

          <?php
            }
          ?>
        </div>

        <div class="right">
          <?php
            for($i; $i < min(10, $numReviews); $i++){
              $review = file($allReviews[$i], FILE_IGNORE_NEW_LINES);
          ?>

          <p class="review">
            <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/<?= strtolower($review[1]) ?>.gif" alt="<?= ucwords(strtolower($review[1])) ?>">
            <q><?= $review[0] ?></q>
          </p>
          <p class="critic">
            <img src="http://www.cs.washington.edu/education/courses/cse190m/11sp/homework/2/critic.gif" alt="Critic">
            <?= $review[2] ?><br>
            <span class="publication"><?= $review[3] ?></span>
          </p>

          <?php
            }
          ?>
        </div>

      </div>

      <p class="page">(1-<?= $numReviews ?>) of <?= $numReviews ?></p>

    </div>

		<div class="validator">
			<p>
				<a href="http://validator.w3.org/check/referer"><img width="88" src="https://upload.wikimedia.org/wikipedia/commons/b/bb/W3C_HTML5_certified.png" alt="Valid HTML5!"></a>
			<p>
			<a href="http://jigsaw.w3.org/css-validator/check/referer"><img src="http://jigsaw.w3.org/css-validator/images/vcss" alt="Valid CSS!"></a>
		</div>
	</body>
</html>
