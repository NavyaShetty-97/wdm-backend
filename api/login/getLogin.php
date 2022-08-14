<?php 
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
    include_once '../../conn/db.php';
    include_once '../../util/cors.php';

    $_DATA = json_decode(file_get_contents('php://input'), true);

    if($_DATA)  {
        $user_name = $_DATA['user_name'];
        // $password = md5($_DATA['password']);
        $password = $_DATA['password'];

        $sql = "SELECT * FROM Users WHERE UserName = '$user_name' AND UserPw = '$password' and isVerified = 1";
        
        $result = mysqli_query($db, $sql);       
        $num_rows = mysqli_num_rows($result);

        if($num_rows > 0) {

            $response = array(
                'status' => 'success',
                'message' => 'Login successful',
            );

            echo json_encode($response);
        } else {
            $response = array(
                'status' => 'fail',
                'message' => 'Login unsuccessful',
            );

            echo json_encode($response);
        }
    }
            

?>