<?php
// Rajeev Kulkarni, Madhur  - 1001857050
// Shetty,Rohan Prakash - 1001969248
// Vishwanath Shetty, Navyashree - 1001968039 
include_once '../../conn/db.php';
include_once '../../util/cors.php';

$_DATA = json_decode(file_get_contents('php://input'), true);
$ID = $_DATA['land'];
$user = $_DATA['user'];

$SQL = "SELECT * FROM projects where land_id = '$ID'";
$result = $db->query($SQL);

$projects_cost = 0;
$projects = 0;
while ($row = $result->fetch_assoc()) {
    if ($row['project_cost']) {
        $projects_cost = $projects_cost + $row['project_cost'];
    }
    $projects = $projects + 1;
}

$SQL = "SELECT * FROM trials where land_id = '$ID'";
$result = $db->query($SQL);

$trials_cost = 0;
$trials = 0;
while ($row = $result->fetch_assoc()) {
    if ($row['trial_cost']) {
        $trials_cost = $trials_cost + $row['trial_cost'];
    }
    $trials = $trials + 1;
}

$SQL = "SELECT * FROM expenses where land_id = '$ID' and expense_title != 'Sell Land'";
$result = $db->query($SQL);

$expenses_cost = 0;
$expenses = 0;
while ($row = $result->fetch_assoc()) {
    if ($row['expense_cost']) {
        $expenses_cost = $expenses_cost + $row['expense_cost'];
    }
    $expenses = $expenses + 1;
}

$SQL = "SELECT Users.ID, Users.FirstName, Users.LastName, Lands.Size FROM `Lands` LEFT JOIN Users on Lands.OwnerID = Users.ID where Lands.OwnerID > 0;";
$result = mysqli_query($db, $SQL);
$town = array();

while ($row = $result->fetch_assoc()) {
    array_push($town, $row);
}

$response = array(
    "chart1" => array(
        "projects_cost" => $projects_cost,
        "trials_cost" => $trials_cost,
        "expenses_cost" => $expenses_cost
    ),
    "chart2" => array(
        "projects" => $projects,
        "trials" => $trials,
        "expenses" => $expenses
    ),
    "chart3" => $town
);

echo json_encode($response);