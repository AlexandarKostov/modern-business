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
        <h2 class="mb-4 text-capitalize"><?php echo($setPathName[0]) ? 'Server Settings' : ''; ?></h2>
        
        <div class="container">
            <div class="alert-warning rounded">
                <p class="px-4 py-4" style="font-size: 1.05rem;"><strong><i class="bi bi-exclamation-circle text-danger pe-2"></i> Warning!</strong> You should be careful with some of those fields below.</p>
            </div>

            <div class="card">
                <?php 
                $mode = mysqli_query($SQL, "SELECT Mode, Information FROM server");
                $serverMode = mysqli_fetch_assoc($mode);

                
                ?>
                <div class="card-header h5">Current server mode: <strong><?php echo serverMode($serverMode["Mode"]); ?></strong></div>
                <div class="card-body">
                    
                    <div class="input-group">
                        <select class="form-select" id="selectServer">
                            <!-- <option selected disabled>Update server mode..</option> -->
                            <option value="0" <?php echo(serverMode($serverMode["Mode"]) == "Normal") ? 'selected' : ''; ?> >Normal</option>
                            <option value="1" <?php echo(serverMode($serverMode["Mode"]) == "Locked / Maintenance") ? 'selected' : ''; ?> >Locked / Maintenance</option>
                        </select>
                        <input type="text" class="form-control" placeholder="Information* (custom message) .." id="srvInfo" <?php echo(serverMode($serverMode["Mode"]) == "Normal") ? 'disabled' : 'enabled'; ?> value="<?php echo(serverMode($serverMode["Mode"]) == "Locked / Maintenance") ? $serverMode["Information"] : ''; ?>" >
                        <button class="btn btn-outline-secondary" type="button" id="srvUpdate">Update</button>
                    </div>

                </div>
                <div class="card-footer small text-muted">Changing server mode will affect your website. <span class="text-danger">Please choose wisely!</span></div>
            </div>  
        </div>

        <div class="container">
            <div class="row my-4">
                <?php 
                $query = mysqli_query($SQL, "SELECT Logo, Title, FooterText FROM server");
                $serverData = mysqli_fetch_assoc($query); 

                ?>
                <div class="col-sm-3 mx-1 my-2">
                    <div class="card" style="width: 18rem;">
                        <div class="card-header text-muted small">Current server logo</div>
                        <img src="assets/<?php echo $serverData["Logo"]; ?>" class="card-img-top m-auto" style="width: 60%; height: 60%;" />
                        <div class="card-body">
                            <form enctype="multipart/form-data">
                                <div class="input-group">
                                    <input type="file" class="form-control" id="siteLogo" accept="image/*">    
                                </div>
                                <button class="btn btn-outline-secondary mt-1 mb-1" type="submit" id="uploadLogo" style="width: 100%;">Upload logo</button>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 mx-1 my-2">
                    <div class="card my-2">
                        <div class="card-header text-muted small">Current server title</div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Change site title" id="siteTitle" value="<?php echo $serverData["Title"]; ?>">
                                <button class="btn btn-outline-secondary" type="submit" id="updateTitle">Update</button>
                            </div>
                            <p class="card-text small text-muted">Updating site title will change the name itself.</p>
                        </div>
                    </div>
                    <div class="card my-2">
                        <div class="card-header text-muted small">Current footer text</div>
                        <div class="card-body">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Change footer text" id="siteFooter" value="<?php echo $serverData["FooterText"]; ?>">
                                <button class="btn btn-outline-secondary" type="submit" id="updateFooter">Update</button>
                            </div>
                            <p class="card-text small text-muted">Updating footer text will change the content itself.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include 'elements/scripts.php'; ?>
    </body>
</html>