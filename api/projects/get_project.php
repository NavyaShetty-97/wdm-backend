<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
    include_once '../../conn/db.php';
    include_once '../../util/cors.php';

    $_DATA = json_decode(file_get_contents('php://input'), true);

    if($_DATA) {
        $ID = $_DATA['ID'];
        $type = $_DATA['type'];

        if($type == 'Project') {
            $query = "SELECT * FROM projects WHERE project_id = '$ID'";
        }
        else if($type == 'Trial') {
            $query = "SELECT * FROM trials WHERE trial_id = '$ID'";
        }
        else {
            $query = "SELECT * FROM expenses WHERE expense_id = '$ID'";
        }
        
        //Execute the query
        $result = $db->query($query);
        $row = $result->fetch_assoc();

        if($result) {
            $response = $row;
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Failed to load the project.',
            );
        }
    }
    echo json_encode($response);
?>