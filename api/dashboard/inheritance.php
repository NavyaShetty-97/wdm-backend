<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
include_once '../../conn/db.php';
include_once '../../util/cors.php';

$_DATA = json_decode(file_get_contents('php://input'), true);
$ID = $_DATA['ID'];

$SQL = "SELECT * FROM Users where ID = '$ID'";
$result = $db->query($SQL);
$row = $result->fetch_assoc();

$Levels = 0;
$ancestors = array();
while($row['ParentID']) {
    $Parent = $row['ParentID'];
    $SQL = "SELECT * FROM Users where ID = '$Parent'";
    $result = $db->query($SQL);
    $row = $result->fetch_assoc();
    array_push($ancestors, $row['ID']);

    $Levels = $Levels + 1;
}

$LandOwned = 0;
while($Levels > 0) {
    $index = $ancestors[$Levels - 1];
    $SQL = "SELECT * FROM Lands where OwnerID = '$index'";
    $result = $db->query($SQL);

    while ($land = $result->fetch_assoc()) {
        $LandOwned = $LandOwned + $land['Size'];
    }

    $SQL = "SELECT * FROM Users WHERE ParentID = '$index'";
    $result = mysqli_query($db, $SQL);       
    $num_rows = mysqli_num_rows($result);
    $LandOwned = $LandOwned / $num_rows;

    $Levels = $Levels - 1;
}

echo json_encode($LandOwned);