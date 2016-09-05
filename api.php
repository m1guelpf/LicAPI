<?php
// Include config.php file
include ('config.php');
// Include functions.php file
include ('functions.php');
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
// Set $protocol to NONE
$protocol = "NONE";
// Set license to FREE
$license = "FREE";
}
// Print debug info if debug is enabled
if ($debug){
	echo "Loaded license " . $license . " by " . $protocol . ".<br>";
}
// SQL Query to check if license exists
$sql = sprintf("SELECT * FROM license_data WHERE purchase_code='%s'",
            mysql_real_escape_string($license));
// If query fails...
if (!$result = $mysqli->query($sql)) {
	// Print debug info if debug is enabled
	if ($debug){
	echo "Error: Query execution failed because: \n";
    echo "Query: " . $sql . "\n";
    echo "Errno: " . $mysqli->errno . "\n";
    echo "Error: " . $mysqli->error . "\n";
    exit();
    // If debug isn't enabled, show an error message
	} else {
    echo "Error while connecting to database.";
    exit();
	}
}
// If license doesn't exist in the database
if ($result->num_rows === 0) {
	// Print an error message
    echo "Your license code isn't valid. Please check again or <a href=\"" . $supporturl . "\">contact support</a>.";
    exit();
}
// Print debug info if debug is enabled
if ($debug){
	echo "License " . $license . " exists in server.<br>"
}
// Make an array with all user data
$userdata = $result->fetch_assoc();
// Print obtained data if debug is enabled
if ($debug) {
	echo $userdata;
}
// Return the array
return $userdata;