<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
    include_once '../../conn/db.php';
    include_once '../../util/cors.php';

    $_DATA = json_decode(file_get_contents('php://input'), true);

    if($_DATA) {
        $ID = $_DATA['project_id'];
        $trial_title = $_DATA['projectname'];
        $trial_desc = $_DATA['projectdesc'];
        $land_id = $_DATA['land'];
        $user = $_DATA['user'];

        if($land_id == -1) {
            $land_id = 'NULL';
        }

        $trial_cost = $_DATA['cost'];

        //Write insert query to add new row data to trial table
        if($ID) {
            $query = "UPDATE trials SET trial_title = '$trial_title', trial_desc = '$trial_desc', land_id = ".$land_id.", trial_cost = '$trial_cost' WHERE trial_id = '$ID'";
        }
        else {
            $query = "INSERT INTO trials (trial_title, trial_desc, land_id, owner_id, trial_cost) VALUES ('$trial_title', '$trial_desc', ".$land_id.", '$user', '$trial_cost')";
        }

        //Execute the query
        $result = $db->query($query);

        if($result) {
            $response = array(
                'status' => 1,
                'status_message' => 'Trial added successfully.',
            );
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Trial could not be added.',
            );
        }
    }
    echo json_encode($response);
?>