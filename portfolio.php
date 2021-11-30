<?php 
    $pageName = "Portfolio";
    session_start();
    require_once("config.php");
?>
<!doctype html>
<html lang="en">
  	<head>
	  	<?php include 'elements/head.php'; ?>
  	</head>
  	<body>
        <div class="alert-load"></div>
        <div class="modal-load"></div>
        <div class="animated">   
            <?php include 'elements/nav.php'; ?>
        </div>
    	<!-- Page Content-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder"><?php echo $portfolioSetting["Option1"]; ?></h1>
                    <p class="lead fw-normal text-muted mb-0"><?php echo $portfolioSetting["Option2"]; ?></p>
                </div>
                <div class="row gx-5">
                    <?php 
                    $port = mysqli_query($SQL, "SELECT * FROM portfolio_items ORDER BY ID DESC");
                    if (mysqli_num_rows($port) > 0)
                    {
                        while ($setPort = mysqli_fetch_assoc($port))
                        { ?>
                            <div class="col-lg-6">
                                <div class="position-relative mb-5">
                                    <img class="img-fluid rounded-3 mb-3" src="admin/assets/featured/<?php echo $setPort["PortFeatured"]; ?>" alt="..." />
                                    <a class="h3 fw-bolder text-decoration-none link-dark stretched-link" href="view-item?i=<?php echo $setPort["ID"]; ?>"><?php echo $setPort["PortTitle"]; ?></a>
                                </div>
                            </div>
                        <?php }
                    }
                    else
                    { ?>
                        <div class="d-flex justify-content-center"><div class="col-lg-8 text-center"><div class="alert-warning rounded">
                            <p class="px-2 py-2" style="font-size: 1.05rem;"><strong><i class="bi bi-exclamation-circle text-danger pe-2"></i> Sorry!</strong> No portfolio items were found yet.</p>
                        </div></div></div>
                    <?php }
                    ?>
                </div>
            </div>
        </section>
        <section class="py-5 bg-light">
            <div class="container px-5 my-5">
                <h2 class="display-4 fw-bolder mb-4"><?php echo $portfolioSetting["Option3"]; ?></h2>
                <a class="btn btn-lg btn-primary" href="contact"><?php echo $portfolioSetting["Option4"]; ?></a>
            </div>
        </section>  
    	<?php include 'elements/footer.php'; ?>
  	</body>
  	<?php include 'elements/scripts.php'; ?>
</html>