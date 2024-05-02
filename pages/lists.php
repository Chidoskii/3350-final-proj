<?php
require_once("../php/config.php");
require_once("../php/functions.php");
require_once("../php/login.php");
require_once("../php/register.php");

if(empty($_SESSION["logged_in"])){
  header("location: ../index.php");
}

if($_SESSION["logged_in"] == false){
  header("location: ../index.php");
}

$wtf = getUserId($_SESSION["login_email"]);
$watchlist = getWatchlistMovies($wtf);
$seenlist = getSeenlistMovies($wtf);
$deets = "";
$filler = "../imgs/filler.jpg";
$filler2 = "../imgs/mona.jpg";
$config = configsTMDB();
$poster_base = $config['images']['secure_base_url'] . $config['images']['poster_sizes'][4];
$poster = "";
$rateColor = "rgb(240, 240, 240)";

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="TheMovieBuffs is a website where users can write reviews and give ratings on films they have watched.">
    <title><?= $PROJECT_NAME ?> | Lists</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200&display=block" />
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/reel.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="shortcut icon" href="../../imgs/favicon.ico" />
    <link rel="manifest" href="../mani/manifest.json" />
</head>
<body>
<nav class="topnav navbar bg-dark fixed-top navbar-expand-lg bg-body-tertiary border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid topnav-padding">
    <a class="navbar-brand" href="../index.php"><img alt="The Movie Buffs" src="../imgs/tmb.png" class="mb-nav-logo"/><div class="nav-bar-title">&nbsp;TheMovieBuffs</div></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link" aria-current="page" href="../index.php">Home</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Movies
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">Latest Releases</a></li>
            <li><a class="dropdown-item" href="#">Best Movies All Time </a></li>
            <li><a class="dropdown-item" href="#">Best Movies This Year  </a></li>
            <li><a class="dropdown-item" href="#">Best Action Movies</a></li>
            <li><a class="dropdown-item" href="#">Best Comedy Movies</a></li>
            <li><a class="dropdown-item" href="#">Best Horror Movies</a></li>
          </ul>
        </li>
      </ul>
      <form class="d-flex topnav-search-box-can" role="search">
        <input class="form-control me-2 topnav-search-box" type="search" placeholder="Search Movies" aria-label="Search">
        <button class="btn btn-outline-secondary topnav-search-btn" type="submit"><img alt=".." src="../imgs/search_icon.png" class="search-icon"/></button>
      </form>
      <?php
        if(empty($_SESSION["logged_in"]) || $_SESSION["logged_in"] == false){
          echo '<button type="button" class="btn register-btn" data-bs-toggle="modal" data-bs-target="#signinModal">LOGIN</button>';
        } 
        else {
          echo "<div class='navbar-greeting'>Hello, " . $_SESSION["get_user"]['username'] . "</div>";
          echo '<li class="nav-item dropdown user-drop">
                  <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img alt="user" src="../imgs/user-circle.png" class="user-logo"/>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="./preferrences.php">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Lists</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item" href="../php/logout.php">LOGOUT </a></li>
                  </ul>
                </li>';
        }
        ?>
    </div>
  </div>
</nav>

<!-- SignIn Modal -->
<div class="modal fade" id="signinModal" tabindex="-1" aria-labelledby="signinModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
    <div class="modal-content creds-can">
      <div class="modal-header mh-login-register">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <h1 class="modal-title fs-5" id="exampleModalLabel"><img alt="The Movie Buffs" src="../imgs/tmb.png" class="mb-nav-logo"/>&nbsp;TheMovieBuffs</h1>
        <ul class="nav nav-underline">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Sign In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nl-nonactive" href="#" data-bs-toggle="modal" data-bs-target="#registerModal">Register</a>
          </li>
        </ul>
      </div>
      <div class="modal-body creds-modal-body">
        <div class="creds-msg">Welcome back!</div>
        <div class="creds-form-can">
          <form method="post" action="">
            <label for="email" class="form-label creds-label">Email</label><br>
            <input type="text" id="email" name="email" class="form-control creds-input-field"><br>
            <label for="psswd" class="form-label creds-label">Password</label><br>
            <input type="password" id="psswd" name="psswd" class="form-control creds-input-field">
          <br>
          <div class="creds-btns-can">
          <button type="submit" name="Login" class="btn btn-primary creds-form-btns creds-form-confirm ">Sign In</button>
          <button type="button" class="btn btn-secondary creds-form-btns" data-bs-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Register Modal -->
<div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
    <div class="modal-content creds-can">
      <div class="modal-header mh-login-register">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <h1 class="modal-title fs-5" id="exampleModalLabel"><img alt="The Movie Buffs" src="../imgs/tmb.png" class="mb-nav-logo"/>&nbsp;TheMovieBuffs</h1>
        <ul class="nav nav-underline">
          <li class="nav-item">
            <a class="nav-link nl-nonactive"  href="#" data-bs-toggle="modal" data-bs-target="#signinModal">Sign In</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Register</a>
          </li>
        </ul>
      </div>
      <div class="modal-body creds-modal-body">
      <div class="creds-msg">
      Join TheMovieBuffs today to rate, review, and discover new movies and adventures!
      </div>
        <div class="creds-form-can">
          <form method="post" action="">
            <label for="register_user" class="form-label creds-label">Username</label><br>
            <input type="text" id="register_user" name="register_user" class="form-control creds-input-field"><br>
            <label for="register_email" class="form-label creds-label">Email</label><br>
            <input type="text" id="register_email" name="register_email" class="form-control creds-input-field"><br>
            <label for="register_password" class="form-label creds-label">Password</label><br>
            <input type="password" id="register_password" name="register_password" class="form-control creds-input-field">
          <br>
          <div class="creds-btns-can">
            <button type="submit" name="register" class="btn btn-primary creds-form-btns creds-form-confirm">Resgister</button>
            <button type="button" class="btn btn-secondary creds-form-btns" data-bs-dismiss="modal">Close</button>
          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page Contents -->
<div class="page-contents container lp-can">
  <h1 class="lp-section-hdr">Watchlist</h1>
    <div class="lp-watchlist-can">
    <?php
        foreach ($watchlist as $key => $item) {
          $movieid = $item['mID'];
            $deets = getMovieDeets($TMDB_API_KEY, $movieid);

            $id = $deets['id'];
            $temp = $deets['original_title'];
            $title = '"'. $temp . '"';
            $img = $poster_base . $deets['poster_path'];
            $rating = number_format($deets['vote_average'],1);

            if ($rating > 7.4) {
              $rateColor = "#93FFCD";
            }
            if ($rating < 7.5) {
              $rateColor = "#FFE38E";
            }
            if ($rating < 5.6) {
              $rateColor = "#FFBBB9";
            }


            $card = <<<CONTENT
                    <div class="watchlist-card">
                      <a class="watchlist-img-link" href="./movie.php?mid=$id" rel="noopener noreferrer">
                        <img src="$img" alt="" class="wl-img-cover"/>
                      </a>
                      <div class="wl-film-info">
                        <div class="wl-film-title">$title</div>
                        <div class="wl-film-rate" style="background-color:$rateColor;">$rating</div>
                      </div>
                    </div>
                    CONTENT;
            echo $card;
        }
      ?>
    </div>

  <h1 class="lp-section-hdr">Seenlist</h1>
  <div class="lp-watchlist-can">
    <?php
        foreach ($seenlist as $key => $item) {
          $movieid = $item['mID'];
            $deets = getMovieDeets($TMDB_API_KEY, $movieid);

            $id = $deets['id'];
            $temp = $deets['original_title'];
            $title = '"'. $temp . '"';
            $img = $poster_base . $deets['poster_path'];
            $rating = number_format($deets['vote_average'],1);

            if ($rating > 7.4) {
              $rateColor = "#93FFCD";
            }
            if ($rating < 7.5) {
              $rateColor = "#FFE38E";
            }
            if ($rating < 5.6) {
              $rateColor = "#FFBBB9";
            }


            $card = <<<CONTENT
                    <div class="watchlist-card">
                      <a class="watchlist-img-link" href="./movie.php?mid=$id" rel="noopener noreferrer">
                        <img src="$img" alt="" class="wl-img-cover"/>
                      </a>
                      <div class="wl-film-info">
                        <div class="wl-film-title">$title</div>
                        <div class="wl-film-rate" style="background-color:$rateColor;">$rating</div>
                      </div>
                    </div>
                    CONTENT;
            echo $card;
        }
      ?>
    </div>


  <h1 class="lp-section-hdr">Custom Lists</h1>
  <p class="cl-coming-soon">Coming Soon!</p>

</div>


<?php
require_once("./footer.php");
?>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>



