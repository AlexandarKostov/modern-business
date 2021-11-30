<?php 
    session_start();
    require_once("config.php");

    if (!$_GET['i']) { redirect("home"); }
    else { $portID = $_GET['i']; }

    $pQuery = mysqli_query($SQL, "SELECT * FROM portfolio_items WHERE ID='$portID'");
    if (mysqli_num_rows($pQuery) > 0)
    {
        $portItem = mysqli_fetch_assoc($pQuery);
    }
    else 
    {
        redirect("home");
    }
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
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-6">
                        <div class="text-center mb-5">
                            <h1 class="fw-bolder"><?php echo $portItem["PortTitle"]; ?></h1>
                            <p class="lead fw-normal text-muted mb-0"><?php echo $portItem["PortDesc"]; ?></p>
                        </div>
                    </div>
                </div>
                <div class="row gx-5">
                    <div class="col-12"><img class="img-fluid rounded-3 mb-5" src="admin/assets/featured/<?php echo $portItem["PortFeatured"]; ?>" alt="..." /></div>
                </div>
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8">
                        <?php echo $portItem["PortContent"]; ?>
                    </div>
                </div>
            </div>
        </section>
    	<?php include 'elements/footer.php'; ?>
  	</body>
  	<?php include 'elements/scripts.php'; ?>
</html>