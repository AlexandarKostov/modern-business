<?php
session_start();

include "config.php";


if ($_POST["process"] == "login")
{
	$email = mysqli_real_escape_string($SQL, $_POST["email"]);
	$password = mysqli_real_escape_string($SQL, $_POST["password"]);

	$query = mysqli_query($SQL, "SELECT * FROM users WHERE EMail='$email' AND Password=sha1('$password')");

	if (mysqli_num_rows($query) != 0)
	{
		$data = mysqli_fetch_assoc($query);

		if ($data["Approved"] == 0)
		{
			echo "approved";
			return true;
		}
		else
		{
			$_SESSION['Logged'] = $data["ID"];

			if ($_POST["rememberMe"])
			{
				setcookie("email", $_POST["email"], strtotime( '+365 days' ), "/");
				setcookie("password", $_POST["password"], strtotime( '+365 days' ), "/");
			}
			else
			{
				setcookie("email", "", time() - 3600 , "/");
				setcookie("password", "", time() - 3600 , "/");
			}

			$ip_address = $_SERVER['REMOTE_ADDR'];
		    $geopluginURL = 'http://www.geoplugin.net/php.gp?ip='.$ip_address.'';
		    $addrDetailsArr = unserialize(file_get_contents($geopluginURL));
		    $city = $addrDetailsArr['geoplugin_city'];
		    $country = $addrDetailsArr['geoplugin_countryName'];

		    $city = ($city == "") ? 'Undefined' : $city;
		    $country = ($country == "") ? 'Undefined' : $country;
		    $location = $city.', '.$country;

		    $userid = $data["ID"];

		    $session = mysqli_query($SQL, "SELECT * FROM sessions WHERE User='$userid' AND IP='$ip_address'");

		    if (mysqli_num_rows($session) == 0)
		    {
		    	$sessions = mysqli_query($SQL, "INSERT INTO sessions (User, IP, Location) VALUES ('$userid', '$ip_address', '$location')");
		    }
			echo "true";
			return true;
		}
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "register")
{
	$user_name = mysqli_real_escape_string($SQL, $_POST["user_name"]);
	$user_email = mysqli_real_escape_string($SQL, $_POST["user_email"]);
	$user_pass = mysqli_real_escape_string($SQL, $_POST["user_pass"]);
	$user_gender = mysqli_real_escape_string($SQL, $_POST["gender"]);
	$user_phone = mysqli_real_escape_string($SQL, $_POST["user_phone"]);
	$user_bday = mysqli_real_escape_string($SQL, $_POST["user_bday"]);

	$query = mysqli_query($SQL, "SELECT EMail FROM users WHERE EMail='$user_email'");

	if (mysqli_num_rows($query) == 0)
	{
		if (filter_var($user_email, FILTER_VALIDATE_EMAIL))
		{
			$insert = mysqli_query($SQL, "INSERT INTO users (EMail, Password, Name, Phone, Gender, Birthday) VALUES ('$user_email', sha1('$user_pass'), '$user_name', '$user_phone', '$user_gender', '$user_bday')");

			if ($insert)
			{
				// loggin user IN
				// $userID = mysqli_insert_id($SQL);
				// $_SESSION['Logged'] = $userID;
				echo "true";
				return true;
			}
			else echo "false";
			return true;
		}
		else echo "valid-email";
		return true;		
	}
	else echo "exists";
	return true;	
}
if ($_POST["process"] == "newsletter")
{
	$email = mysqli_real_escape_string($SQL, $_POST["email_newsletter"]);

	if (filter_var($email, FILTER_VALIDATE_EMAIL))
	{	
		$exist = mysqli_query($SQL, "SELECT SendTo FROM newsletter WHERE SendTo = '$email'");

		if (mysqli_num_rows($exist) == 0)
		{
			$query = mysqli_query($SQL, "INSERT INTO newsletter (SendTo) VALUES ('$email')");

			if ($query)
			{
				echo "true";
				return true;
			}
			else echo "false";
			return true;
		}
		else echo "exists";
	}
	else echo "valid-email";
	return true;
}
if ($_POST["process"] == "deleteAccount")
{
	$account = mysqli_real_escape_string($SQL, $_POST["account"]);
	// deactivated set to 1, than copy all user data and insert in new table, after the process delete existing user ID from users
	$query = mysqli_query($SQL, "UPDATE users SET Deactivated='1' WHERE ID='$account'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "changePassword")
{	
	$id = mysqli_real_escape_string($SQL, $_POST["account"]);
	$old_pass = mysqli_real_escape_string($SQL, $_POST["old_pass"]);
	$new_pass = mysqli_real_escape_string($SQL, $_POST["new_pass"]);

	$old = mysqli_query($SQL, "SELECT Password FROM users WHERE ID='$id' AND Password=sha1('$old_pass')");

	if (mysqli_num_rows($old) != 0)
	{	
		$new = mysqli_query($SQL, "UPDATE users SET Password=sha1('$new_pass') WHERE ID='$id'");

		if ($new)
		{
			unset($_SESSION["Logged"]);
			setcookie("email", "", time() - 3600 , "/");
			setcookie("password", "", time() - 3600 , "/");
			echo "true";
			return true;
		}
		else echo "false";
		return true;
	}
	else echo "old-password";
	return true;
}
if ($_POST["process"] == "updateProfile")
{	
	$id = mysqli_real_escape_string($SQL, $_POST["account"]);
	$full_name = mysqli_real_escape_string($SQL, $_POST["full_name"]);
	$user_phone = mysqli_real_escape_string($SQL, $_POST["user_phone"]);

	$query = mysqli_query($SQL, "UPDATE users SET Name='$full_name', Phone='$user_phone' WHERE ID='$id'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "sendEmail")
{	
	$name = mysqli_real_escape_string($SQL, $_POST["name"]);
	$email = mysqli_real_escape_string($SQL, $_POST["email"]);
	$phone = mysqli_real_escape_string($SQL, $_POST["phone"]);
	$message = mysqli_real_escape_string($SQL, $_POST["message"]);

	if (filter_var($email, FILTER_VALIDATE_EMAIL))
	{
		$subject = 'New message from '.$serverInfo["Title"].'';

		$body = "
		<html>
			<head>
				<title>HTML email</title>
				<style>
					h1 { font-size: 26px; }
					p { font-size: 18px; }
					span { font-size: 12px; }
				</style>
			</head>
			<body>
				<h1>Please answer this EMail as soon as possible</h1>
				
				<p>
				".$name."<br>
				".$message."<br>
				".$phone."<br>
				".$email."
				</p>
			</body>
		</html>
		";

		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

		$headers .= 'From: '.$name.' <'.$email.'>' . "\r\n";

		// mail($email, $subject, $body, $headers);
		echo "true";
		return true;
	}
	else echo "valid-email";
	return true;	
}

// this stands here by default
else
{
	redirect("home");
}
?>