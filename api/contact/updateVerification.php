<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
    include_once '../../conn/db.php';
    include_once '../../util/cors.php';

    $_DATA = json_decode(file_get_contents('php://input'), true);
    
    if($_DATA) {
        $id = $_DATA['ID'];
        $sql = "UPDATE Users SET IsVerified = 1 WHERE ID = '$id'";
        $result = mysqli_query($db, $sql);

        if($result) {
            echo json_encode(array('message' => 'Record updated successfully'));
        } else {
            echo json_encode(array('message' => 'Error updating record: ' . mysqli_error($db)));
        }
    } else {
        echo json_encode(array('message' => 'User input missing'));
    }
?>