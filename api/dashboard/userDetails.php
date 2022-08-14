<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
include_once '../../conn/db.php';
include_once '../../util/cors.php';

$_DATA = json_decode(file_get_contents('php://input'), true);
$ID = $_DATA['ID'];

$SQL = "SELECT * FROM Users where ID = '$ID'";
$result = $db->query($SQL);
$row = $result->fetch_assoc();
$Name = $row['FirstName'] . ' ' . $row['LastName'];
$Relation = 'Self';
$FR = 'Grand ';
$LR = 'Great ';

if($row['ParentID'] != NULL) {
    $Relation = 'Child';
    $Parent = $row['ParentID'];
    $SQL = "SELECT * FROM Users WHERE ID = '$Parent'";
    $result = $db->query($SQL);
    $row = $result->fetch_assoc();

    while ($row['ParentID'] != NULL) {
        if($FR != '') {
            $Relation = $FR . $Relation;
            $FR = '';
        }

        $Parent = $row['ParentID'];
        $SQL = "SELECT * FROM Users WHERE ID = '$Parent'";
        $result = $db->query($SQL);
        $row = $result->fetch_assoc();

        if($row['ParentID'] != NULL) {
            $Relation = $LR . $Relation;
        }
    }
}

$Ancestor = $row['FirstName'] . ' ' . $row['LastName'];

$SQL = "SELECT * FROM Lands where OwnerID = '$ID'";
$result = $db->query($SQL);
$LandOwned = 0;

while ($row = $result->fetch_assoc()) {
    $LandOwned = $LandOwned + $row['Size'];
}

$Expenses = 0;
$SQL = "SELECT * FROM projects where owner_id = '$ID'";
$result = $db->query($SQL);

while ($row = $result->fetch_assoc()) {
    $Expenses = $Expenses - $row['project_cost'];
}

$SQL = "SELECT * FROM trials where owner_id = '$ID'";
$result = $db->query($SQL);

while ($row = $result->fetch_assoc()) {
    $Expenses = $Expenses - $row['trial_cost'];
}

$SQL = "SELECT * FROM expenses where owner_id = '$ID'";
$result = $db->query($SQL);

while ($row = $result->fetch_assoc()) {
    $Expenses = $Expenses - $row['expense_cost'];
}

$response = array(
    "Name" => $Name,
    "Ancestor" => $Ancestor,
    "Relation" => $Relation,
    "LandOwned" => $LandOwned,
    "Expenses" => $Expenses
);

echo json_encode($response);