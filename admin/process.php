<?php
session_start();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include_once('include/mysql.php');
include_once('include/functions.php');

if ($_POST["process"] == "login")
{
	$email = mysqli_real_escape_string($SQL, $_POST["email"]);
	$password = mysqli_real_escape_string($SQL, $_POST["password"]);

	$query = mysqli_query($SQL, "SELECT * FROM users WHERE EMail='$email' AND Password=sha1('$password')");

	if (mysqli_num_rows($query) != 0)
	{
		$data = mysqli_fetch_assoc($query);

		if ($data["Admin"] == 0)
		{
			echo "access";
			return true;
		}
		else
		{
			$_SESSION['Logged'] = $data["ID"];

			echo "true";
			return true;
		}
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "changeMode")
{
	$mode = mysqli_real_escape_string($SQL, $_POST["mode"]);
	$info = mysqli_real_escape_string($SQL, $_POST["info"]);

	if ($mode == 0) { $info = "N/A"; }

	$query = mysqli_query($SQL, "UPDATE server SET Mode='$mode', Information='$info'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "changeTitle")
{
	$siteTitle = mysqli_real_escape_string($SQL, $_POST["siteTitle"]);

	$query = mysqli_query($SQL, "UPDATE server SET Title='$siteTitle'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "changeFooter")
{
	$siteFooter = mysqli_real_escape_string($SQL, $_POST["siteFooter"]);

	$query = mysqli_query($SQL, "UPDATE server SET FooterText='$siteFooter'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "changeLogo") 
{
	$image = mysqli_real_escape_string($SQL, $_FILES["file"]["name"]);

	$query = mysqli_query($SQL, "UPDATE server SET Logo='$image'");

	if (file_exists("assets/".$_FILES["file"]["name"]))
	{
		unlink("assets/".$_FILES["file"]["name"]);
		move_uploaded_file($_FILES["file"]["tmp_name"], "assets/".$_FILES["file"]["name"]);
	}
	else { move_uploaded_file($_FILES["file"]["tmp_name"], "assets/".$_FILES["file"]["name"]); }

	if ($query)
	{
		echo "true";
		return true;
	}
	else
	{
		echo "false";
		return true;
	}
	return true;
}
if ($_POST["process"] == "updateUser")
{
	$id = mysqli_real_escape_string($SQL, $_POST["id"]);
	$name = mysqli_real_escape_string($SQL, $_POST["name"]);
	$approved = mysqli_real_escape_string($SQL, $_POST["approved"]);
	$access = mysqli_real_escape_string($SQL, $_POST["access"]);
	$pnumber = mysqli_real_escape_string($SQL, $_POST["pnumber"]);
	$bday = mysqli_real_escape_string($SQL, $_POST["bday"]);

	$query = mysqli_query($SQL, "UPDATE users SET Name='$name', Approved='$approved', Admin='$access', Phone='$pnumber', Birthday='$bday' WHERE ID='$id'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "insertArticle")
{
	$author = mysqli_real_escape_string($SQL, $_POST["author"]);
	$title = mysqli_real_escape_string($SQL, $_POST["title"]);
	$desc = mysqli_real_escape_string($SQL, $_POST["desc"]);
	$data = mysqli_real_escape_string($SQL, $_POST["data"]);
	$category = mysqli_real_escape_string($SQL, $_POST["category"]);
	$featured = mysqli_real_escape_string($SQL, $_FILES["file"]["name"]);

	$query = mysqli_query($SQL, "INSERT INTO blog_posts (User, BlogTitle, BlogDesc, BlogContent, BlogCategory, BlogFeatured) VALUES ('$author', '$title', '$desc', '$data', '$category', '$featured')");

	if ($query)
	{
		move_uploaded_file($_FILES["file"]["tmp_name"], "assets/featured/".$_FILES["file"]["name"]);
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "updateArticle")
{
	$id = mysqli_real_escape_string($SQL, $_POST["id"]);
	$title = mysqli_real_escape_string($SQL, $_POST["title"]);
	$desc = mysqli_real_escape_string($SQL, $_POST["desc"]);
	$data = mysqli_real_escape_string($SQL, $_POST["data"]);
	$category = mysqli_real_escape_string($SQL, $_POST["category"]);

	if (isset($_FILES["file"]["name"]))
	{
		$featured = mysqli_real_escape_string($SQL, $_FILES["file"]["name"]);

		if (file_exists("assets/featured/".$_FILES["file"]["name"]))
		{
			unlink("assets/featured/".$_FILES["file"]["name"]);
			move_uploaded_file($_FILES["file"]["tmp_name"], "assets/featured/".$_FILES["file"]["name"]);
		}
		else { move_uploaded_file($_FILES["file"]["tmp_name"], "assets/featured/".$_FILES["file"]["name"]); }

		$query = mysqli_query($SQL, "UPDATE blog_posts SET BlogTitle='$title', BlogDesc='$desc', BlogContent='$data', BlogCategory='$category', BlogFeatured='$featured' WHERE ID='$id'");

		if ($query)
		{
			echo "true";
			return true;
		}
		else echo "false";
		return true;
	}
	else
	{
		$query = mysqli_query($SQL, "UPDATE blog_posts SET BlogTitle='$title', BlogDesc='$desc', BlogContent='$data', BlogCategory='$category' WHERE ID='$id'");

		if ($query)
		{
			echo "true";
			return true;
		}
		else echo "false";
		return true;
	}
	return true;	
}
if ($_POST["process"] == "deleteArticle")
{
	$id = mysqli_real_escape_string($SQL, $_POST["id"]);

	$query = mysqli_query($SQL, "DELETE FROM blog_posts WHERE ID='$id'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "insertItem")
{
	$title = mysqli_real_escape_string($SQL, $_POST["title"]);
	$desc = mysqli_real_escape_string($SQL, $_POST["desc"]);
	$data = mysqli_real_escape_string($SQL, $_POST["data"]);
	$featured = mysqli_real_escape_string($SQL, $_FILES["file"]["name"]);

	$query = mysqli_query($SQL, "INSERT INTO portfolio_items (PortTitle, PortDesc, PortContent, PortFeatured) VALUES ('$title', '$desc', '$data', '$featured')");

	if ($query)
	{
		move_uploaded_file($_FILES["file"]["tmp_name"], "assets/featured/".$_FILES["file"]["name"]);
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "updateItem")
{
	$id = mysqli_real_escape_string($SQL, $_POST["id"]);
	$title = mysqli_real_escape_string($SQL, $_POST["title"]);
	$desc = mysqli_real_escape_string($SQL, $_POST["desc"]);
	$data = mysqli_real_escape_string($SQL, $_POST["data"]);
	
	if (isset($_FILES["file"]["name"]))
	{
		$featured = mysqli_real_escape_string($SQL, $_FILES["file"]["name"]);

		if (file_exists("assets/featured/".$_FILES["file"]["name"]))
		{
			unlink("assets/featured/".$_FILES["file"]["name"]);
			move_uploaded_file($_FILES["file"]["tmp_name"], "assets/featured/".$_FILES["file"]["name"]);
		}
		else { move_uploaded_file($_FILES["file"]["tmp_name"], "assets/featured/".$_FILES["file"]["name"]); }

		$query = mysqli_query($SQL, "UPDATE portfolio_items SET PortTitle='$title', PortDesc='$desc', PortContent='$data', PortFeatured='$featured' WHERE ID='$id'");

		if ($query)
		{
			echo "true";
			return true;
		}
		else echo "false";
		return true;
	}
	else
	{
		$query = mysqli_query($SQL, "UPDATE portfolio_items SET PortTitle='$title', PortDesc='$desc', PortContent='$data' WHERE ID='$id'");

		if ($query)
		{
			echo "true";
			return true;
		}
		else echo "false";
		return true;
	}
	return true;	
}
if ($_POST["process"] == "deleteItem")
{
	$id = mysqli_real_escape_string($SQL, $_POST["id"]);

	$query = mysqli_query($SQL, "DELETE FROM portfolio_items WHERE ID='$id'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "insertTestimonial")
{
	$text = mysqli_real_escape_string($SQL, $_POST["text"]);
	$name = mysqli_real_escape_string($SQL, $_POST["name"]);
	$title = mysqli_real_escape_string($SQL, $_POST["title"]);

	if ($title == "") { $title = "N/A"; }

	$query = mysqli_query($SQL, "INSERT INTO testimonial (Text, Name, Title) VALUES ('$text', '$name', '$title')");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "deleteTestimonial")
{
	$id = mysqli_real_escape_string($SQL, $_POST["id"]);

	$query = mysqli_query($SQL, "DELETE FROM testimonial WHERE ID='$id'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "editTestimonial")
{
	$id = mysqli_real_escape_string($SQL, $_POST["id"]);
	$text = mysqli_real_escape_string($SQL, $_POST["text"]);
	$name = mysqli_real_escape_string($SQL, $_POST["name"]);
	$title = mysqli_real_escape_string($SQL, $_POST["title"]);

	if ($title == "") { $title = "N/A"; }

	$query = mysqli_query($SQL, "UPDATE testimonial SET Text='$text', Name='$name', Title='$title' WHERE ID='$id'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "addCategory")
{
	$category = mysqli_real_escape_string($SQL, $_POST["category"]);

	$query = mysqli_query($SQL, "INSERT INTO blog_categories (Category) VALUES ('$category')");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "updateHome")
{
	$edit_home1 = mysqli_real_escape_string($SQL, $_POST["edit_home1"]);
	$edit_home2 = mysqli_real_escape_string($SQL, $_POST["edit_home2"]);
	$edit_home3 = mysqli_real_escape_string($SQL, $_POST["edit_home3"]);
	$edit_home4 = mysqli_real_escape_string($SQL, $_POST["edit_home4"]);
	$edit_home6 = mysqli_real_escape_string($SQL, $_POST["edit_home6"]);
	$edit_home7 = mysqli_real_escape_string($SQL, $_POST["edit_home7"]);
	$edit_home8 = mysqli_real_escape_string($SQL, $_POST["edit_home8"]);
	$edit_home9 = mysqli_real_escape_string($SQL, $_POST["edit_home9"]);
	$edit_home10 = mysqli_real_escape_string($SQL, $_POST["edit_home10"]);
	$edit_home11 = mysqli_real_escape_string($SQL, $_POST["edit_home11"]);
	$edit_home12 = mysqli_real_escape_string($SQL, $_POST["edit_home12"]);
	$edit_home13 = mysqli_real_escape_string($SQL, $_POST["edit_home13"]);
	$edit_home14 = mysqli_real_escape_string($SQL, $_POST["edit_home14"]);
	$edit_home15 = mysqli_real_escape_string($SQL, $_POST["edit_home15"]);
	$edit_home16 = mysqli_real_escape_string($SQL, $_POST["edit_home16"]);
	
	if (isset($_FILES["file"]["name"]))
	{
		$featured = mysqli_real_escape_string($SQL, $_FILES["file"]["name"]);

		if (file_exists("../assets/pages/".$_FILES["file"]["name"]))
		{
			unlink("../assets/pages/".$_FILES["file"]["name"]);
			move_uploaded_file($_FILES["file"]["tmp_name"], "../assets/pages/".$_FILES["file"]["name"]);
		}
		else { move_uploaded_file($_FILES["file"]["tmp_name"], "../assets/pages/".$_FILES["file"]["name"]); }

		$query = mysqli_query($SQL, "UPDATE home SET Option1='$edit_home1', Option2='$edit_home2', Option3='$edit_home3', Option4='$edit_home4', Option5='$featured', Option6='$edit_home6', Option7='$edit_home7', Option8='$edit_home8', Option9='$edit_home9', Option10='$edit_home10', Option11='$edit_home11', Option12='$edit_home12', Option13='$edit_home13', Option14='$edit_home14', Option15='$edit_home15', Option16='$edit_home16' WHERE ID='1'");

		if ($query)
		{
			echo "true";
			return true;
		}
		else echo "false";
		return true;
	}
	else
	{
		$query = mysqli_query($SQL, "UPDATE home SET Option1='$edit_home1', Option2='$edit_home2', Option3='$edit_home3', Option4='$edit_home4', Option6='$edit_home6', Option7='$edit_home7', Option8='$edit_home8', Option9='$edit_home9', Option10='$edit_home10', Option11='$edit_home11', Option12='$edit_home12', Option13='$edit_home13', Option14='$edit_home14', Option15='$edit_home15', Option16='$edit_home16' WHERE ID='1'");

		if ($query)
		{
			echo "true";
			return true;
		}
		else echo "false";
		return true;
	}
	return true;	
}
if ($_POST["process"] == "updateAbout")
{
	$edit_about1 = mysqli_real_escape_string($SQL, $_POST["edit_about1"]);
	$edit_about2 = mysqli_real_escape_string($SQL, $_POST["edit_about2"]);
	$edit_about3 = mysqli_real_escape_string($SQL, $_POST["edit_about3"]);
	$edit_about5 = mysqli_real_escape_string($SQL, $_POST["edit_about5"]);
	$edit_about6 = mysqli_real_escape_string($SQL, $_POST["edit_about6"]);
	$edit_about7 = mysqli_real_escape_string($SQL, $_POST["edit_about7"]);
	$edit_about8 = mysqli_real_escape_string($SQL, $_POST["edit_about8"]);
	$edit_about10 = mysqli_real_escape_string($SQL, $_POST["edit_about10"]);
	$edit_about11 = mysqli_real_escape_string($SQL, $_POST["edit_about11"]);
	
	$query = mysqli_query($SQL, "UPDATE about SET Option1='$edit_about1', Option2='$edit_about2', Option3='$edit_about3', Option5='$edit_about5', Option6='$edit_about6', Option7='$edit_about7', Option8='$edit_about8', Option10='$edit_about10', Option11='$edit_about11' WHERE ID='1'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "updateAboutImg1")
{
	if (isset($_FILES["file"]["name"]))
	{
		$featured = mysqli_real_escape_string($SQL, $_FILES["file"]["name"]);

		if (file_exists("../assets/pages/".$_FILES["file"]["name"]))
		{
			unlink("../assets/pages/".$_FILES["file"]["name"]);
			move_uploaded_file($_FILES["file"]["tmp_name"], "../assets/pages/".$_FILES["file"]["name"]);
		}
		else { move_uploaded_file($_FILES["file"]["tmp_name"], "../assets/pages/".$_FILES["file"]["name"]); }

		$query = mysqli_query($SQL, "UPDATE about SET Option4='$featured' WHERE ID='1'");

		if ($query)
		{
			echo "true";
			return true;
		}
		else echo "false";
		return true;
	}
	return true;	
}
if ($_POST["process"] == "updateAboutImg2")
{
	if (isset($_FILES["file"]["name"]))
	{
		$featured = mysqli_real_escape_string($SQL, $_FILES["file"]["name"]);

		if (file_exists("../assets/pages/".$_FILES["file"]["name"]))
		{
			unlink("../assets/pages/".$_FILES["file"]["name"]);
			move_uploaded_file($_FILES["file"]["tmp_name"], "../assets/pages/".$_FILES["file"]["name"]);
		}
		else { move_uploaded_file($_FILES["file"]["tmp_name"], "../assets/pages/".$_FILES["file"]["name"]); }

		$query = mysqli_query($SQL, "UPDATE about SET Option9='$featured' WHERE ID='1'");

		if ($query)
		{
			echo "true";
			return true;
		}
		else echo "false";
		return true;
	}
	return true;	
}
if ($_POST["process"] == "insertMember")
{
	$member_name = mysqli_real_escape_string($SQL, $_POST["member_name"]);
	$member_title = mysqli_real_escape_string($SQL, $_POST["member_title"]);
	$featured = mysqli_real_escape_string($SQL, $_FILES["file"]["name"]);

	$query = mysqli_query($SQL, "INSERT INTO team (Avatar, Name, Title) VALUES ('$featured', '$member_name', '$member_title')");

	if ($query)
	{
		move_uploaded_file($_FILES["file"]["tmp_name"], "../assets/profile/".$_FILES["file"]["name"]);
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "updateMember")
{
	$member_id = mysqli_real_escape_string($SQL, $_POST["member_id"]);
	$edit_member_name = mysqli_real_escape_string($SQL, $_POST["edit_member_name"]);
	$edit_member_title = mysqli_real_escape_string($SQL, $_POST["edit_member_title"]);
	
	if (isset($_FILES["file"]["name"]))
	{
		$avatar = mysqli_real_escape_string($SQL, $_FILES["file"]["name"]);

		if (file_exists("../assets/profile/".$_FILES["file"]["name"]))
		{
			unlink("../assets/profile/".$_FILES["file"]["name"]);
			move_uploaded_file($_FILES["file"]["tmp_name"], "../assets/profile/".$_FILES["file"]["name"]);
		}
		else { move_uploaded_file($_FILES["file"]["tmp_name"], "../assets/profile/".$_FILES["file"]["name"]); }

		$query = mysqli_query($SQL, "UPDATE team SET Avatar='$avatar', Name='$edit_member_name', Title='$edit_member_title' WHERE ID='$member_id'");

		if ($query)
		{
			echo "true";
			return true;
		}
		else echo "false";
		return true;
	}
	else
	{
		$query = mysqli_query($SQL, "UPDATE team SET Name='$edit_member_name', Title='$edit_member_title' WHERE ID='$member_id'");

		if ($query)
		{
			echo "true";
			return true;
		}
		else echo "false";
		return true;
	}
	return true;	
}
if ($_POST["process"] == "deleteMember")
{
	$id = mysqli_real_escape_string($SQL, $_POST["id"]);

	$query = mysqli_query($SQL, "DELETE FROM team WHERE ID='$id'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "updatePricing")
{
	$edit_pricing1 = mysqli_real_escape_string($SQL, $_POST["edit_pricing1"]);
	$edit_pricing2 = mysqli_real_escape_string($SQL, $_POST["edit_pricing2"]);
	
	$query = mysqli_query($SQL, "UPDATE pricing SET Option1='$edit_pricing1', Option2='$edit_pricing2' WHERE ID='1'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "updateBlog")
{
	$edit_blog1 = mysqli_real_escape_string($SQL, $_POST["edit_blog1"]);
	$edit_blog2 = mysqli_real_escape_string($SQL, $_POST["edit_blog2"]);
	$edit_blog3 = mysqli_real_escape_string($SQL, $_POST["edit_blog3"]);
	
	$query = mysqli_query($SQL, "UPDATE blog SET Option1='$edit_blog1', Option2='$edit_blog2', Option3='$edit_blog3' WHERE ID='1'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "updatePortfolio")
{
	$edit_portfolio1 = mysqli_real_escape_string($SQL, $_POST["edit_portfolio1"]);
	$edit_portfolio2 = mysqli_real_escape_string($SQL, $_POST["edit_portfolio2"]);
	$edit_portfolio3 = mysqli_real_escape_string($SQL, $_POST["edit_portfolio3"]);
	$edit_portfolio4 = mysqli_real_escape_string($SQL, $_POST["edit_portfolio4"]);
	
	$query = mysqli_query($SQL, "UPDATE portfolio SET Option1='$edit_portfolio1', Option2='$edit_portfolio2', Option3='$edit_portfolio3', Option4='$edit_portfolio4' WHERE ID='1'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "updateFAQ")
{
	$edit_faq1 = mysqli_real_escape_string($SQL, $_POST["edit_faq1"]);
	$edit_faq2 = mysqli_real_escape_string($SQL, $_POST["edit_faq2"]);
	$edit_faq3 = mysqli_real_escape_string($SQL, $_POST["edit_faq3"]);
	$edit_faq4 = mysqli_real_escape_string($SQL, $_POST["edit_faq4"]);
	$edit_faq5 = mysqli_real_escape_string($SQL, $_POST["edit_faq5"]);
	$edit_faq6 = mysqli_real_escape_string($SQL, $_POST["edit_faq6"]);
	
	
	$query = mysqli_query($SQL, "UPDATE faq SET Option1='$edit_faq1', Option2='$edit_faq2', Option3='$edit_faq3', Option4='$edit_faq4', Option5='$edit_faq5', Option6='$edit_faq6' WHERE ID='1'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "insertFAQ")
{
	$title = mysqli_real_escape_string($SQL, $_POST["faq_title"]);
	$answer = mysqli_real_escape_string($SQL, $_POST["faq_answer"]);

	$query = mysqli_query($SQL, "INSERT INTO faq_item (FaqTitle, FaqAnswer) VALUES ('$title', '$answer')");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}
if ($_POST["process"] == "deleteFAQ")
{
	$id = mysqli_real_escape_string($SQL, $_POST["id"]);

	$query = mysqli_query($SQL, "DELETE FROM faq_item WHERE ID='$id'");

	if ($query)
	{
		echo "true";
		return true;
	}
	else echo "false";
	return true;
}


// this stands here by default
else
{
	redirect("dashboard");
}
?>