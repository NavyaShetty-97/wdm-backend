<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
    include_once '../../conn/db.php';
    include_once '../../util/cors.php';
    
    $sql = "SELECT * FROM messages";
    $result = mysqli_query($db, $sql);
    
    $data = array();
    while($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);

?>