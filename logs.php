<?php
// Include config file
include ('config.php');
// Include functions file
include ('functions.php');
pagetitle("Licenses - LicAPI");
//echo "<head><title>Licenses - LicAPI</title></head>";
// SQL Query to get all license data
$sql = "SELECT * FROM license_data ORDER BY id";
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
// Show a header
echo "<center><h1>License Data</h1></center>\n";
// Start an HTML list
echo "<ul>\n";
// For every license data, show all info with a link to license
while ($userdata = $result->fetch_assoc()) {
    echo "<li>\n";
    echo $userdata['first_name'] . ' ' . $userdata['last_name'] . ' ' . "<a href='api.php?license=" . $userdata['purchase_code'] . "'>" . $userdata['purchase_code'] . "</a>" . ' ' . "<a href='" . $userdata['URL'] . "'>" . $userdata['URL'] . "</a>";
    echo "</li>\n";
}
// Close the HTML List
echo "</ul>\n";
echo "<br>\n";
echo "<center>";
echo "<h3><a href='add.php'>Add a license</a>";
echo "<h3><a href='delete.php'>Delete a license</a>";