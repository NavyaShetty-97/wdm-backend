<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
    include_once '../../conn/db.php';
    include_once '../../util/cors.php';

    $_DATA = json_decode(file_get_contents('php://input'), true);

    if($_DATA) {
        $IDs = "(";
        $itemType = $_DATA['itemType'];

        foreach ($_DATA['IDs'] as $ID) {
            if ($IDs == '(') {
                $IDs .= $ID;
            }
            else {
                $IDs .= ', ' . $ID;
            }
        }
        $IDs .= ")";

        if ($itemType == 'Project') {
            $query = "DELETE FROM projects WHERE project_id IN $IDs";
        }
        else if ($itemType == 'Trial') {
            $query = "DELETE FROM trials WHERE trial_id IN $IDs";
        }
        else {
            $query = "DELETE FROM expenses WHERE expense_id IN $IDs";
        }

        $result = mysqli_query($db, $query);
        
        if($result) {
            echo json_encode(array(
                'success' => true,
                'message' => 'Item deleted successfully'
            ));
        } else {
            echo json_encode(array(
                'success' => false,
                'message' => 'Could not delete item'
            ));
        }
    }
?>