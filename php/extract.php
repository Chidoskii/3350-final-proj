<?php
require_once("./config.php");

define("DATA_DIR", "../files/");
$rand1 = rand(1000, 15000);
$rand2 = rand(25000, 75000);
$rand3 = $rand2 - $rand1;
$today = date("Y-m-d");
$filename = "insert-movies-$rand3.sql";
$upfilename = "upcoming-$today.sql";
$count = 1001;
define("SQL_FILE", DATA_DIR.$filename);
define("UP_FILE", DATA_DIR.$upfilename);
// MAKE SURE THE DATA DIRECTORY HAS BEEN CREATED
if (!file_exists(DATA_DIR)) {
  exit('files folder missing');
}

function findMovieByID($apikey, $id){
  // CREATE THE SQL INSERT FILE
  if(!file_exists(SQL_FILE)){
    if(!touch(SQL_FILE)){
        exit('data folder permissions not set');
    }
  }

  $curl = curl_init();

  curl_setopt_array($curl, [
    CURLOPT_URL => "https://api.themoviedb.org/3/movie/$id?language=en-US",
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => "",
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 30,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => "GET",
    CURLOPT_HTTPHEADER => [
      "Authorization: Bearer $apikey",
      "accept: application/json"
    ],
  ]);

  $movie = curl_exec($curl);
  $err = curl_error($curl);
  $config = configsTMDB();
  $base = $config['images']['secure_base_url'] . $config['images']['poster_sizes'][4];
  $id = "";
  $title = "";
  $release = "";
  $img = "";
  $rating = "";


  curl_close($curl);

  if ($err) {
    echo "cURL Error #:" . $err;
  } else {
    $movie = json_decode($movie, true);
    $img =  $base . $movie['belongs_to_collection']['poster_path'];
    $id = $movie['id'];
    $temp = $movie['original_title'];
    $title = '"'. $temp . '"';
    $release = $movie['release_date'];
    $rating = $movie['vote_average'];
    $statement = "INSERT INTO Movies (movie_ID, title, releaseDate, img, ovr) VALUES ($id, $title, '$release', '$img', $rating);";
    file_put_contents(SQL_FILE, $statement, FILE_APPEND);
    file_put_contents(SQL_FILE, "\n", FILE_APPEND);
  }
}



while ($count < 1001) {
  findMovieByID($TMDB_API_KEY, $count);
  $count++;
}

function storeUpcoming($list) {
  // CREATE THE SQL INSERT FILE
  if(!file_exists(UP_FILE)){
    if(!touch(UP_FILE)){
        exit('data folder permissions not set');
    }
  }

  echo "<pre>";
  print_r($list);
  echo "</pre>";

  $config = configsTMDB();
  $base = $config['images']['secure_base_url'] . $config['images']['poster_sizes'][4];
  $id = "";
  $title = "";
  $genre = "";
  $release = "";
  $img = "";
  $rating = "";

  foreach ($list as $key => $movie) {
    if ($key == "results") {
      foreach ($movie as $key => $value) {
        $id = $value['id'];
        $temp = $value['original_title'];
        $title = '"'. $temp . '"';
        $release = $value['release_date'];
        $img = $base . $value['poster_path'];
        $rating = $value['vote_average'];
        $statement = "INSERT INTO Movies (movie_ID, title, releaseDate, img, ovr) VALUES ($id, $title, '$release', '$img', $rating);";
        file_put_contents(UP_FILE, $statement, FILE_APPEND);
        file_put_contents(UP_FILE, "\n", FILE_APPEND);
      }
    }
  }
}

$upcoming = getUpcomingFilms();
storeUpcoming($upcoming);

?>