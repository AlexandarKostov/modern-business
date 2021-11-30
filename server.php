<?php 
    session_start();
    if (isset($_SESSION['serverMode']) == null && isset($_SESSION['serverMsg']) == null)
    {
        header("Location: home");
    }
?>
<!doctype html>
<html lang="en">
  	<head>
	  	<?php include 'elements/head.php'; ?>
  	</head>
  	<body style="background-color: #fefcfc;">
        <main class="error">
            <img src="assets/images/error-gif.gif" class="error-img" />
            <div class="my-5">
                <p class="h4">Current server staus: <strong><?php echo $_SESSION['serverMode']; ?></strong></p>
                <p class="h6 mt-3"><?php echo $_SESSION['serverMsg']; ?></p>
            </div>
            <a href="home" class="text-decoration-none">← Return back
                <?php unset($_SESSION['serverMode']); unset($_SESSION['serverMsg']);  ?></a> <div class="mt-2">- or -</div>
            <div class="my-2"><a class="text-danger text-decoration-none small" href="admin/login">Sing In as Administrator</a></div>
        </main>
  	</body>
  	<?php include 'elements/scripts.php'; ?>
</html>