<?php 
    session_start();
    require_once("config.php");
    $filePathName = basename($_SERVER["PHP_SELF"]);
    $setPathName = explode(".", $filePathName);
?>
<!doctype html>
<html lang="en">
  	<head>
	  	<?php include 'elements/head.php'; ?>
  	</head>
    <body>
        <div class="alert-load"></div>
        <div class="modal-load"></div>
        
        <div class="wrapper d-flex align-items-stretch">
        <?php include 'elements/nav.php'; ?>
        
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-4 text-capitalize"><?php echo($setPathName[0]) ? 'Dashboard' : ''; ?></h2>

            <div class="container mb-3 mt-3">
            ... content   
        </div>

    </div>
    <?php include 'elements/scripts.php'; ?>
    </body>
</html>