<?php
include ('config.php');
include ('functions.php');
$errormsg = NULL;
if (isset($_COOKIE['licapi'])){
$licapi = $_COOKIE['licapi'];
if (!isset($licapi['username']) OR $licapi['useragent'] != $_SERVER['HTTP_USER_AGENT']){
logout();
} else {
header("Location: admin.php"); 
}
if (isset($_POST['logout'])){
logout();
}
} else {
if (isset($_POST['user']) && isset($_POST['password'])) {
$user = $_POST['user'];
$password = $_POST['password'];
$sql = "SELECT username FROM users WHERE username = '$user'";
if (!$result = $mysqli->query($sql)) {
	// Print debug info if debug is enabled
	if ($config['DEBUG']){
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
if ($result->num_rows === 0) {
	$errormsg = "User doesn't exist";
} else {
$sql = "SELECT password FROM users WHERE username = '$user'";
if (!$result = $mysqli->query($sql)) {
	// Print debug info if debug is enabled
	if ($config['DEBUG']){
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
$userdata = $result->fetch_assoc();
if (password_verify($_POST['password'], $userdata['password'])) {
    setcookie("licapi[username]", $user);
    setcookie("licapi[useragent]", $_SERVER['HTTP_USER_AGENT']);
    header("Location: admin.php");
    exit();
} else {
    $errormsg = "Wrong password";
}
}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>
<body>
<center>
<h1>Login</h1>
<h3><?php echo $errormsg; ?></h3>
<form id="login" action="" method="post">
<input type="text" value="" placeholder="Username" name="user">
<input type="password" value="" placeholder="Password" name="password">
<button type="submit" value="Enviar" name="Enviar">Enviar</button>
</form>
</center>
</body>
</html>
<?
}
exit();
