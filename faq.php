<?php 
    $pageName = "FAQ";
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
	    <!-- Page content-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="text-center mb-5">
                    <h1 class="fw-bolder"><?php echo $faqSetting["Option1"]; ?></h1>
                    <p class="lead fw-normal text-muted mb-0"><?php echo $faqSetting["Option2"]; ?></p>
                </div>
                <div class="row gx-5">
                    <div class="col-xl-8">
                        <!-- FAQ Accordion 1-->
                        <h2 class="fw-bolder mb-3"><?php echo $faqSetting["Option3"]; ?></h2>
                        <div class="accordion mb-5" id="accordionExample">
                            <?php 
                            $query = mysqli_query($SQL, "SELECT * FROM faq_item");
                            if (mysqli_num_rows($query) > 0)
                            {
                                while ($setFAQ = mysqli_fetch_assoc($query))
                                { ?>
                                    <div class="accordion-item">
                                        <h3 class="accordion-header" id="heading<?php echo $setFAQ["ID"]; ?>"><button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse<?php echo $setFAQ["ID"]; ?>" aria-expanded="true" aria-controls="collapse<?php echo $setFAQ["ID"]; ?>"><?php echo $setFAQ["FaqTitle"]; ?> #<?php echo $setFAQ["ID"]; ?></button></h3>
                                        <div class="accordion-collapse collapse" id="collapse<?php echo $setFAQ["ID"]; ?>" aria-labelledby="heading<?php echo $setFAQ["ID"]; ?>" data-bs-parent="#accordionExample">
                                            <div class="accordion-body">
                                                <p style="word-break: break-word;"><?php echo $setFAQ["FaqAnswer"]; ?></p>
                                            </div>
                                        </div>
                                    </div>
                                <?php }
                            }
                            else
                            { ?>
                                <div class="d-flex justify-content-center"><div class="col-lg-12 text-center"><div class="alert-warning rounded">
                                    <p class="px-2 py-2" style="font-size: 1.05rem;"><strong><i class="bi bi-exclamation-circle text-danger pe-2"></i> Sorry!</strong> No faq were found yet.</p>
                                </div></div></div>
                            <?php }
                            ?>
                        </div>    
                    </div>
                    <div class="col-xl-4">
                        <div class="card border-0 bg-light mt-xl-5">
                            <div class="card-body p-4 py-lg-5">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="text-center">
                                        <div class="h6 fw-bolder"><?php echo $faqSetting["Option4"]; ?></div>
                                        <p class="text-muted mb-4">
                                            <?php echo $faqSetting["Option5"]; ?>
                                            <br />
                                            <a href="mailto:<?php echo $faqSetting["Option6"]; ?>"><?php echo $faqSetting["Option6"]; ?></a>
                                        </p>
                                        <div class="h6 fw-bolder">Follow us</div>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-twitter"></i></a>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-facebook"></i></a>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-linkedin"></i></a>
                                        <a class="fs-5 px-2 link-dark" href="#!"><i class="bi-youtube"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    	<?php include 'elements/footer.php'; ?>
  	</body>
  	<?php include 'elements/scripts.php'; ?>
</html>