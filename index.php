<?php 
    $pageName = "Home";
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

    	    <!-- Header -->
	    	<div class="container py-4">
	    		<div class="row justify-content center align-items center">
	    			<div class="col-sm-6 my-5">
	    				<h1 class="display-5 fw-bolder my-5 mb-2 text-white"><?php echo $homeSetting["Option1"]; ?></h1>
	    				<p class="lead fw-normal text-white-50 mb-4">
	    					<?php echo $homeSetting["Option2"]; ?>
	    				</p>
	    				<div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
	    					<a class="btn btn-primary btn-lg px-4 me-sm-3" href="#features"><?php echo $homeSetting["Option3"]; ?></a>
                            <a class="btn btn-outline-light btn-lg px-4" href="#!"><?php echo $homeSetting["Option4"]; ?></a>
	    				</div>
	    			</div>
	    			<div class="col-sm-6 d-none d-xl-block text-center">
	    				<img class="img-fluid rounded-3 my-5" src="assets/pages/<?php echo $homeSetting["Option5"]; ?>" />
	    			</div>
	    		</div>
	    	</div>
        </div>
	    <!-- Features section -->
	    <section class="py-5" id="features">
	    	<div class="container px-5 my-5">
	    		<div class="row gx-5">
	    			<div class="col-sm-4"><h2 class="fw-bolder mb-0"><?php echo $homeSetting["Option6"]; ?></h2></div>
	    			<div class="col-sm-8">
	    				<div class="row gx-5 row-cols-1 row-cols-md-2">
	    					<div class="col mb-5 h-100">
		    					<div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-collection"></i></div>
	                    		<h2 class="h5"><?php echo $homeSetting["Option7"]; ?></h2>
	                        	<p class="mb-0"><?php echo $homeSetting["Option8"]; ?></p>
	    					</div>
	    					<div class="col mb-5 h-100">
                                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-building"></i></div>
                                    <h2 class="h5"><?php echo $homeSetting["Option9"]; ?></h2>
                                    <p class="mb-0"><?php echo $homeSetting["Option10"]; ?></p>
                                </div>
                                <div class="col mb-5 mb-md-0 h-100">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                                    <h2 class="h5"><?php echo $homeSetting["Option11"]; ?></h2>
                                    <p class="mb-0"><?php echo $homeSetting["Option12"]; ?></p>
                                </div>
                                <div class="col h-100">
                                    <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-toggles2"></i></div>
                                    <h2 class="h5"><?php echo $homeSetting["Option13"]; ?></h2>
                                    <p class="mb-0"><?php echo $homeSetting["Option14"]; ?></p>
                                </div>
                            </div>
	    				</div>
    				</div>
	    		</div>
	    	</div>
	    </section>
	    <!-- Testimonial section -->
	    <div class="py-5 bg-light">
	    	<div class="container px-5 my-5">
	    		<div class="row gx-5 justify-content-center">
                    <?php 
                        $query = mysqli_query($SQL, "SELECT * FROM testimonial WHERE ID=1");
                        if (mysqli_num_rows($query) > 0)
                        {
                            $tdata = mysqli_fetch_assoc($query);
                        }
                    ?>
	    			<div class="col-sm-7">
	    				<div class="text-center">
	    					<div class="fs-4 mb-4 fst-italic"><?php echo $tdata["Text"]; ?></div>
                            <div class="d-flex align-items-center justify-content-center">
                                <!-- <img class="rounded-circle me-3" src="https://dummyimage.com/40x40/ced4da/6c757d" alt="..." /> -->
                                <div class="fw-bold">
                                    <?php 
                                        echo $tdata["Name"];

                                        if ($tdata["Title"] != "N/A"){
                                            echo '<span class="fw-bold text-primary mx-1"> / </span>'.$tdata["Title"];
                                        }
                                    ?>
                                </div>
                            </div>
	    				</div>
	    			</div>
	    		</div>
	    	</div>
	    </div>
	    <!-- Blog preview section-->
        <section class="py-5">
            <div class="container px-5 my-5">
                <div class="row gx-5 justify-content-center">
                    <div class="col-lg-8 col-xl-6">
                        <div class="text-center">
                            <h2 class="fw-bolder"><?php echo $homeSetting["Option15"]; ?></h2>
                            <p class="lead fw-normal text-muted mb-5"><?php echo $homeSetting["Option16"]; ?></p>
                        </div>
                    </div>
                </div>
                <div class="row gx-5">
                    <?php 
                        $bQuery = mysqli_query($SQL, "SELECT * FROM blog_posts ORDER BY ID DESC LIMIT 3");
                        if (mysqli_num_rows($bQuery) > 0)
                        {
                            while ($blog_rows = mysqli_fetch_assoc($bQuery))
                            {
                                $userid = $blog_rows["User"];
                                $uQuery = mysqli_query($SQL, "SELECT Name, Avatar FROM users WHERE ID='$userid'");
                                $uInfo = mysqli_fetch_assoc($uQuery);

                                $catid = $blog_rows["BlogCategory"];
                                $cQuery = mysqli_query($SQL, "SELECT Category FROM blog_categories WHERE ID='$catid'");
                                $cInfo = mysqli_fetch_assoc($cQuery);
                                ?>
                                <div class="col-lg-4 mb-5">
                                    <div class="card h-100 shadow border-0">
                                        <img class="card-img-top" src="admin/assets/featured/<?php echo $blog_rows["BlogFeatured"]; ?>" alt="..." />
                                        <div class="card-body p-4">
                                            <div class="badge bg-primary bg-gradient rounded-pill text-capitalize mb-2"><?php echo $cInfo["Category"] ?></div>
                                            <a class="text-decoration-none link-dark stretched-link" href="view-post?b=<?php echo $blog_rows["ID"]; ?>"><h5 class="card-title mb-3"><?php echo $blog_rows["BlogTitle"]; ?></h5></a>
                                            <p class="card-text mb-0"><?php echo mb_strimwidth($blog_rows["BlogDesc"], 0, 110, "..."); ?></p>
                                        </div>
                                        <div class="card-footer p-4 pt-0 bg-transparent border-top-0">
                                            <div class="d-flex align-items-end justify-content-between">
                                                <div class="d-flex align-items-center">
                                                    <img class="rounded-circle me-3" width="42" height="42" src="assets/profile/<?php echo $uInfo["Avatar"]; ?>" alt="..." />
                                                    <div class="small">
                                                        <div class="fw-bold"><?php echo $uInfo["Name"]; ?></div>
                                                        <div class="text-muted"><?php echo date("F j, Y, g:i a", strtotime($blog_rows["BlogDate"])); ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        }
                        else
                        {
                            echo '<div class="d-flex justify-content-center"><div class="col-lg-8 text-center"><div class="alert-warning rounded">
                                <p class="px-2 py-2" style="font-size: 1.05rem;"><strong><i class="bi bi-exclamation-circle text-danger pe-2"></i> Sorry!</strong> No post were found yet.</p>
                            </div></div></div>';
                        }
                    ?>
                </div>
                <!-- Call to action-->
                <aside class="bg-primary bg-gradient rounded-3 p-4 p-sm-5 mt-5">
                    <div class="d-flex align-items-center justify-content-between flex-column flex-xl-row text-center text-xl-start">
                        <div class="mb-4 mb-xl-0">
                            <div class="fs-3 fw-bold text-white">New products, delivered to you.</div>
                            <div class="text-white-50">Sign up for our newsletter for the latest updates.</div>
                        </div>
                        <div class="ms-xl-4">
                            <div class="input-group mb-2">
                                <input class="form-control" type="text" placeholder="Email address..." aria-label="Email address..." aria-describedby="button-newsletter" id="email_newsletter" />
                                <button class="btn btn-outline-light" id="button_newsletter" type="submit">Sign up</button>
                            </div>
                            <div class="small text-white-50">We care about privacy, and will never share your data.</div>
                        </div>
                    </div>
                </aside>
            </div>
        </section>

    	<?php include 'elements/footer.php'; ?>
  	</body>
  	<?php include 'elements/scripts.php'; ?>
</html>