<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
include_once '../../conn/db.php';
include_once '../../util/cors.php';
$SQL = "SELECT * FROM Users where Level = 1";
// $exeSQL = mysqli_query($db, $SQL);
$result = $db->query($SQL);
    // $row = $result->fetch_assoc();
    // $count = $row['count'];
$ancestors = array();
while ($row = $result->fetch_assoc()) {
    // printf("%s (%s)\n", $row["Name"], $row["CountryCode"]);
    array_push($ancestors,$row);
}

echo json_encode($ancestors);