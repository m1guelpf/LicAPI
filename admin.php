<?php
// Include config file
include 'config.php';
// Include functions file
include 'functions.php';
if (isset($_COOKIE['licapi'])){
$licapi = $_COOKIE['licapi'];
} else {
$licapi = NULL;
}
if (!isset($licapi['username']) || $licapi['useragent'] != $licapi['useragent']){
logout();
}
$msg = NULL;
head("Licenses - LicAPI");

if (isset($_GET['license'])){
$license = $mysqli->real_escape_string($_GET['license']);
$check = "SELECT purchase_code FROM license_data WHERE purchase_code = '$license'";
if (!$result = $mysqli->query($check)) {
    // Print debug info if debug is enabled
    if ($debug){
        echo "Error: Query execution failed because: \n";
        echo "Query: " . $check . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        $activityType = '1';
        $activityTitle = 'Query execution error (logs.php)';
        updateActivity($activityType,$activityTitle);
        exit();
    // If debug isn't enabled, show an error message
    } else {
        echo "Error while connecting to database.";
        $activityType = '1';
        $activityTitle = 'Query execution error (logs.php)';
        updateActivity($activityType,$activityTitle);
        exit();
    }
}
if ($result->num_rows === 0) {

    $activityType = '4';
    $activityTitle = 'Tried to delete license \'' . $license . '\' but it didn\'t exist';
    updateActivity($activityType,$activityTitle);
} else {
$delete = "DELETE FROM `license_data` WHERE purchase_code = '$license'";
// If query fails...
if (!$result = $mysqli->query($delete)) {
    // Print debug info if debug is enabled
    if ($debug){
        echo "Error: Query execution failed because: \n";
        echo "Query: " . $delete . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        $activityType = '1';
        $activityTitle = 'Query execution error (logs.php)';
        updateActivity($activityType,$activityTitle);
        exit();
    // If debug isn't enabled, show an error message
    } else {
        echo "Error while connecting to database.";
        $activityType = '1';
        $activityTitle = 'Query execution error (logs.php)';
        updateActivity($activityType,$activityTitle);
        exit();
    }
}
$msg =  "Deleted";
$activityType = '5';
$activityTitle = 'Deleted license \'' . $license . '\'.';
updateActivity($activityType,$activityTitle);
}
}
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['purchase_code']) && isset($_POST['URL'])){
$first_name = $mysqli->real_escape_string($_POST['first_name']);
$last_name = $mysqli->real_escape_string($_POST['last_name']);
$license = $mysqli->real_escape_string($_POST['purchase_code']);
$URL = $mysqli->real_escape_string($_POST['URL']);
$check = "SELECT purchase_code FROM license_data WHERE purchase_code = '$license'";
if (!$result = $mysqli->query($check)) {
    // Print debug info if debug is enabled
    if ($debug){
        echo "Error: Query execution failed because: \n";
        echo "Query: " . $check . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        $activityType = '1';
        $activityTitle = 'Query execution error (logs.php)';
        updateActivity($activityType,$activityTitle);
        exit();
    // If debug isn't enabled, show an error message
    } else {
        echo "Error while connecting to database.";
        $activityType = '1';
        $activityTitle = 'Query execution error (logs.php)';
        updateActivity($activityType,$activityTitle);
        exit();
    }
}
if ($result->num_rows === 0) {
$sql = "INSERT INTO `license_data` (`ID`, `first_name`, `last_name`, `purchase_code`, `URL`) VALUES (NULL, '$first_name', '$last_name', '$license', '$URL');";
// If query fails...
if (!$result = $mysqli->query($sql)) {
    // Print debug info if debug is enabled
    if ($debug){
        echo "Error: Query execution failed because: \n";
        echo "Query: " . $sql . "\n";
        echo "Errno: " . $mysqli->errno . "\n";
        echo "Error: " . $mysqli->error . "\n";
        $activityType = '1';
        $activityTitle = 'Query execution error (logs.php)';
        updateActivity($activityType,$activityTitle);
        exit();
    // If debug isn't enabled, show an error message
    } else {
        echo "Error while connecting to database.";
        $activityType = '1';
        $activityTitle = 'Query execution error (logs.php)';
        updateActivity($activityType,$activityTitle);
        exit();
    }
}
$activityType = '6';
$activityTitle = 'Created license \'' . $license . '\'.';
updateActivity($activityType,$activityTitle);
    } else {
        $msg = "License '" . $license . "' already exists.";
        $activityType = '7';
        $activityTitle = 'Tried to create license \'' . $license . '\' but already existed.';
        updateActivity($activityType,$activityTitle);
    }

}
// SQL Query to get all license data
$list = "SELECT * FROM license_data ORDER BY id";
// If query fails...
if (!$result = $mysqli->query($list)) {
	// Print debug info if debug is enabled
	if ($debug){
		echo "Error: Query execution failed because: \n";
    	echo "Query: " . $list . "\n";
    	echo "Errno: " . $mysqli->errno . "\n";
    	echo "Error: " . $mysqli->error . "\n";
    	exit();
    // If debug isn't enabled, show an error message
	} else {
    	echo "Error while connecting to database.";
    	exit();
	}
}
// Show a header
echo "<center><h1>License Data</h1></center>\n";
// Start an HTML list
echo "<table><tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>License</th>
    <th>URL</th>
    <th>Action</th>
  </tr>\n";
// For every license data, show all info with a link to license
while ($userdata = $result->fetch_assoc()) {
    echo "<tr>\n";
    echo "<td>" . $userdata['first_name'] . "</td><td>" . $userdata['last_name'] . "</td><td>" . "<a href='api.php?license=" . $userdata['purchase_code'] . "'>" . $userdata['purchase_code'] . "</a>" . "</td><td>" . "<a href='" . $userdata['URL'] . "'>" . $userdata['URL'] . "</a>" . "</td><td><a href='logs.php?license=" . $userdata['purchase_code'] . "'>Delete</button></form></td>";
    echo "</tr>\n";
}
echo "<tr><form id='add' action='' method='post'>\n";
    echo "<td>" . "<input type='text' value='' placeholder='First Name' name='first_name'>" . "</td><td>" . "<input type='text' value='' placeholder='Last Name' name='last_name'>" . "</td><td>" . "<input type='text' value='' placeholder='License' name='purchase_code'>" . "</td><td>" . "<input type='text' value='' placeholder='URL' name='URL'>" . "</td><td><button type='submit' value='Submit' name='Submit'>Add</button></td>";
    echo "</form></tr>\n";
// Close the HTML List
echo "</table>\n";
if ($msg != NULL){
echo "<br><br><center><h3>" . $msg . "</h3></center>";
}
echo "<br><br><center><form id='logout' action='login.php' method='post'><button type='submit' name='logout' value='logout'>Log Out</center>";
