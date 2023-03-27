<?php
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Regenerate session id
session_regenerate_id();

// Redirect to the index.php page
header("Location: index.php");
exit;
?>
