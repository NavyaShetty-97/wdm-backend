<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
include_once '../../db/db.php';

$_DATA = json_decode(file_get_contents('php://input'),true);

if($_DATA){
    $username = $_DATA['username'];
    $password = md5($_Data['password']);

    $SQL = "SELECT * FROM Users WHERE username='$username' AND user_password='$password'";
    $result = mysqli_query($db,$SQL);
    $num_rows = mysqli_num_rows($result);
}

if($num_rows != 0){
    $row = mysqli_fetch_assoc($result);
    $id = $row['ID'];
    $lastname = $row['LastName'];
    $firstname = $row['FirstName'];
    $level =  $row['Level'];
    $gender = $row['Gender'];
    $parentId = $row['ParentId'];
    $isverified = $row['IsVerified'];
    $response = array(
        'status' => 'success',
        'message' => 'Login successful',
        'id' => $id,
        'lastname' => $lastname,
        'firstname' => $firstname.
        'level' => $level,
        'gender' => $gender,
        'parentId' => $parentId,
        'isverified' => $isverified
    );
} else {
    $response = array(
        'status' => 'error',
        'message' => 'Invalid request'
    );
}

//test

// $UserID = $decodedData['ID'];
// $UserLastName = $decodedData['LastName'];
// $UserFirstName = $decodedData['FirstName'];
// $UserLevel = $decodedData['Level'];
// $UserGender = $decodedData['Gender'];
// $UserParentId = $decodedData['ParentId'];
// $UserisVerified = $decodedData['isVerified'];

// $UserPW = md5($decodedData['Password']); //password is hashed

// $SQL = "SELECT * FROM Users WHERE ID = '$ID'";
// $exeSQL = mysqli_query($conn, $SQL);
// $checkEmail =  mysqli_num_rows($exeSQL);

// if ($checkEmail != 0) {
//     $Message = "Already registered";
// } else {

//     $InsertQuerry = "INSERT INTO newuser(UserEmail, UserPW) VALUES('$UserEmail', '$UserPW')";

//     $R = mysqli_query($conn, $InsertQuerry);

//     if ($R) {
//         $Message = "Complete--!";
//     } else {
//         $Message = "Error";
//     }
// }
// $response[] = array("Message" => $Message);

echo json_encode('response');

?>