<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
include_once '../../conn/db.php';
include_once '../../util/cors.php';

$_DATA = json_decode(file_get_contents('php://input'), true);
$UserName = $_DATA['name'];
$UserPW = $_DATA['password'];
$IsAdmin = $_DATA['isAdmin'];
$FirstName = $_DATA['firstname'];
$LastName = $_DATA['lastname'];

$SQL = "SELECT * FROM Users WHERE UserName = '$UserName'";
$exeSQL = mysqli_query($db, $SQL);
$checkEmail =  mysqli_num_rows($exeSQL);

if ($checkEmail != 0) {
    $Message = "Already registered";
}
else {
    $Parent = $_DATA['parent'];
    $SQL = "SELECT * FROM Users WHERE UserName = '$Parent'";
    $result = $db->query($SQL);
    $row = $result->fetch_assoc();
    $Level = $row['Level'] + 1;
    $PID = $row['ID'];

    while ($row['ParentID']) {
        $Parent = $row['ParentID'];
        $SQL = "SELECT * FROM Users WHERE ID = '$Parent'";
        $result = $db->query($SQL);
        $row = $result->fetch_assoc();
    }

    if($row['ID'] == $_DATA['ancestorId']) {
        $InsertQuery = "INSERT INTO Users (UserName, UserPW, FirstName, LastName, Level, ParentID, IsVerified) VALUES('$UserName', '$UserPW', '$FirstName', '$LastName', '$Level', $PID, $IsAdmin)";
        $R = mysqli_query($db, $InsertQuery);

        $SQL = "SELECT * FROM Users WHERE UserName = '$UserName'";
        $result = $db->query($SQL);
        $row = $result->fetch_assoc();

        if ($row) {
            $Message = array(
                "user_name" => $UserName,
                "user_id" => $row['ID']
            );
        } else {
            $Message = "Error";
        }
    } else {
        $Message = "Parent does not belong to the selected Ancestor's branch";
    }
}

echo json_encode($Message);
