<?php
	session_start();
	include "config.php";

	if (isLogged())
	{
		unset($_SESSION["Logged"]);
		setcookie("email", "", time() - 3600 , "/");
		setcookie("password", "", time() - 3600 , "/");
		redirect("../home");
	}
	else { redirect("../home"); }
?>