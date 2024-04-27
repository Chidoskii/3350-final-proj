<?php
require_once("../php/config.php");

if(empty($_SESSION["logged_in"])){
  header("location: ../index.php");
}

if($_SESSION["logged_in"] == false){
  header("location: ../index.php");
}

$mID = "";
$deets = "";
$similar = "";
$cast = "";
$filler = "../imgs/filler.jpg";
$config = configsTMDB();
$poster_base = $config['images']['secure_base_url'] . $config['images']['poster_sizes'][4];
$backdrop_base = $config['images']['secure_base_url'] . $config['images']['backdrop_sizes'][3];
$backdrop_base_small = $config['images']['secure_base_url'] . $config['images']['backdrop_sizes'][1];
$poster = "";
$backdrop = "";
$backdrop_small = "";


if (isset($_GET["mid"])){
  $mID = $_GET["mid"];
  $deets = getMovieDeets($TMDB_API_KEY, $mID);
  $similar = getSimilarMovies($TMDB_API_KEY, $mID);
  $cast = getCast($TMDB_API_KEY, $mID);
  $poster =  $poster_base . $deets['poster_path'];
  $backdrop =  $backdrop_base . $deets['backdrop_path'];
  $backdrop_small =  $backdrop_base_small . $deets['backdrop_path'];
}



?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $PROJECT_NAME ?> | MyProfile</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../styles/navbar.css">
    <link rel="stylesheet" href="../styles/reel.css">
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="shortcut icon" href="../../imgs/favicon.ico" />
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
          <a class="nav-link active" aria-current="page" href="../index.php">Home</a>
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
          echo '<li class="nav-item dropdown user-drop">
                  <a class="nav-link " href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  <img alt="user" src="../imgs/user-circle.png" class="user-logo"/>
                  </a>
                  <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">MyProfile Settings</a></li>
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
          <form>
            <label for="email" class="form-label creds-label">Email</label><br>
            <input type="text" id="email" name="email" class="form-control creds-input-field"><br>
            <label for="psswd" class="form-label creds-label">Password</label><br>
            <input type="text" id="psswd" name="psswd" class="form-control creds-input-field">
          </form>
          <br>
          <div class="creds-btns-can">
          <button type="button" class="btn btn-primary creds-form-btns creds-form-confirm ">Sign In</button>
          <button type="button" class="btn btn-secondary creds-form-btns" data-bs-dismiss="modal">Close</button>
          </div>
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
          <form>
            <label for="uname" class="form-label creds-label">Username</label><br>
            <input type="text" id="uname" name="uname" class="form-control creds-input-field"><br>
            <label for="email" class="form-label creds-label">Email</label><br>
            <input type="text" id="email" name="email" class="form-control creds-input-field"><br>
            <label for="psswd" class="form-label creds-label">Password</label><br>
            <input type="text" id="psswd" name="psswd" class="form-control creds-input-field">
          </form>
          <br>
          <div class="creds-btns-can">
          <button type="button" class="btn btn-primary creds-form-btns creds-form-confirm">Resgister</button>
          <button type="button" class="btn btn-secondary creds-form-btns" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page Contents -->
<div class="backdrop-showcase" style="background-image: url(<?php echo $backdrop; ?>)">\
  <div class="film-package">
    <div class="film-cover-image-can"><img class="movie-cover-img" src="<?php echo $poster; ?>" /></div>
    <div class="mp-film-bd-info">
      <h1 class="mp-film-title"><?php echo $deets['title']; ?></h1>
      <p class="mp-film-desc"><?php echo $deets['overview']; ?></p>
      <div class="mp-film-opts-can">
        <div class="mp-film-opts rating">
          <div class="mp-film-opts-hdr ">TMDB RATING</div>
          <div class="mp-film-opts-item tmdb-rating"><?php echo number_format($deets['vote_average'], 1); ?>/10</div>
        </div>
        <div class="mp-film-opts">
          <div class="mp-film-opts-hdr">REVIEW</div>
          <div class="mp-film-opts-item"></div>
        </div>
        <div class="mp-film-opts">
          <div class="mp-film-opts-hdr">WATCHLIST</div>
          <div class="mp-film-opts-item"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="backdrop-showcase-mobile" style="background-image: url(<?php echo $backdrop_small; ?>)">
  <div class="film-package">
    <div class="film-cover-image-can"><img class="movie-cover-img" src="<?php echo $poster; ?>" /></div>
    <div class="mp-film-bd-info">
      <h1 class="mp-film-title"><?php echo $deets['title']; ?></h1>
    </div>
  </div>
</div>
<div class="moviepage-contents container">

    <div class="mp-section-hdr">Videos</div>
    <div class="reel-container">
    <h2 class="movie-reel-title">Cast</h2>
    <br>
      <div class="slider-wrapper">
        <button id="prev-slide" class="slide-button material-symbols-rounded">
        <img src="../imgs/reel/chev-left.png" alt="..." class="chevy" />
        </button>
        <ul class="image-list">
          <?php
            foreach ($cast as $key => $person) {
              if ($key == "cast") {
                foreach ($person as $key => $value) {
                  $id = $value['id'];
                  $name = $value['name'];
                  $role = $value['known_for_department'];
                  $img = $poster_base . $value['profile_path'];
                  $fame = number_format($value['popularity'],1);

                  if ($img == $poster_base) {
                    $img = $filler;
                  }
                  
                  $card = <<<CONTENT
                  <div class="film-info-can">  
                    <img class="image-item" src="$img" alt="Yikes!" />
                    <div class="film-details">
                      <div class="film-desc-deets">
                        <a class="film-title-link" href="#" rel="noopener noreferrer">
                          <p class="img-reel-film-title">$name</p>
                        </a>
                        <p class="img-reel-film-genre">Role: $role</p>
                      </div>
                      <div class="film-ratings-deets">
                        <p class="img-reel-ratings-title">Fame</p>
                        <div class="img-reel-rating-can">
                          <p class="img-reel-ratings">$fame</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  CONTENT;
                echo $card;
                }
              }
            }
          ?>          
        </ul>
        <button id="next-slide" class="slide-button material-symbols-rounded">
          <img src="../imgs/reel/chev-right.png" alt="..." class="chevy" />
        </button>
      </div>
      <div class="slider-scrollbar">
        <div class="scrollbar-track">
          <div class="scrollbar-thumb"></div>
        </div>
      </div>
    </div>

    <div class="reel-container">
    <h2 class="movie-reel-title">Similar</h2>
    <br>
      <div class="slider-wrapper">
        <button id="new-prev-slide" class="nr-slide-button material-symbols-rounded">
        <img src="../imgs/reel/chev-left.png" alt="..." class="chevy" />
        </button>
        <ul class="new-r-image-list">
          <?php
            foreach ($similar as $key => $movie) {
              if ($key == "results") {
                foreach ($movie as $key => $value) {
                  $id = $value['id'];
                  $temp = $value['original_title'];
                  $title = '"'. $temp . '"';
                  $release = $value['release_date'];
                  $date = date_create($release);
                  $format = date_format($date, 'F jS Y');
                  $img = $poster_base . $value['poster_path'];
                  $rating = number_format($value['vote_average'],1);
                  
                  $card = <<<CONTENT
                  <div class="film-info-can">  
                    <img class="image-item" src="$img" alt="Yikes!" />
                    <div class="film-details">
                      <div class="film-desc-deets">
                        <a class="film-title-link" href="./movie.php?mid=$id" rel="noopener noreferrer">
                         <p class="img-reel-film-title">$title</p>
                        </a>
                        <p class="img-reel-film-genre">Realesed: $format</p>
                      </div>
                      <div class="film-ratings-deets">
                        <p class="img-reel-ratings-title">Rating</p>
                        <div class="img-reel-rating-can">
                          <p class="img-reel-ratings">$rating</p>
                        </div>
                      </div>
                    </div>
                  </div>
                  CONTENT;
                echo $card;
                }
              }
            }
          ?>          
        </ul>
        <button id="new-next-slide" class="nr-slide-button material-symbols-rounded">
          <img src="../imgs/reel/chev-right.png" alt="..." class="chevy" />
        </button>
      </div>
      <div class="nr-slider-scrollbar">
        <div class="scrollbar-track">
          <div class="nr-scrollbar-thumb"></div>
        </div>
      </div>
    </div>
  
</div>

<?php
require_once("./footer.php");
?>

<script src="../scripts/slide.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>



