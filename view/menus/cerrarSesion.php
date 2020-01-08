<?php
	session_start();
	session_unset();
	/*unset($_SESSION['U_usuario']);*/
	session_destroy();
	header("Location:../login.php");
?>