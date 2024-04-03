<?php
require_once("config.php");

session_destroy();

header("Location: ../pages/login.php");

?>