<?php
require_once("../php/config.php");

if(empty($_SESSION["logged_in"])){
  header("location: ../index.php");
}

if($_SESSION["logged_in"] == false){
  header("location: ../index.php");
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
<div class="page-contents container-fluid">
  <div class="my-prof-page-show-title-can">
  <div class="ratatouille">
  <button class="btn btn-primary exp-offcan" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
    <img  src="../imgs/ham.png" height="33px"/>
  </button>

  <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">My Profile</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <ul class="off-canv-opt">
          <li><a id="my-prof-account-opt" class="my-prof-opt" href="#">My Account</a></li>
          <li><a id="my-prof-rr-opt" class="my-prof-opt" href="#">My Ratings & Reviews</a></li>
        </ul>
    </div>
  </div>
  </div>
    <h1 class="my-prof-page-show-header">My Profile</h1>
  </div>
  <div class="pref-page container-md">
    <div id="my-account-pref" class="account-opts"> 
      <h2 class="account-opt-header">Profile Settings</h2>
      <div class="sub-page-contents">
        <div class="settings-can">
          <form>
            <label for="email" class="form-label creds-label">Email</label><br>
            <input type="text" id="email" name="email" placeholder="Current Email" class="form-control creds-input-field"><br>
            <label for="uname" class="form-label creds-label">Username</label><br>
            <input type="text" id="uname" name="uname" placeholder="Current Username" class="form-control creds-input-field"><br>
          </form>
          <br>
          <br>
          <button id="change-pass-btn" class="btn btn-dark">Change Password</button>
          <br>
          <br>
          <div id="password-form-change" class="hidden">
            <h3>Change Password</h3>
            <br>
          <form>
            <label for="currpass" class="form-label creds-label">Current Password</label><br>
            <input type="text" id="currpass" name="currpass" class="form-control creds-input-field"><br>
            <label for="newpass" class="form-label creds-label">New Password</label><br>
            <input type="text" id="newpass" name="newpass" class="form-control creds-input-field"><br>
            <label for="conpass" class="form-label creds-label">Confirm New Password</label><br>
            <input type="text" id="conpass" name="conpass" class="form-control creds-input-field"><br>
          </form>
          <div class="pass-form-button-opts">
          <button id="submit-pass-btn" class="btn btn-dark">Save</button>
          <button id="cancel-pass-btn" class="btn btn-dark">Cancel</button>
          </div>
          </div>
        
          </div>
      </div>
    </div>
    <div id="my-review-pref" class="account-opts hidden"> SPIN THAT BLOCK</div>
  </div>




</div>
<?php
require_once("./footer.php");
?>

<script src="../scripts/script.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>



