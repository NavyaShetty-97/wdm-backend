<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
include_once '../../conn/db.php';
include_once '../../util/cors.php';

$_DATA = json_decode(file_get_contents('php://input'), true);
$ID = $_DATA['ID'];

$SQL = "SELECT * FROM projects where owner_id = '$ID'";
$result = $db->query($SQL);
$projects = array();
while ($row = $result->fetch_assoc()) {
    array_push($projects,array(
        "ID" => $row["project_id"],
        "title" => $row["project_title"],
        "land" => $row["land_id"],
        "cost" => $row["project_cost"],
    ));
}

echo json_encode($projects);