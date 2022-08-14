<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
    include_once '../../conn/db.php';
    include_once '../../util/cors.php';
    $_DATA = json_decode(file_get_contents('php://input'), true);

    if($_DATA) {
        $id = $_DATA['id'];
        $name = $_DATA['name'];
        $subject = $_DATA['subject'];
        $phone = $_DATA['phone'];
        $email = $_DATA['email'];
        $message = $_DATA['message'];

        $sql = "INSERT INTO messages (id, name, subject, phone, email, message) VALUES ('$id', '$name', '$subject', '$phone', '$email', '$message')";
        $result = mysqli_query($db, $sql);

        if($result) {
            echo json_encode(array('message' => 'Record updated successfully'));
        } else {
            echo json_encode(array('message' => 'Error updating record: ' . mysqli_error($db)));
        }
    } else {
        echo json_encode(array('message' => 'No data found'));
    }

?>