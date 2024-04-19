<?php
require_once("./php/config.php");

?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?= $PROJECT_NAME ?> | Movie Reviews and Ratings</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat+Alternates:ital,wght@0,400;0,600;0,700;1,600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./styles/navbar.css">
    <link rel="stylesheet" href="./styles/style.css">
    <link rel="stylesheet" href="./styles/reel.css">
    <link rel="shortcut icon" href="../imgs/favicon.ico" />
</head>
<body>
<nav class="topnav navbar bg-dark fixed-top navbar-expand-lg bg-body-tertiary border-bottom border-body" data-bs-theme="dark">
  <div class="container-fluid topnav-padding">
    <a class="navbar-brand" href="#"><img alt="The Movie Buffs" src="./imgs/tmb.png" class="mb-nav-logo"/><div class="nav-bar-title">&nbsp;TheMovieBuffs</div></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
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
        <button class="btn btn-outline-secondary topnav-search-btn" type="submit"><img alt=".." src="./imgs/search_icon.png" class="search-icon"/></button>
      </form>
      <button type="button" class="btn register-btn" data-bs-toggle="modal" data-bs-target="#signinModal">LOGIN</button>
    </div>
  </div>
</nav>

<!-- SignIn Modal -->
<div class="modal fade" id="signinModal" tabindex="-1" aria-labelledby="signinModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
    <div class="modal-content creds-can">
      <div class="modal-header mh-login-register">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        <h1 class="modal-title fs-5" id="exampleModalLabel"><img alt="The Movie Buffs" src="./imgs/tmb.png" class="mb-nav-logo"/>&nbsp;TheMovieBuffs</h1>
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
        <h1 class="modal-title fs-5" id="exampleModalLabel"><img alt="The Movie Buffs" src="./imgs/tmb.png" class="mb-nav-logo"/>&nbsp;TheMovieBuffs</h1>
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
          <button type="submit" name="register" class="btn btn-primary creds-form-btns creds-form-confirm">Resgister</button>
          <button type="button" class="btn btn-secondary creds-form-btns" data-bs-dismiss="modal">Close</button>
        </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Page Contents -->
<div class="page-contents container-md">




  <div class="home-page-show-title-can">
    <h1 class="home-page-show-header">Movies</h1>
    <div class="cheeky-hook">Ratings and reviews from the best critics in the business </div>
  </div>
  <br>
  <br>
  <br>
  <a href="./pages/preferrences.php"><button class="my-pf-page">My Profile</button></a>

  <div class="reel-container">
    <h2 class="movie-reel-title">New Releases</h2>
    <br>
      <div class="slider-wrapper">
        <button id="prev-slide" class="slide-button material-symbols-rounded">
        <img src="./imgs/reel/chev-left.png" alt="..." class="chevy" />
        </button>
        <ul class="image-list">
          <div class=film-info-can>  
          <img class="image-item" src="./imgs/reel/arc.jpg" alt="img-1" />
          <div class="film-details">
            <div class="film-desc-deets">
            <p class="img-reel-film-title">Movie Title</p>
            <p class="img-reel-film-genre">Movie Genre</p>
            </div>
            <div class="film-ratings-deets">
            <p class="img-reel-ratings-title">BuffScore</p>
            <div class="img-reel-rating-can">
            <p class="img-reel-ratings">75</p>
            </div>
            </div>
          </div>
          </div>
          <div class=film-info-can>
          <img class="image-item" src="./imgs/reel/arthur.jpg" alt="img-2" />
          <div class="film-details">
            <div class="film-desc-deets">
            <p class="img-reel-film-title">Movie Title</p>
            <p class="img-reel-film-genre">Movie Genre</p>
            </div>
            <div class="film-ratings-deets">
            <p class="img-reel-ratings-title">BuffScore</p>
            <div class="img-reel-rating-can">
            <p class="img-reel-ratings">75</p>
            </div>
            </div>
          </div>
          </div>
          <div class=film-info-can>
          <img class="image-item" src="./imgs/reel/boby.jpg" alt="img-3" />
          <div class="film-details">
            <div class="film-desc-deets">
            <p class="img-reel-film-title">Movie Title</p>
            <p class="img-reel-film-genre">Movie Genre</p>
            </div>
            <div class="film-ratings-deets">
            <p class="img-reel-ratings-title">BuffScore</p>
            <div class="img-reel-rating-can">
            <p class="img-reel-ratings">75</p>
            </div>
            </div>
          </div>
          </div>
          <div class=film-info-can>
          <img class="image-item" src="./imgs/reel/dunee.jpg" alt="img-4" />
          <div class="film-details">
            <div class="film-desc-deets">
            <p class="img-reel-film-title">Movie Title</p>
            <p class="img-reel-film-genre">Movie Genre</p>
            </div>
            <div class="film-ratings-deets">
            <p class="img-reel-ratings-title">BuffScore</p>
            <div class="img-reel-rating-can">
            <p class="img-reel-ratings">75</p>
            </div>
            </div>
          </div>
          </div>
          <div class=film-info-can>
          <img class="image-item" src="./imgs/reel/ghosts.jpg" alt="img-5" />
          <div class="film-details">
            <div class="film-desc-deets">
            <p class="img-reel-film-title">Movie Title</p>
            <p class="img-reel-film-genre">Movie Genre</p>
            </div>
            <div class="film-ratings-deets">
            <p class="img-reel-ratings-title">BuffScore</p>
            <div class="img-reel-rating-can">
            <p class="img-reel-ratings">75</p>
            </div>
            </div>
          </div>
          </div>
          <div class=film-info-can>
          <img class="image-item" src="./imgs/reel/gochilla.jpg" alt="img-6" />
          <div class="film-details">
            <div class="film-desc-deets">
            <p class="img-reel-film-title">Movie Title</p>
            <p class="img-reel-film-genre">Movie Genre</p>
            </div>
            <div class="film-ratings-deets">
            <p class="img-reel-ratings-title">BuffScore</p>
            <div class="img-reel-rating-can">
            <p class="img-reel-ratings">75</p>
            </div>
            </div>
          </div>
          </div>
          <div class=film-info-can>
          <img class="image-item" src="./imgs/reel/monkey.jpg" alt="img-7" />
          <div class="film-details">
            <div class="film-desc-deets">
            <p class="img-reel-film-title">Movie Title</p>
            <p class="img-reel-film-genre">Movie Genre</p>
            </div>
            <div class="film-ratings-deets">
            <p class="img-reel-ratings-title">BuffScore</p>
            <div class="img-reel-rating-can">
            <p class="img-reel-ratings">75</p>
            </div>
            </div>
          </div>
          </div>
          <div class=film-info-can>
          <img class="image-item" src="./imgs/reel/omen.jpg" alt="img-8" />
          <div class="film-details">
            <div class="film-desc-deets">
            <p class="img-reel-film-title">Movie Title</p>
            <p class="img-reel-film-genre">Movie Genre</p>
            </div>
            <div class="film-ratings-deets">
            <p class="img-reel-ratings-title">BuffScore</p>
            <div class="img-reel-rating-can">
            <p class="img-reel-ratings">75</p>
            </div>
            </div>
          </div>
          </div>
          <div class=film-info-can>
          <img class="image-item" src="./imgs/reel/panda.jpg" alt="img-9" />
          <div class="film-details">
            <div class="film-desc-deets">
            <p class="img-reel-film-title">Movie Title</p>
            <p class="img-reel-film-genre">Movie Genre</p>
            </div>
            <div class="film-ratings-deets">
            <p class="img-reel-ratings-title">BuffScore</p>
            <div class="img-reel-rating-can">
            <p class="img-reel-ratings">75</p>
            </div>
            </div>
          </div>
          </div>
          <div class=film-info-can>
          <img class="image-item" src="./imgs/reel/stingy.jpg" alt="img-10" />
          <div class="film-details">
            <div class="film-desc-deets">
            <p class="img-reel-film-title">Movie Title</p>
            <p class="img-reel-film-genre">Movie Genre</p>
            </div>
            <div class="film-ratings-deets">
            <p class="img-reel-ratings-title">BuffScore</p>
            <div class="img-reel-rating-can">
            <p class="img-reel-ratings">75</p>
            </div>
            </div>
          </div>
        </div>
        </ul>
        <button id="next-slide" class="slide-button material-symbols-rounded">
          <img src="./imgs/reel/chev-right.png" alt="..." class="chevy" />
        </button>
      </div>
      <div class="slider-scrollbar">
        <div class="scrollbar-track">
          <div class="scrollbar-thumb"></div>
        </div>
      </div>
    </div>
</div>



<br>
<br>
<br>
<br>
<footer>

  <div class="container-fluid footy-can">
    <div class="footy-header"><img alt="The Movie Buffs" src="./imgs/tmb.png" class="mb-nav-logo"/>&nbsp;TheMovieBuffs</div>
    <div class="footer-links-can">
      <div class="footy-links-l">
        <p class="footy-sub-header">Overview</p>
        <a class="footy-link-list" href="#">Careers</a>
        <a class="footy-link-list" href="#">Terms of Use</a>
        <a class="footy-link-list" href="#">For Developers</a>
        <a class="footy-link-list" href="#">Don't Sell My Personal Info </a>
      </div>
      <div class="footy-links-m">
        <p class="footy-sub-header">Connect With Us</p>
        <div class="socials-box container">
        <a class="footy-link-list" href="#"><img alt="..." src="https://cdn.icon-icons.com/icons2/818/PNG/512/Social-35-Linkedin-Outline_icon-icons.com_66384.png" class="footy-social-icon"/></a>
        <a class="footy-link-list" href="https://github.com/Chidoskii/TheMovieBuffs" target="_blank" rel="noopener noreferrer" ><img alt="..." src="https://cdn.icon-icons.com/icons2/510/PNG/512/social-github-outline_icon-icons.com_50020.png" class="footy-social-icon"/></a>
        <a class="footy-link-list" href="#"><img alt="..." src="https://cdn.icon-icons.com/icons2/510/PNG/512/social-twitter-outline_icon-icons.com_49997.png" class="footy-social-icon"/></a>
        </div>
      </div>
      <div class="footy-links-r">
        <p class="footy-sub-header">Customer Support</p>
        <a class="footy-link-list" href="#">Your Account</a>
        <a class="footy-link-list" href="#">Help Center</a>
        <a class="footy-link-list" href="#">Contact Us</a>
      </div>
    </div>
    <div class="footer-copyright">
      &copy;&nbsp;
      <div class="moviebuffs-copyright">
      TheMovieBuffs
      </div>
      &nbsp;
      2024. All Rights Reserved.
    </div>
  </div>

</footer>

<script src="./scripts/slide.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>



