<?php
// Include config file
include ('config.php');
// Include functions file
include ('functions.php');
$errormsg = NULL;
if (isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['purchase_code']) && isset($_POST['URL'])){
$first_name = $_POST['first_name'];
$last_name = $_POST['last_name'];
$purchase_code = $_POST['purchase_code'];
$URL = $_POST['URL'];
$sql = "INSERT INTO `license_data` (`ID`, `first_name`, `last_name`, `purchase_code`, `URL`) VALUES (NULL, '$first_name', '$last_name', '$purchase_code', '$URL');";
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
?>
<!DOCTYPE html>
<html>
<?php pagetitle("Delete - LicAPI"); ?>
<body>
<center>
<h1>Add a license</h1>
<h3><?php echo $errormsg; ?></h3>
<form id="add" action="" method="post">
<input type="text" value="" placeholder="First Name" name="first_name" enabled="false">
<input type="text" value="" placeholder="Last Name" name="last_name" enabled="false">
<input type="text" value="" placeholder="License" name="purchase_code" enabled="false">
<input type="text" value="" placeholder="URL" name="URL" enabled="false">
<button type="submit" value="Submit" name="Submit" enabled="false">Submit</button>
<h3>License was added sucesfull!</h3>
</form>
</center>
</body>
</html>
<?php
} else {
?>
<!DOCTYPE html>
<html>
<?php pagetitle("Delete - LicAPI"); ?>
<body>
<center>
<h1>Add a license</h1>
<h3><?php echo $errormsg; ?></h3>
<form id="add" action="" method="post">
<input type="text" value="" placeholder="First Name" name="first_name" enabled="false">
<input type="text" value="" placeholder="Last Name" name="last_name" enabled="false">
<input type="text" value="" placeholder="License" name="purchase_code" enabled="false">
<input type="text" value="" placeholder="URL" name="URL" enabled="false">
<button type="submit" value="Submit" name="Submit">Submit</button>
</form>
</center>
</body>
</html>
<?
}