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

	$sQuery = mysqli_query($SQL, "SELECT * FROM server");
	$serverInfo = mysqli_fetch_assoc($sQuery);

	if ($serverInfo["Mode"] == 1)
	{
		$_SESSION['serverMode'] = serverMode($serverInfo["Mode"]);
		$_SESSION['serverMsg'] = $serverInfo["Information"];
		redirect("server");
	}

	if (isset($pageName) == "Home")
	{
		$home = mysqli_query($SQL, "SELECT * FROM home");
		$homeSetting = mysqli_fetch_assoc($home);
	}
	if (isset($pageName) == "About")
	{
		$about = mysqli_query($SQL, "SELECT * FROM about");
		$aboutSetting = mysqli_fetch_assoc($about);
	}
	if (isset($pageName) == "Pricing")
	{
		$pricing = mysqli_query($SQL, "SELECT * FROM pricing");
		$pricingSetting = mysqli_fetch_assoc($pricing);
	}
	if (isset($pageName) == "Blog")
	{
		$blog = mysqli_query($SQL, "SELECT * FROM blog");
		$blogSetting = mysqli_fetch_assoc($blog);
	}
	if (isset($pageName) == "Portfolio")
	{
		$portfolio = mysqli_query($SQL, "SELECT * FROM portfolio");
		$portfolioSetting = mysqli_fetch_assoc($portfolio);
	}
	if (isset($pageName) == "FAQ")
	{
		$faq = mysqli_query($SQL, "SELECT * FROM faq");
		$faqSetting = mysqli_fetch_assoc($faq);
	}

?>