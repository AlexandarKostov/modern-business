<?php 
    session_start();
    require_once("config.php");
    $filePathName = basename($_SERVER["PHP_SELF"]);
    $setPathName = explode(".", $filePathName);
    if (!$_GET['a']) { redirect("?a=default"); }
    if (isset($_GET['id'])){
        $url_blog_id = $_GET['id'];
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
        
        <div class="wrapper d-flex align-items-stretch">
        <?php include 'elements/nav.php'; ?>
        
        <!-- Page Content  -->
        <div id="content" class="p-4 p-md-5 pt-5">
            <h2 class="mb-4 text-capitalize"><?php echo($setPathName[0]) ? 'Blog posts' : ''; ?></h2>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <div class="container">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase small fw-bolder <?php echo($_GET['a'] == "default") ? 'active' : ''; ?>" href="?a=default">All blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase small fw-bolder <?php echo($_GET['a'] == "add") ? 'active' : ''; ?>" href="?a=add">Add blog</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase small fw-bolder" id="add_category" href="#!">Add category</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase small fw-bolder <?php echo(isset($_GET['a']) == "edit" && isset($_GET['id'])) ? 'active' : 'hidden'; ?>" href="#!">BLOG ID: <?php echo $url_blog_id; ?></a>
                    </li>
                </ul>
            </div>

            <div class="container mb-3 mt-3">
            <?php 
            if ($_GET['a'] == "default")
            { ?>
                <table class="table table-striped table-boardered" style="width: 100%" id="mydatatable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>User</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Published</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $bQuery = mysqli_query($SQL, "SELECT * FROM blog_posts");
                        if (mysqli_num_rows($bQuery) > 0)
                        {
                            while ($blog_rows = mysqli_fetch_assoc($bQuery))
                            {
                                $userid = $blog_rows["User"];
                                $uQuery = mysqli_query($SQL, "SELECT Name FROM users WHERE ID='$userid'");
                                $uInfo = mysqli_fetch_assoc($uQuery);

                                $catid = $blog_rows["BlogCategory"];
                                $cQuery = mysqli_query($SQL, "SELECT Category FROM blog_categories WHERE ID='$catid'");
                                $cInfo = mysqli_fetch_assoc($cQuery);
                                ?>
                                <tr>
                                    <td><?php echo $blog_rows["ID"]; ?></td>
                                    <td><?php echo $uInfo["Name"]; ?></td>
                                    <td><?php echo $blog_rows["BlogTitle"]; ?></td>
                                    <td><span class="badge bg-primary bg-gradient rounded-pill text-capitalize m-1"><?php echo $cInfo["Category"]; ?></span></td>
                                    <td><?php echo $blog_rows["BlogDate"]; ?></td>
                                    <td>
                                        <a href="blog-post?a=edit&id=<?php echo $blog_rows["ID"]; ?>" class="btn btn-primary btn-custom btn-sm"><i class="bi bi-pencil-square"></i></a>
                                    </td>
                                </tr>
                            <?php }
                        }
                        ?>
                    </tbody>
                </table>
            <?php }   
            else if ($_GET['a'] == "add")
            { $author = returnID(); ?>    
                <div class="container my-5">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <form>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <input type="text" class="form-control" id="blog_title" placeholder="Lorem Ipsum Generator">
                                            <label for="blog_title">Blog Title</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <select class="form-select form-select-custom" id="blog_category">
                                            <option selected disabled>Please choose category</option>
                                            <?php 
                                            $catQuery = mysqli_query($SQL, "SELECT * FROM blog_categories");
                                            if (mysqli_num_rows($catQuery) > 0)
                                            {
                                                while ($catData = mysqli_fetch_assoc($catQuery))
                                                {
                                                    echo '<option class="text-capitalize" value="'.$catData["ID"].'">'.$catData["Category"].'</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="col">
                                        <form enctype="multipart/form-data">
                                            <div class="input-group">
                                                <input type="file" class="form-control form-select-custom" id="blog_featured" accept="image/*">    
                                            </div>
                                        </form>
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" placeholder="Blog short descrption" id="blog_desc" style="height: 220px; resize: none;"></textarea>
                                            <label for="blog_desc">Blog short descrption</label>
                                        </div>
                                    </div>
                                </div>

                                <textarea name="blogContent" id="blogContent"></textarea>                                
                                <script>CKEDITOR.replace("blogContent");</script>
                                <div class="my-4">
                                    <button type="submit" data-author="<?php echo $author; ?>" id="insert_article" class="btn btn-primary btn-custom">Insert Article</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php }   
            else if (isset($_GET['a']) == "edit" && isset($_GET['id']))  
            {
                $content = mysqli_query($SQL, "SELECT * FROM blog_posts WHERE ID='$url_blog_id'");
                if (mysqli_num_rows($content) > 0){
                    $load_content = mysqli_fetch_assoc($content);
                    ?>
                    <div class="container my-5">
                        <div class="row justify-content-center">
                            <div class="col-md-12">
                                <form>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <input type="text" class="form-control" id="edit_title" placeholder="Lorem Ipsum Generator" value="<?php echo $load_content["BlogTitle"]; ?>">
                                                <label for="edit_title">Blog Title</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <select class="form-select form-select-custom text-capitalize" id="edit_category">
                                                <option selected disabled>Please choose category</option>
                                                <?php 
                                                $catQuery = mysqli_query($SQL, "SELECT * FROM blog_categories");
                                                if (mysqli_num_rows($catQuery) > 0)
                                                {
                                                    while ($catData = mysqli_fetch_assoc($catQuery))
                                                    { ?>
                                                        <option class="text-capitalize" <?php echo($load_content["BlogCategory"] == $catData["ID"]) ? 'selected' : ''; ?> value="<?php echo $catData["ID"]; ?>"><?php echo $catData["Category"]; ?></option>
                                                   <?php }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col">
                                            <form enctype="multipart/form-data">
                                                <div class="input-group">
                                                    <input type="file" class="form-control form-select-custom" id="edit_featured" accept="image/*">    
                                                </div>
                                            </form>
                                        </div>  
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" placeholder="Blog short descrption" id="edit_desc" style="height: 220px; resize: none;"><?php echo $load_content["BlogDesc"]; ?></textarea>
                                                <label for="edit_desc">Blog short descrption</label>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea name="editBlogContent" id="editBlogContent"></textarea>
                                    <script>
                                        let content = '<?php echo mysqli_real_escape_string($SQL, $load_content["BlogContent"]); ?>';
                                        CKEDITOR.replace('editBlogContent');
                                        CKEDITOR.instances.editBlogContent.setData(content, {
                                            callback: function() {
                                                this.checkDirty();
                                            }
                                        } );
                                    </script>
                                    <div class="my-4">
                                        <button type="submit" id="delete_article" data-article-id="<?php echo $load_content["ID"]; ?>" class="btn btn-outline-danger">Delete article</button>
                                        <button type="submit" id="save_article" data-article-id="<?php echo $load_content["ID"]; ?>" class="btn btn-primary btn-custom">Save changes</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php }
                else {
                    echo '<div class="alert-warning rounded">
                        <p class="px-4 py-4" style="font-size: 1.05rem;"><strong><i class="bi bi-exclamation-circle text-danger pe-2"></i> Warning!</strong> No post were found with selected ID.</p>
                    </div>';
                }
            }            
            ?>
        </div>

    </div>
    <?php include 'elements/scripts.php'; ?>
    </body>
    <script>
        $('#mydatatable').DataTable({
            ordering: false,
            lengthMenu: [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]]
        });
    </script>
</html>