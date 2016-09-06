<?php
// Include config file
include ('config.php');
// Include functions file
include ('functions.php');
$msg = NULL;
if (isset($_GET['license']) && isset($_POST['delete']) && $_POST['submit'] == "Yes") {
$license = $_GET['license'];
$sql = "DELETE FROM `license_data` WHERE purchase_code = '$license'";
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
$msg =  "Deleted";
} else if (isset($_GET['license']) && isset($_POST['delete']) && $_POST['submit'] == "No") {
header("Location: delete.php");
} else if (isset($_GET['license'])){
?>
<!DOCTYPE html>
<html>
<?php pagetitle("Delete - LicAPI"); ?>
<body>
<center>
<h2>Delete a license</h2>
<h3>Are you sure?</h3>
<form id="confirm_delete" action="" method="post">
<input type="hidden" value="yes" name="delete">
<button type="submit" value="Yes" name="submit">Yes</button>
<button type="submit" value="No" name="submit">No</button>
</form>
</center>
</body>
</html>
<?
exit();
}
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
echo "<center>\n<h1>Delete a license</h1>\n</center>\n";
// Start an HTML list
echo "<tr>\n";
// For every license data, show all info with a link to delete it
while ($userdata = $result->fetch_assoc()) {
    echo "<table><tr>
    <th>First Name</th>
    <th>Last Name</th>
    <th>License</th>
    <th>URL</th>
  </tr><a href='delete.php?license=" . $userdata['purchase_code'] . "'>\n";
    echo "<tr><td>" . $userdata['first_name'] . "</td><td>" . $userdata['last_name'] . "</td><td>" . $userdata['purchase_code'] . "</td><td>" . $userdata['URL'] . "</td>";
    echo "</a></tr>\n";
}
// Close the HTML List
echo "</table>\n";
echo "<br>\n";
echo "<center><h3>" . $msg . "</h3></center>\n";
echo "<br><br>\n";
echo "<center><h3><a href='logs.php'><- Return</a>";
