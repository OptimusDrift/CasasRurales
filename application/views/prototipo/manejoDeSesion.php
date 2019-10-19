<?php
session_start();
if ($_SESSION['correo'] == null) {
  redirect('Welcome');
}
if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
  session_unset();     // unset $_SESSION variable for the run-time 
  session_destroy();   // destroy session data in storage
  redirect('Welcome');
}
$_SESSION['LAST_ACTIVITY'] = time();
