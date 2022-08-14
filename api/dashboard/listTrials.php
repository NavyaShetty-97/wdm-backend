<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
include_once '../../conn/db.php';
include_once '../../util/cors.php';

$_DATA = json_decode(file_get_contents('php://input'), true);
$ID = $_DATA['ID'];
$SQL = "SELECT * FROM trials where owner_id = '$ID'";
$result = $db->query($SQL);

$trials = array();
while ($row = $result->fetch_assoc()) {
    array_push($trials,array(
        "ID" => $row["trial_id"],
        "title" => $row["trial_title"],
        "land" => $row["land_id"],
        "cost" => $row["trial_cost"],
    ));
}

echo json_encode($trials);