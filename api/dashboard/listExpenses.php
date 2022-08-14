<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
include_once '../../conn/db.php';
include_once '../../util/cors.php';

$_DATA = json_decode(file_get_contents('php://input'), true);
$ID = $_DATA['ID'];
$SQL = "SELECT * FROM expenses where owner_id = '$ID'";
$result = $db->query($SQL);

$expenses = array();
while ($row = $result->fetch_assoc()) {
    array_push($expenses,array(
        "ID" => $row["expense_id"],
        "title" => $row["expense_title"],
        "land" => $row["land_id"],
        "cost" => $row["expense_cost"],
    ));
}

echo json_encode($expenses);