<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
    include_once '../../conn/db.php';
    include_once '../../util/cors.php';
    
    $sql = "SELECT * FROM Users";
    $result = mysqli_query($db, $sql);

    while($row = mysqli_fetch_assoc($result)) {
        $parentId = $row['ParentID'];
        if($parentId != null) {
            $sql = "SELECT UserName FROM Users WHERE ID = '$parentId'";
            $result2 = mysqli_query($db, $sql);
            $row2 = mysqli_fetch_assoc($result2);
            $row['ParentName'] = $row2['UserName'];
        }
        else {
            $row['ParentName'] = 'No Parent';
        }
        $data[] = $row;
    }
    echo json_encode($data);
    
    // echo json_encode(mysqli_fetch_all($result, MYSQLI_ASSOC));

?>