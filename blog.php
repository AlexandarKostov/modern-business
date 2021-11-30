<?php 
    $pageName = "Blog";
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
            <div class="container px-5">
                <h1 class="fw-bolder fs-5 mb-4">Latest Blog</h1>
                <div class="card border-0 shadow rounded-3 overflow-hidden">
                    <div class="card-body p-0">
                        <div class="row gx-0">
                            <?php 
                            $last = mysqli_query($SQL, "SELECT * FROM blog_posts ORDER BY ID DESC LIMIT 1");
                            if (mysqli_num_rows($last) > 0)
                            {
                                while ($latest = mysqli_fetch_assoc($last))
                                {
                                    $catid = $latest["BlogCategory"];
                                    $cQuery = mysqli_query($SQL, "SELECT Category FROM blog_categories WHERE ID='$catid'");
                                    $cInfo = mysqli_fetch_assoc($cQuery);
                                    ?>
                                    <div class="col-lg-6 col-xl-5 py-lg-5">
                                        <div class="p-4 p-md-5">
                                            <div class="badge bg-primary bg-gradient rounded-pill text-capitalize mb-2"><?php echo $cInfo["Category"]; ?></div>
                                            <div class="h2 fw-bolder"><?php echo $latest["BlogTitle"]; ?></div>
                                            <p><?php echo $latest["BlogDesc"]; ?></p>
                                            <a class="stretched-link text-decoration-none" href="view-post?b=<?php echo $latest["ID"]; ?>">
                                                Read more
                                                <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-xl-7"><img src="admin/assets/featured/<?php echo $latest["BlogFeatured"]; ?>" class="blog-featured"></div>
                                <?php }
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="py-5 bg-light">
            <div class="container px-5">
                <div class="row gx-5">
                    <?php 
                        $query = mysqli_query($SQL, "SELECT DISTINCT BlogCategory FROM blog_posts");
                        if (mysqli_num_rows($query) > 0)
                        {
                            while ($blog_rows = mysqli_fetch_assoc($query))
                            {
                                if ($blog_rows["BlogCategory"] == 2)
                                {                                    
                                    $catid = $blog_rows["BlogCategory"];
                                    $category = mysqli_query($SQL, "SELECT Category FROM blog_categories WHERE ID='$catid'");
                                    $catInfo = mysqli_fetch_assoc($category);
                                    ?>
                                    <div class="col-xl-8">
                                        <h2 class="fw-bolder text-capitalize fs-5 mb-4"><?php echo $catInfo["Category"]; ?></h2>
                                        <?php 
                                        $blog = mysqli_query($SQL, "SELECT * FROM blog_posts WHERE BlogCategory='$catid' LIMIT 3");
                                        if (mysqli_num_rows($blog) > 0)
                                        {
                                            while ($dBlog = mysqli_fetch_assoc($blog))
                                            { ?>
                                                <div class="mb-4">
                                                    <div class="small text-muted"><?php echo date("F j, Y, g:i a", strtotime($dBlog["BlogDate"])); ?></div>
                                                    <a class="link-dark" href="view-post?b=<?php echo $dBlog["ID"]; ?>"><h3><?php echo $dBlog["BlogTitle"]; ?></h3></a>
                                                </div>
                                            <?php }
                                        }
                                        ?>
                                        <div class="text-end mb-5 mb-xl-0">
                                            <a class="text-decoration-none" href="#!">
                                                More news
                                                <i class="bi bi-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                <?php }
                            } 
                        }
                    ?>
                    <div class="col-xl-4">
                        <div class="card border-0 h-100">
                            <div class="card-body p-4">
                                <div class="d-flex h-100 align-items-center justify-content-center">
                                    <div class="text-center">
                                        <div class="h6 fw-bolder"><?php echo $blogSetting["Option1"]; ?></div>
                                        <p class="text-muted mb-4">
                                           <?php echo $blogSetting["Option2"]; ?>
                                            <br />
                                            <a href="mailto:<?php echo $blogSetting["Option3"]; ?>"><?php echo $blogSetting["Option3"]; ?></a>
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
        <!-- Blog preview section-->
        <section class="py-5">
            <div class="container px-5">
                <h2 class="fw-bolder fs-5 mb-4">Stories</h2>
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
                    } ?>
                </div>
                <div class="text-end mb-5 mb-xl-0">
                    <a class="text-decoration-none" href="#!">
                        More stories
                        <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </section>
    	<?php include 'elements/footer.php'; ?>
  	</body>
  	<?php include 'elements/scripts.php'; ?>
</html>