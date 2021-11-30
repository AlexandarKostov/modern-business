<?php 
    $pageName = "About";
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

            <!-- Header-->
            <header class="py-5">
                <div class="container px-5">
                    <div class="row justify-content-center">
                        <div class="col-lg-8 col-xxl-6">
                            <div class="text-center my-5">
                                <h1 class="fw-bolder mb-3 text-white"><?php echo $aboutSetting["Option1"]; ?></h1>
                                <p class="lead fw-normal text-white-80 mb-4"><?php echo $aboutSetting["Option2"]; ?></p>
                                <a class="btn btn-primary btn-lg" href="#scroll-target"><?php echo $aboutSetting["Option3"]; ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
        </div>
	   <!-- About section one-->
        <section class="py-5 bg-light" id="scroll-target">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6"><img class="img-fluid rounded mb-5 mb-lg-0" src="assets/pages/<?php echo $aboutSetting["Option4"]; ?>" alt="..." /></div>
                    <div class="col-lg-6">
                        <h2 class="fw-bolder"><?php echo $aboutSetting["Option5"]; ?></h2>
                        <p class="lead fw-normal text-muted mb-0"><?php echo $aboutSetting["Option6"]; ?></p>
                    </div>
                </div>
            </div>
        </section>
        <!-- About section two-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5 align-items-center">
                    <div class="col-lg-6 order-first order-lg-last"><img class="img-fluid rounded mb-5 mb-lg-0" src="assets/pages/<?php echo $aboutSetting["Option9"]; ?>" alt="..." /></div>
                    <div class="col-lg-6">
                        <h2 class="fw-bolder"><?php echo $aboutSetting["Option7"]; ?></h2>
                        <p class="lead fw-normal text-muted mb-0"><?php echo $aboutSetting["Option8"]; ?></p>
                    </div>
                </div>
            </div>
        </section>
        <!-- Team members section-->
        <section class="py-5 bg-light">
            <div class="container px-5 my-5">
                <div class="text-center">
                    <h2 class="fw-bolder"><?php echo $aboutSetting["Option10"]; ?></h2>
                    <p class="lead fw-normal text-muted mb-5"><?php echo $aboutSetting["Option11"]; ?></p>
                </div>
                <div class="row gx-5 row-cols-1 row-cols-sm-2 row-cols-xl-4 justify-content-center">
                    <?php 
                    $team = mysqli_query($SQL, "SELECT * FROM team");
                    if (mysqli_num_rows($team) > 0)
                    {
                        while ($member = mysqli_fetch_assoc($team))
                        { ?>
                            <div class="col mb-5 mb-5 mb-xl-0">
                                <div class="text-center">
                                    <img class="img-fluid rounded-circle mb-4 px-4" src="assets/profile/<?php echo $member["Avatar"]; ?>" alt="..." />
                                    <h5 class="fw-bolder"><?php echo $member["Name"]; ?></h5>
                                    <div class="fst-italic text-muted"><?php echo $member["Title"]; ?></div>
                                </div>
                            </div>
                        <?php }
                    }
                    ?>
                </div>
            </div>
        </section>
    	<?php include 'elements/footer.php'; ?>
  	</body>
  	<?php include 'elements/scripts.php'; ?>
</html>