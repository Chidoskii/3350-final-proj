<?php
/*-----------------------------------------------LOG IN-----------------------------------------------*/
function get_ven($email) {
    $db = get_mysqli_connection();
    $query = $db->prepare("SELECT * FROM Vendors  WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    $results = $result->fetch_all(MYSQLI_ASSOC);

    
    return $results[0];

}

function get_user($email) {
    $db = get_mysqli_connection();
    $query = $db->prepare("SELECT * FROM User  WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    $results = $result->fetch_all(MYSQLI_ASSOC);

    
    return $results[0];

}

/*-----------------------------------------------USER-----------------------------------------------*/

function getUserId($email) {
    $db = get_mysqli_connection();
    $query = $db->prepare("SELECT userID FROM User  WHERE email = ?");
    $query->bind_param("s", $email);
    $query->execute();
    $result = $query->get_result();
    $results = $result->fetch_all(MYSQLI_ASSOC);


    return $results[0]['userID'];

}

function getWatchlistId($id) {
    $lt = "watch";
    $db = get_mysqli_connection();
    $query = $db->prepare("SELECT * FROM Lists  WHERE u_ID = ? and ltype = ?");
    $query->bind_param("is", $id, $lt);
    $query->execute();
    $result = $query->get_result();
    $results = $result->fetch_all(MYSQLI_ASSOC);

    
    return $results[0]['listID'];

}

function onWatchlist($id, $mid) {
    $outcome = false;
    $db = get_mysqli_connection();
    $query = $db->prepare("SELECT * FROM List_Items  WHERE lID = ? and mID = ?");
    $query->bind_param("ii", $id, $mid);
    $query->execute();
    $result = $query->get_result();
    $results = $result->fetch_all(MYSQLI_ASSOC);

    if (count($results) > 0) {
        $outcome = true;
    }

    return $outcome;
}

function getSeenlistId($id) {
    $lt = "seen";
    $db = get_mysqli_connection();
    $query = $db->prepare("SELECT * FROM Lists  WHERE u_ID = ? and ltype = ?");
    $query->bind_param("is", $id, $lt);
    $query->execute();
    $result = $query->get_result();
    $results = $result->fetch_all(MYSQLI_ASSOC);

    
    return $results[0]['listID'];

}

function onSeenlist($id, $mid) {
    $outcome = false;
    $db = get_mysqli_connection();
    $query = $db->prepare("SELECT * FROM List_Items  WHERE lID = ? and mID = ?");
    $query->bind_param("ii", $id, $mid);
    $query->execute();
    $result = $query->get_result();
    $results = $result->fetch_all(MYSQLI_ASSOC);

    if (count($results) > 0) {
        $outcome = true;
    }

    return $outcome;
}

function getReviewContent($id, $mid) {
    $msg = "empty";
    $db = get_mysqli_connection();
    $query = $db->prepare("SELECT * FROM Reviews  WHERE u_ID = ? and mID = ?");
    $query->bind_param("ii", $id, $mid);
    $query->execute();
    $result = $query->get_result();
    $results = $result->fetch_all(MYSQLI_ASSOC);
    
    if (count($results) > 0) {
        $msg = $results[0]['critique'];
    }
    return $msg;
}

function isReviewed($id, $mid) {
    $outcome = false;
    $db = get_mysqli_connection();
    $query = $db->prepare("SELECT * FROM Reviews  WHERE u_ID = ? and mID = ?");
    $query->bind_param("ii", $id, $mid);
    $query->execute();
    $result = $query->get_result();
    $results = $result->fetch_all(MYSQLI_ASSOC);
    
    if (count($results) > 0) {
        $outcome = true;
    }

    return $outcome;
}

/*-----------------------------------------------GENERAL-----------------------------------------------*/
function consoleLog($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

/*----------------------------------------------DROPDOWN-----------------------------------------------*/

if (isset($_POST["dropdown-item"])) {
    $dropdown = $_POST['dropdowndata'];
switch($dropdown)
{
    case "Latest Releases":
        {
            $curl = curl_init();

            curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.themoviedb.org/3/movie/latest",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0NWVmNTIxOGZhOTRiMzE5NjA1MGY0OGM3ZTYxZjdhNiIsInN1YiI6IjY2MjgwZmVmZTI5NWI0MDE4NzlkMWI4MiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.6sLEniSyAV0TUUzaYm-dZlBOt6GnsNWv5iNV2z1sNss",
                "accept: application/json"
            ],
            ]);

            $release = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
            echo "cURL Error #:" . $err;
            //die();
            } else {
                //$release = json_decode($release, true);
                return $release;
            }
            break;
        }
    case "Best Movies All Time":
    {  
    http_response_code(404); //Not implemented
    $_SESSION["Not Implemented"] = "Function does not exist for this request";
    die();
    break;
    }
    case "Best Movies This Year":
    {
    http_response_code(404);
    $_SESSION["Not Implemented"] = "Function does not exist for this request";
    die();
    break;
    }
    case "Best Action Movies":
        {
            $curl = curl_init();

            curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?language=en-US&page=1&sort_by=vote_average.desc&vote_average.gte=8&vote_count.gte=10&with_genres=28",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0NWVmNTIxOGZhOTRiMzE5NjA1MGY0OGM3ZTYxZjdhNiIsInN1YiI6IjY2MjgwZmVmZTI5NWI0MDE4NzlkMWI4MiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.6sLEniSyAV0TUUzaYm-dZlBOt6GnsNWv5iNV2z1sNss",
                "accept: application/json"
            ],
            ]);

            $action = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
            echo "cURL Error #:" . $err;
            //die();
            } else {
            //$action = json_decode($action, true);
            return $action;
            }
            break;
        }
    case "Best Comedy Movies":
        {
            $curl = curl_init();

            curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?language=en-US&page=1&sort_by=vote_average.desc&vote_average.gte=8&vote_count.gte=10&with_genres=35",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0NWVmNTIxOGZhOTRiMzE5NjA1MGY0OGM3ZTYxZjdhNiIsInN1YiI6IjY2MjgwZmVmZTI5NWI0MDE4NzlkMWI4MiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.6sLEniSyAV0TUUzaYm-dZlBOt6GnsNWv5iNV2z1sNss",
                "accept: application/json"
            ],
            ]);

            $comedies = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
            echo "cURL Error #:" . $err;
            //die();
            } else {
            //$comedies = json_decode($comedies, true);
            return $comedies;
            }
            break;
        }
    case "Best Horror Movies":
        {
            $curl = curl_init();

            curl_setopt_array($curl, [
            CURLOPT_URL => "https://api.themoviedb.org/3/discover/movie?language=en-US&page=1&sort_by=vote_average.desc&vote_average.gte=8&vote_count.gte=10&with_genres=27",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => [
                "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI0NWVmNTIxOGZhOTRiMzE5NjA1MGY0OGM3ZTYxZjdhNiIsInN1YiI6IjY2MjgwZmVmZTI5NWI0MDE4NzlkMWI4MiIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.6sLEniSyAV0TUUzaYm-dZlBOt6GnsNWv5iNV2z1sNss",
                "accept: application/json"
            ],
            ]);

            $horror = curl_exec($curl);
            $err = curl_error($curl);

            curl_close($curl);

            if ($err) {
            echo "cURL Error #:" . $err;
            //die();
            } else {
                //$horror = json_decode($horror, true);
            return $horror;
            }
            break;
        }
    default:
    {
        http_response_code(400);
        $_SESSION["Failed search"] = "Form did not pass correctly";
        echo "Failed to get event";
        die();
    }
}
}
?>