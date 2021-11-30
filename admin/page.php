<?php 
    session_start();
    require_once("config.php");
    $filePathName = basename($_SERVER["PHP_SELF"]);
    $setPathName = explode(".", $filePathName);

    if (isset($_GET['filter'])) { $filter = $_GET['filter']; } else { redirect("dashboard"); }
?>
<!doctype html>
<html lang="en">
  	<head>
	  	<?php include 'elements/head.php'; ?>
        <style>
            .main-body { padding: 15px; }
            .nav-link { color: #4a5568; }
            .card { box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06); }
            .card {
                position: relative;
                display: flex;
                flex-direction: column;
                min-width: 0;
                word-wrap: break-word;
                background-color: #fff;
                background-clip: border-box;
                border: 0 solid rgba(0,0,0,.125);
                border-radius: .25rem;
            }
            .card-body { flex: 1 1 auto; min-height: 1px; padding: 1rem; }
            .gutters-sm { margin-right: -8px; margin-left: -8px; }
            .gutters-sm>.col, .gutters-sm>[class*=col-] { padding-right: 8px; padding-left: 8px; }
            .mb-3, .my-3 { margin-bottom: 1rem!important; }
            .bg-gray-300 { background-color: #e2e8f0; }
            .h-100 { height: 100%!important; }
            .shadow-none { box-shadow: none!important; }
        </style>
  	</head>
    <body>
        <div class="alert-load"></div>
        <div class="modal-load"></div>
        
        <div class="wrapper d-flex align-items-stretch">
        <?php include 'elements/nav.php'; ?>
        
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-4 text-capitalize"><?php echo($setPathName[0]) ? $filter.' - Page' : ''; ?></h2>

            <div class="container mb-3 mt-3">
            <?php 
                if ($_GET['filter'] == "home")
                { ?>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-body tab-content">
                                    <div class="tab-pane active">
                                        <h6>UPDATE PAGE CONTENT</h6>
                                        <hr>
                                        <?php 
                                        $home = mysqli_query($SQL, "SELECT * FROM home");
                                        $homeSetting = mysqli_fetch_assoc($home);
                                        ?>
                                        <form enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home1" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option1"]; ?></textarea>
                                                        <label for="edit_home1">Heading</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home2" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option2"]; ?></textarea>
                                                        <label for="edit_home2">Content</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home3" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option3"]; ?></textarea>
                                                        <label for="edit_home3">Button text</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home4" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option4"]; ?></textarea>
                                                        <label for="edit_home4">Button text</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="file" class="form-control form-select-custom" id="edit_home5" accept="image/*">
                                                        <p class="ml-1 text-muted small">Choose heading image (600x400 cm - recommended)</p>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home6" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option6"]; ?></textarea>
                                                        <label for="edit_home6">Content</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home7" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option7"]; ?></textarea>
                                                        <label for="edit_home7">Content</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home8" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option8"]; ?></textarea>
                                                        <label for="edit_home8">Content</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home9" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option9"]; ?></textarea>
                                                        <label for="edit_home9">Content</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home10" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option10"]; ?></textarea>
                                                        <label for="edit_home10">Content</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home11" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option11"]; ?></textarea>
                                                        <label for="edit_home11">Content</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home12" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option12"]; ?></textarea>
                                                        <label for="edit_home12">Content</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home13" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option13"]; ?></textarea>
                                                        <label for="edit_home13">Content</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home14" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option14"]; ?></textarea>
                                                        <label for="edit_home14">Content</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home15" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option15"]; ?></textarea>
                                                        <label for="edit_home15">Content</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_home16" style="height: 110px !important; resize: none;"><?php echo $homeSetting["Option16"]; ?></textarea>
                                                        <label for="edit_home16">Content</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" id="update_home" class="btn btn-outline-primary btn-sm">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                if ($_GET['filter'] == "about")
                { ?>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-body tab-content">
                                    <div class="tab-pane active">
                                        <h6>UPDATE PAGE CONTENT</h6>
                                        <hr>
                                        <?php 
                                        $about = mysqli_query($SQL, "SELECT * FROM about");
                                        $aboutSetting = mysqli_fetch_assoc($about);
                                        ?>
                                        <form enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_about1" style="height: 110px !important; resize: none;"><?php echo $aboutSetting["Option1"]; ?></textarea>
                                                        <label for="edit_about1">Heading</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_about2" style="height: 110px !important; resize: none;"><?php echo $aboutSetting["Option2"]; ?></textarea>
                                                        <label for="edit_about2">Content</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="edit_about3" placeholder="Button text" value="<?php echo $aboutSetting["Option3"]; ?>">
                                                        <label for="edit_about3">Button text</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" id="edit_about4" accept="image/*" aria-label="Upload">
                                                        <button class="btn btn-outline-secondary" type="submit" id="edit_img4">Upload</button>
                                                    </div>
                                                     <p class="ml-1 text-muted small">Choose first image (600x400 cm - recommended)</p>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" id="edit_about9" accept="image/*" aria-label="Upload">
                                                        <button class="btn btn-outline-secondary" type="submit" id="edit_img9">Upload</button>
                                                    </div>
                                                     <p class="ml-1 text-muted small">Choose second image (600x400 cm - recommended)</p>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_about5" style="height: 110px !important; resize: none;"><?php echo $aboutSetting["Option5"]; ?></textarea>
                                                        <label for="edit_about5">Content</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_about6" style="height: 110px !important; resize: none;"><?php echo $aboutSetting["Option6"]; ?></textarea>
                                                        <label for="edit_about6">Content</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_about7" style="height: 110px !important; resize: none;"><?php echo $aboutSetting["Option7"]; ?></textarea>
                                                        <label for="edit_about7">Content</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_about8" style="height: 110px !important; resize: none;"><?php echo $aboutSetting["Option8"]; ?></textarea>
                                                        <label for="edit_about8">Content</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="edit_about10" placeholder="Content" value="<?php echo $aboutSetting["Option10"]; ?>">
                                                        <label for="edit_about10">Content</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <input type="text" class="form-control" id="edit_about11" placeholder="Content" value="<?php echo $aboutSetting["Option11"]; ?>">
                                                        <label for="edit_about11">Content</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <button type="submit" id="update_about" class="btn btn-outline-primary btn-sm">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-10 my-4">
                            <button id="add_member" class="btn btn-primary btn-custom btn-md my-2"><i class="bi bi-pencil-square me-2"></i> Add member</button>
                            <table class="table table-striped table-boardered" style="width: 100%" id="memberstable">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Avatar</th>
                                        <th>Name</th>
                                        <th>Title</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                        $team = mysqli_query($SQL, "SELECT * FROM team");
                                        if (mysqli_num_rows($team) > 0)
                                        {
                                            while ($tData = mysqli_fetch_assoc($team)) 
                                            {
                                                echo '
                                                    <tr>
                                                        <td>'.$tData["ID"].'</td>
                                                        <td><img src="../assets/profile/'.$tData["Avatar"].'" width="45" height="45" class="rounded-circle"></td>
                                                        <td>'.$tData["Name"].'</td>
                                                        <td>'.$tData["Title"].'</td>
                                                        <td>
                                                            <button id="edit_member" data-member="'.$tData["ID"].'" class="btn btn-primary btn-custom btn-sm"><i class="bi bi-pencil-square"></i></button>
                                                        </td>
                                                    </tr>
                                                ';
                                            }
                                        }
                                    ?>
                                </tbody>
                            </table>   
                        </div>
                    </div>
                <?php }
                if ($_GET['filter'] == "pricing")
                { ?>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-body tab-content">
                                    <div class="tab-pane active">
                                        <h6>UPDATE PAGE CONTENT</h6>
                                        <hr>
                                        <?php 
                                        $pricing = mysqli_query($SQL, "SELECT * FROM pricing");
                                        $pricingSetting = mysqli_fetch_assoc($pricing);
                                        ?>
                                        <form enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_pricing1" style="height: 110px !important; resize: none;"><?php echo $pricingSetting["Option1"]; ?></textarea>
                                                        <label for="edit_pricing1">Heading</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_pricing2" style="height: 110px !important; resize: none;"><?php echo $pricingSetting["Option2"]; ?></textarea>
                                                        <label for="edit_pricing2">Content</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" id="update_pricing" class="btn btn-outline-primary btn-sm">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                if ($_GET['filter'] == "blog")
                { ?>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-body tab-content">
                                    <div class="tab-pane active">
                                        <h6>UPDATE PAGE CONTENT</h6>
                                        <hr>
                                        <?php 
                                        $blog = mysqli_query($SQL, "SELECT * FROM blog");
                                        $blogSetting = mysqli_fetch_assoc($blog);
                                        ?>
                                        <form enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-4">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_blog1" style="height: 110px !important; resize: none;"><?php echo $blogSetting["Option1"]; ?></textarea>
                                                        <label for="edit_blog1">Heading</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_blog2" style="height: 110px !important; resize: none;"><?php echo $blogSetting["Option2"]; ?></textarea>
                                                        <label for="edit_blog2">Content</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-4">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_blog3" style="height: 110px !important; resize: none;"><?php echo $blogSetting["Option3"]; ?></textarea>
                                                        <label for="edit_blog3">Content</label>
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            <button type="submit" id="update_blog" class="btn btn-outline-primary btn-sm">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                if ($_GET['filter'] == "portfolio")
                { ?>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-body tab-content">
                                    <div class="tab-pane active">
                                        <h6>UPDATE PAGE CONTENT</h6>
                                        <hr>
                                        <?php 
                                        $portfolio = mysqli_query($SQL, "SELECT * FROM portfolio");
                                        $portfolioSetting = mysqli_fetch_assoc($portfolio);
                                        ?>
                                        <form enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_portfolio1" style="height: 110px !important; resize: none;"><?php echo $portfolioSetting["Option1"]; ?></textarea>
                                                        <label for="edit_portfolio1">Heading</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_portfolio2" style="height: 110px !important; resize: none;"><?php echo $portfolioSetting["Option2"]; ?></textarea>
                                                        <label for="edit_portfolio2">Content</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_portfolio3" style="height: 110px !important; resize: none;"><?php echo $portfolioSetting["Option3"]; ?></textarea>
                                                        <label for="edit_portfolio3">Heading</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Button text" id="edit_portfolio4" style="height: 110px !important; resize: none;"><?php echo $portfolioSetting["Option4"]; ?></textarea>
                                                        <label for="edit_portfolio4">Button text</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" id="update_portfolio" class="btn btn-outline-primary btn-sm">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php }
                if ($_GET['filter'] == "faq")
                { ?>
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-body tab-content">
                                    <div class="tab-pane active">
                                        <h6>UPDATE PAGE CONTENT</h6>
                                        <hr>
                                        <?php 
                                        $faq = mysqli_query($SQL, "SELECT * FROM faq");
                                        $faqSetting = mysqli_fetch_assoc($faq);
                                        ?>
                                        <form enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_faq1" style="height: 110px !important; resize: none;"><?php echo $faqSetting["Option1"]; ?></textarea>
                                                        <label for="edit_faq1">Heading</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_faq2" style="height: 110px !important; resize: none;"><?php echo $faqSetting["Option2"]; ?></textarea>
                                                        <label for="edit_faq2">Content</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_faq3" style="height: 110px !important; resize: none;"><?php echo $faqSetting["Option3"]; ?></textarea>
                                                        <label for="edit_faq3">Heading</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_faq4" style="height: 110px !important; resize: none;"><?php echo $faqSetting["Option4"]; ?></textarea>
                                                        <label for="edit_faq4">Content</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="edit_faq5" style="height: 110px !important; resize: none;"><?php echo $faqSetting["Option5"]; ?></textarea>
                                                        <label for="edit_faq5">Heading</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Contact Email" id="edit_faq6" style="height: 110px !important; resize: none;"><?php echo $faqSetting["Option6"]; ?></textarea>
                                                        <label for="edit_faq6">Contact Email</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" id="update_faq" class="btn btn-outline-primary btn-sm">Save changes</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center my-4">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-body tab-content">
                                    <div class="tab-pane active">
                                        <h6>INSERT FAQ</h6>
                                        <hr>
                                        <form enctype="multipart/form-data">
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="faq_title" style="height: 60px !important; resize: none;"></textarea>
                                                        <label for="faq_title">Question</label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-floating mb-3">
                                                        <textarea class="form-control" placeholder="Content" id="faq_answer" style="height: 180px !important; resize: none;"></textarea>
                                                        <label for="faq_answer">Answer</label>
                                                    </div>
                                                </div>
                                            </div>

                                            <button type="submit" id="add_faq" class="btn btn-outline-primary btn-sm">Insert FAQ</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <?php 
                        $query = mysqli_query($SQL, "SELECT * FROM faq_item");
                        if (mysqli_num_rows($query) > 0)
                        {
                            while ($faqs = mysqli_fetch_assoc($query))
                            { ?>
                                <div class="col-md-3 mt-4">
                                    <div class="card">
                                        <div class="card-title tab-content m-2">
                                            <?php echo $faqs["FaqTitle"]; ?>
                                        </div>
                                        <div class="card-footer">
                                            <button type="submit" id="delete_faq" data-faq="<?php echo $faqs["ID"]; ?>" class="btn btn-outline-danger btn-sm">Delete FAQ</button>
                                        </div>
                                    </div>
                                </div>
                            <?php }
                        }
                        ?>
                        
                    </div>
                <?php }
                if ($_GET['filter'] == "contact")
                {
                    echo "contact";
                }
                if ($_GET['filter'] == "privacy")
                {
                    echo "privacy";
                }
                if ($_GET['filter'] == "terms")
                {
                    echo "terms";
                }
            ?>
            </div>

        </div>
        <?php include 'elements/scripts.php'; ?>
    </body>
        <script>
        $('#memberstable').DataTable({
            ordering: false,
            lengthMenu: [[15, 25, 50, 100, -1], [15, 25, 50, 100, "All"]]
        });
    </script>
</html>