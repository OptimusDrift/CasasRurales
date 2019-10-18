<?php 
session_start();
if ($_SESSION['correo'] == null) {
  redirect('Welcome');
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 10)) {
  session_unset();     // unset $_SESSION variable for the run-time 
  session_destroy();   // destroy session data in storage
}
$_SESSION['LAST_ACTIVITY'] = time();
?>