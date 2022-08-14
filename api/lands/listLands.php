<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
include_once '../../conn/db.php';
include_once '../../util/cors.php';

$_DATA = json_decode(file_get_contents('php://input'), true);
$ID = $_DATA['ID'];
$SQL = "SELECT * FROM Lands where OwnerID = '$ID'";
$result = $db->query($SQL);

$lands = array();
while ($row = $result->fetch_assoc()) {
    array_push($lands,$row);
}

echo json_encode($lands);