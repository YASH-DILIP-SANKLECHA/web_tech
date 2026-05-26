<?php
// Starts the session before removing it
session_start();

// Clears all session data
session_destroy();

// Sends user back to login page
header("Location: login.php");
exit();
?>
