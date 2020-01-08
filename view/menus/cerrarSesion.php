<?php
	session_start();
	session_unset();
	/*unse($_SESSION['U_usuario']);*/
	session_destroy();
	header("Location:../../index.php");
?>
