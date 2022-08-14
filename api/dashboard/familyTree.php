<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
include_once '../../conn/db.php';
include_once '../../util/cors.php';

$_DATA = json_decode(file_get_contents('php://input'), true);
$ID = $_DATA['ID'];
$SQL = "SELECT * FROM Users where ParentID = '$ID'";
$result = $db->query($SQL);
$family = array();

$children = array();
$index = 1;
while ($row = $result->fetch_assoc()) {
    array_push($children, $row['FirstName'].' '.$row['LastName']);

    $index = $index + 1;
}

$SQL = "SELECT * FROM Users where ID = '$ID'";
$result = $db->query($SQL);
$row = $result->fetch_assoc();
$User = $row['FirstName'].' '.$row['LastName'];

$ancestors = array();
array_push($ancestors, $User);

while ($row['ParentID'] != NULL) {
    $PID = $row['ParentID'];
    $SQL = "SELECT * FROM Users where ID = '$PID'";
    $result = $db->query($SQL);
    $row = $result->fetch_assoc();
    array_push($ancestors, $row['FirstName'].' '.$row['LastName']);
}

$ancestors = array_reverse($ancestors);

echo json_encode(array(
    "children" => $children,
    "ancestors" => $ancestors
));