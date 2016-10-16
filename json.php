<?php
// Include config.php file
include 'config.php';
// Include functions.php file
include 'functions.php';
// Start a session if there isn't any
if(!isset($_SESSION)) session_start();
// Get User's IP address
$actIp = $_SERVER['REMOTE_ADDR'];
// This is a JSON file
header('Content-Type: application/json');
// If license is posted by GET...
if (isset($_GET['license'])){
// Set $protocol to GET
$protocol = "GET";
// Set $license to the license
$license = $_GET['license'];
// If license is posted by POST...
} else if (isset($_POST['license'])) {
// Set $protocol to POST
$protocol = "POST";
// Set $license to the license
$license = $_POST['license'];
// If license isn't posted
} else {
$license = "NONE";
}
// Clean $license
$license = $mysqli->real_escape_string($license);
// SQL Query to check if license exists
$sql = "SELECT * FROM license_data WHERE purchase_code='$license'";
if (!$result = $mysqli->query($sql)) {
 // Log info to database
    $activityType = '1';
    $activityTitle = 'Query execution error (json.php)';
    updateActivity($activityType,$activityTitle);
exit();
}
if ($result->num_rows === 0) {
// Log info to database
    $activityType = '2';
    $activityTitle = 'Invalid license: ' . $license;
    updateActivity($activityType,$activityTitle);
    exit();
}
// Make an array with all user data
$userdata = $result->fetch_assoc();
// Log info to database
$activityType = '3';
$activityTitle = 'Valid license: ' . $license;
updateActivity($activityType,$activityTitle);
// Return the array
echo json_encode($userdata);
?>
