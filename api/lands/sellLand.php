
<?php

// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039
    include_once '../../conn/db.php';
    include_once '../../util/cors.php';

    $_DATA = json_decode(file_get_contents('php://input'), true);

    if($_DATA) {    
        $land_id = $_DATA['landId'];
        $ancestor = $_DATA['selectedAncestor'];
        $land_desc = $_DATA['landdesc'];
        $land_size = $_DATA['landsize'];
        $land_cost = $_DATA['landcost'];
        $owner_id = $_DATA['user'];
        $query = "INSERT INTO sellland(land_id, sellto, sales_desc, land_size, price) VALUES('$land_id', '$ancestor', '$land_desc', '$land_size', '$land_cost')";
        $result = $db->query($query);
        
        if($result) {
            $query = "UPDATE Lands SET Size = Size - '$land_size' WHERE ID = '$land_id'";
            $result = $db->query($query);
            // $query = "SELECT OwnerID FROM Lands WHERE ID = '$land_id'";
            // $result = $db->query($query);
            // $row = $result->fetch_assoc();
            // echo json_encode($row);
            // $owner_id = $row['OwnerID'];
            if($result) {
                $query = "INSERT INTO Lands (OwnerID, LandDesc, Size) VALUES ('$ancestor', '$land_desc', '$land_size')";
                $result = $db->query($query);
                if($result) {
                    $query = "INSERT INTO expenses (expense_title, expense_desc, land_id, owner_id, expense_cost) VALUES ('Sell Land', '$land_desc', '$land_id', '$owner_id', '$land_cost')";
                    $result = $db->query($query);
                    if($result) {
                        echo json_encode(array('status' => 'success'));
                    } else {
                        echo json_encode(array('status' => 'fail insert into expenses'));
                    }
                } else {
                    echo json_encode(array('status' => 'fail insert into lands'));
                }
            } else {
                echo json_encode(array('status' => 'fail update lands'));
            }
        } else {
            echo json_encode(array('status' => 'fail insert into sellland'));
        }
    }
?>