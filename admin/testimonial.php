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
            <h2 class="mb-4 text-capitalize"><?php echo($setPathName[0]) ? 'Testimonial' : ''; ?></h2>

            <div class="container mb-3 mt-3">
                <button id="insert_testimonial" class="btn btn-primary btn-custom my-4">Insert testimonial</button>
                <div class="row default-background">
                    <?php 
                    $query = mysqli_query($SQL, "SELECT * FROM testimonial");
                    if (mysqli_num_rows($query) > 0)
                    {
                        while ($data = mysqli_fetch_assoc($query))
                        { ?>
                            <div class="col-sm-4">
                                <div class="card text-dark bg-light mb-3 mt-3">
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo $data["Name"]; ?> <span class="fw-bold text-primary mx-1">/</span> <?php echo $data["Title"]; ?></h5>
                                        <p class="card-text"><?php echo $data["Text"]; ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" id="delete_testimonial" data-testimonial="<?php echo $data["ID"]; ?>" class="btn btn-outline-danger"><i class="bi bi-trash"></i></button>
                                        <button type="submit" id="edit_testimonial" data-testimonial="<?php echo $data["ID"]; ?>" class="btn btn-outline-primary"><i class="bi bi-pencil-square"></i></button>
                                    </div>
                                </div>
                            </div>
                        <?php }
                    }
                    else
                    {
                        echo '<div class="container mt-3"><div class="alert-warning rounded">
                            <p class="px-4 py-4" style="font-size: 1.05rem;"><strong><i class="bi bi-exclamation-circle text-danger pe-2"></i> Warning!</strong> Sorry, but we could not find any testimonial in our database.</p>
                        </div></div>';
                    }
                    ?>
                </div>
            </div>
        </div>

    </div>
    <?php include 'elements/scripts.php'; ?>
    </body>
</html>