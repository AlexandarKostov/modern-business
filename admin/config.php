<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);

	include_once('include/mysql.php');
	include_once('include/functions.php');

	if (isLogged())
    {
        $user = returnID();
        $userQuery = mysqli_query($SQL, "SELECT * FROM users WHERE ID = '$user'");
        $userData = mysqli_fetch_assoc($userQuery);
        $userAdmin = $userData["Admin"];
    }
    else if (!isLogged()) { redirect("../home"); }
    
    if (adminPerm($userAdmin) < 1)
    {
    	redirect("../home");
    }
?>