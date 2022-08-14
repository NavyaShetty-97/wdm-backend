<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
    include_once '../../conn/db.php';
    include_once '../../util/cors.php';

    $_DATA = json_decode(file_get_contents('php://input'), true);

    if($_DATA) {
        $ID = $_DATA['project_id'];
        $project_title = $_DATA['projectname'];
        $project_desc = $_DATA['projectdesc'];
        $land_id = $_DATA['land'];
        $user = $_DATA['user'];

        if($land_id == -1) {
            $land_id = 'NULL';
        }

        $project_cost = $_DATA['cost'];

        //Write insert query to add new row data to order table
        if($ID) {
            $query = "UPDATE projects SET project_title = '$project_title', project_desc = '$project_desc', land_id = ".$land_id.", project_cost = '$project_cost' WHERE project_id = '$ID'";
        }
        else {
            $query = "INSERT INTO projects (project_title, project_desc, land_id, owner_id, project_cost) VALUES ('$project_title', '$project_desc', ".$land_id.", '$user', '$project_cost')";
        }
        
        //Execute the query
        $result = $db->query($query);

        if($result) {
            $response = array(
                'status' => 1,
                'status_message' => 'Project added successfully.',
            );
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Project could not be added.',
            );
        }
    }
    echo json_encode($response);
?>