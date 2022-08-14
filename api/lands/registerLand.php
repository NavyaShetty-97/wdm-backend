
<?php

// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 

include_once '../../conn/db.php';
include_once '../../util/cors.php';

$_DATA = json_decode(file_get_contents('php://input'), true);
$ID = $_DATA['ID'];
$Size = $_DATA['size'];
$sql = "INSERT INTO `Lands`(`OwnerID`, `LandDesc`, `Size`) VALUES ('$ID',NULL,'$Size')";
$result = mysqli_query($db, $sql);

if($result) {
    echo json_encode(array('message' => 'Land registered!'));
} else {
    echo json_encode(array('message' => 'Error registering land: ' . mysqli_error($db)));
}
