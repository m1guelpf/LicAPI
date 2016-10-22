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
head("Settings - LicAPI");
// Show a header
echo "<center><h1>Settings</h1></center>\n";
// Start columns
echo "<div class='clearfix'>";
// Column 1
echo "<section class='one'>";
echo "<h4>Change Password</h4>";
echo "</section>";
// Column 1
echo"<section class='two'>";
echo "<h4>API Token</h4>";
echo "</section>";
