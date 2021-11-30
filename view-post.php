<?php 
    session_start();
    require_once("config.php");

    if (!$_GET['b']) { redirect("home"); }
    else { $blodID = $_GET['b']; }

    $bQuery = mysqli_query($SQL, "SELECT * FROM blog_posts WHERE ID='$blodID'");
    if (mysqli_num_rows($bQuery) > 0)
    {
        $blog_rows = mysqli_fetch_assoc($bQuery);

        $userid = $blog_rows["User"];
        $uQuery = mysqli_query($SQL, "SELECT Name, Avatar FROM users WHERE ID='$userid'");
        $uInfo = mysqli_fetch_assoc($uQuery);
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
                <div class="row gx-5">
                    <div class="col-lg-3">
                        <div class="d-flex align-items-center mt-lg-5 mb-4">
                            <img class="img-fluid rounded-circle" width="50" height="50" src="assets/profile/<?php echo $uInfo["Avatar"]; ?>" alt="..." />
                            <div class="ms-3">
                                <div class="fw-bold"><?php echo $uInfo["Name"]; ?></div>
                                <span class="text-muted">Author</span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9">
                        <!-- Post content-->
                        <article>
                            <!-- Post header-->
                            <header class="mb-4">
                                <!-- Post title-->
                                <h1 class="fw-bolder mb-1"><?php echo $blog_rows["BlogTitle"]; ?></h1>
                                <!-- Post meta content-->
                                <div class="text-muted fst-italic mb-2"><?php echo date("F j, Y, g:i a", strtotime($blog_rows["BlogDate"])); ?></div>
                                <!-- Post categories-->
                                <?php 
                                $catid = $blog_rows["BlogCategory"];
                                $cQuery = mysqli_query($SQL, "SELECT Category FROM blog_categories WHERE ID='$catid'");
                                if (mysqli_num_rows($cQuery) > 0)
                                {
                                    while ($cInfo = mysqli_fetch_assoc($cQuery))
                                    {
                                        echo '<a class="badge bg-secondary text-decoration-none text-capitalize link-light" href="#!">'.$cInfo["Category"].'</a>';
                                    }
                                }
                                ?>
                            </header>
                            <!-- Preview image figure-->
                            <figure class="mb-4"><img class="img-fluid rounded" src="admin/assets/featured/<?php echo $blog_rows["BlogFeatured"]; ?>" alt="..." /></figure>
                            <!-- Post content-->
                            <section class="mb-5">
                                <?php echo $blog_rows["BlogContent"]; ?>
                            </section>
                        </article>
                        <!-- Comments section-->
                        <section>
                            <div class="card bg-light">
                                <div class="card-body">
                                    <!-- Comment form-->
                                    <form class="mb-4"><textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!"></textarea></form>
                                    <!-- Comment with nested comments-->
                                    <div class="d-flex mb-4">
                                        <!-- Parent comment-->
                                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">Commenter Name</div>
                                            If you're going to lead a space frontier, it has to be government; it'll never be private enterprise. Because the space frontier is dangerous, and it's expensive, and it has unquantified risks.
                                            <!-- Child comment 1-->
                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                                <div class="ms-3">
                                                    <div class="fw-bold">Commenter Name</div>
                                                    And under those conditions, you cannot establish a capital-market evaluation of that enterprise. You can't get investors.
                                                </div>
                                            </div>
                                            <!-- Child comment 2-->
                                            <div class="d-flex mt-4">
                                                <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                                <div class="ms-3">
                                                    <div class="fw-bold">Commenter Name</div>
                                                    When you put money directly to a problem, it makes a good headline.
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Single comment-->
                                    <div class="d-flex">
                                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                                        <div class="ms-3">
                                            <div class="fw-bold">Commenter Name</div>
                                            When I look at the universe and all the ways the universe wants to kill us, I find it hard to reconcile that with statements of beneficence.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </section>
    	<?php include 'elements/footer.php'; ?>
  	</body>
  	<?php include 'elements/scripts.php'; ?>
</html>