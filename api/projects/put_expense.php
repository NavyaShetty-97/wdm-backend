<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
    include_once '../../conn/db.php';
    include_once '../../util/cors.php';

    $_DATA = json_decode(file_get_contents('php://input'), true);

    if($_DATA) {
        $ID = $_DATA['project_id'];
        $expense_title = $_DATA['projectname'];
        $expense_desc = $_DATA['projectdesc'];
        $land_id = $_DATA['land'];
        $user = $_DATA['user'];

        if($land_id == -1) {
            $land_id = 'NULL';
        }

        $expense_cost = $_DATA['cost'];

        //Write insert query to add new row data to expense table
        if($ID) {
            $query = "UPDATE expenses SET expense_title = '$expense_title', expense_desc = '$expense_desc', land_id = ".$land_id.", expense_cost = '$expense_cost' WHERE expense_id = '$ID'";
        }
        else {
            $query = "INSERT INTO expenses (expense_title, expense_desc, land_id, owner_id, expense_cost) VALUES ('$expense_title', '$expense_desc', ".$land_id.", '$user',  '$expense_cost')";
        }
        
        // Execute the query
        $result = $db->query($query);

        if($result) {
            $response = array(
                'status' => 1,
                'status_message' => 'Expense added successfully.',
            );
        } else {
            $response = array(
                'status' => 0,
                'status_message' => 'Expense could not be added.',
            );
        }
    }
    echo json_encode($response);
?>