<?php
if (isset($_POST["alert"]))
{
	require_once("../config.php");

	$alert = $_POST["alert"];
	$message = $_POST["message"];
	?>

	<div class="alert <?php echo $alert; ?>"><?php echo ($alert == "success") ? '<i class="bi bi-check-circle"></i>' : '<i class="bi bi-x-circle"></i>'; echo '<p>'.$message.'</p>'; ?></div>
	
	<?php
}
else { redirect("../home"); }
?>