<?php
// Include config.php file
include 'config.php';
// Include functions.php file
include 'functions.php';
// Start a session if there isn't any
if(!isset($_SESSION)) session_start();
// Get User's IP address
$actIp = $_SERVER['REMOTE_ADDR'];
// Set a page title
head("Check - LicAPI");
// If license is posted by GET...
if (isset($_GET['license'])){
// Set $protocol to GET
$protocol = "GET";
// Set $license to the license
$license = $_GET['license'];
// If license is posted by POST...
} else if (isset($_POST['license'])) {
// Set $protocol to GET
$protocol = "POST";
// Set $license to the license
$license = $_POST['license'];
// If license isn't posted
} else {
// If debug is enabled...
if ($debug){
// Print a help message and exit
echo "A license wasn't entered. If you need support, visit <a href='https://licapi.projects.miguelpiedrafita.com'>the script help page</a>";
exit();
// If debug isn't enabled
} else {
// Show an error message and a link to support and exit
echo "You did not enter a license. If you entered a license, please try again. If the error persists, <a href='" . $supporturl . "'>contact support</a>.";
exit();
}
}
// Clean $license
$license = $mysqli->real_escape_string($license);
// Print debug info if debug is enabled
if ($debug){
	echo "Loaded license " . $license . " by " . $protocol . ".<br>";
}
// SQL Query to check if license exists
$sql = "SELECT * FROM license_data WHERE purchase_code='$license'";
// If query fails...
if (!$result = $mysqli->query($sql)) {
	// Print debug info if debug is enabled
	if ($debug){
	echo "Error: Query execution failed because: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    // Log info to database
    $activityType = '1';
    $activityTitle = 'Query execution error (api.php)';
    updateActivity($activityType,$activityTitle);
    exit();
    // If debug isn't enabled, show an error message
	} else {
    echo "Error while connecting to database.";
    // Log info to database
    $activityType = '1';
    $activityTitle = 'Query execution error (api.php)';
    updateActivity($activityType,$activityTitle);
    exit();
	}
}
// If license doesn't exist in the database
if ($result->num_rows === 0) {
	// Print an error message
    echo "Your license code isn't valid. Please check again or <a href=\"" . $supporturl . "\">contact support</a>.";
    // Log info to database
    $activityType = '2';
    $activityTitle = 'Invalid license: ' . $license;
    updateActivity($activityType,$activityTitle);
    exit();
}
// Print debug info if debug is enabled
if ($debug){
	echo "License " . $license . " exists in server.<br>";
}
// Make an array with all user data
$userdata = $result->fetch_assoc();
// Print obtained data if debug is enabled
if ($debug) {
	echo '<pre>'; print_r($userdata); echo '</pre>';
}
// Log info to database
$activityType = '3';
$activityTitle = 'Valid license: ' . $license;
updateActivity($activityType,$activityTitle);
// Return the array
echo json_encode($userdata);
