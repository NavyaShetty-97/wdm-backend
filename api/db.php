<?php

// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039  

$conn = mysqli_connect("localhost","root","","wdm");
$database = mysqli_select_db($conn, 'signintrial');

$encodedData = file_get_contents('php://input');  // take data from react native fetch API
$decodedData = json_decode($encodedData, true);