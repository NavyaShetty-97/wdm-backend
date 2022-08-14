<?php
header("Access-Control-Allow-Origin:http://localhost:3000/");
if (isset($_SERVER['HTTP_ORIGIN'])) {
    
    header("Access-Control-Allow-Origin: *");
    header('Access-Control-Allow-Credentials: true');    
    header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
}   
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_METHOD']))
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");         
    if (isset($_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']))
        header("Access-Control-Allow-Headers:{$_SERVER['HTTP_ACCESS_CONTROL_REQUEST_HEADERS']}");
    exit(0);
}

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// import from PHPmailer-master the file name Exception.php
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';




function mailTo($destinationEmail, $userName, $subject, $message) {
    $mail = new PHPMailer();
    $mail->IsSMTP();
    $mail->Mailer = "smtp";

    $mail->SMTPDebug  = 3;  
    $mail->SMTPAuth   = TRUE;
    $mail->SMTPSecure = "tls";
    $mail->Port       = 587;
    $mail->Host       = "smtp.gmail.com";
    $mail->Username   = "wdmshetty8039@gmail.com";
    $mail->Password   = "smqdiyvevggbaxeg";

    // set response code - 200 OK
    http_response_code(200);
    $subject = $subject;
    $to = $destinationEmail;
    $from = "wdmshetty8039@gmail.com";

    // data
    $mail->IsHTML(true);
    $mail->AddAddress($to, "CUSTOMER");
    $mail->SetFrom($from, "DIAZ SIFONTES");
    $mail->Subject = $subject;

    $content =$message ;

    // Headers
    $headers = "MIME-Version: 1.0\r\n";
    $headers.= "Content-type: text/html; charset=UTF-8\r\n";
    $headers.= "From: <" . $from . ">";
        
    $mail->MsgHTML($content); 
    $mail->SMTPSecure = 'tls';
    $mail->Host = 'smtp.gmail.com';
    if(!$mail->Send()) {
    echo "Error while sending Email.";
    echo json_encode(["sent" => false, "message" => "Something went wrong"]);
    } else {
    echo "Email sent successfully";
        echo json_encode(array(
            "sent" => true
        ));
    }
}
