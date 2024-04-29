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

/*-----------------------------------------------GENERAL-----------------------------------------------*/
function consoleLog($data) {
    $output = $data;
    if (is_array($output))
        $output = implode(',', $output);

    echo "<script>console.log('Debug Objects: " . $output . "' );</script>";
}

?>