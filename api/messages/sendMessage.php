<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
    include_once '../../conn/db.php';
    include_once '../../util/cors.php';
    include_once '../../util/send_email.php';
    
    
    $_DATA = json_decode(file_get_contents('php://input'), true);
    if($_DATA) {
        $email = $_DATA['email'];
        $message = $_DATA['message'];
        $name = $_DATA['name'];
        $reply = $_DATA['reply'];
        $subject = $_DATA['subject'];
        $from = 'admin@mail.com';

        $response = mailTo($email, $name, $subject, $reply,);


        return json_encode(array('message' => $response));
    }

?>