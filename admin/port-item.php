<?php 
    session_start();
    require_once("config.php");
    $filePathName = basename($_SERVER["PHP_SELF"]);
    $setPathName = explode(".", $filePathName);
    if (!$_GET['a']) { redirect("?a=default"); }
    if (isset($_GET['id'])){
        $url_port_id = $_GET['id'];
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
            <h2 class="mb-4 text-capitalize"><?php echo($setPathName[0]) ? 'Portfolio items' : ''; ?></h2>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            <div class="container">
                <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link text-uppercase small fw-bolder <?php echo($_GET['a'] == "default") ? 'active' : ''; ?>" href="?a=default">All items</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase small fw-bolder <?php echo($_GET['a'] == "add") ? 'active' : ''; ?>" href="?a=add">Add item</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-uppercase small fw-bolder <?php echo(isset($_GET['a']) == "edit" && isset($_GET['id'])) ? 'active' : 'hidden'; ?>" href="#!">ITEM ID: <?php echo $url_port_id; ?></a>
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
                            <th>Title</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $pQuery = mysqli_query($SQL, "SELECT * FROM portfolio_items");
                        if (mysqli_num_rows($pQuery) > 0)
                        {
                            while ($port_item = mysqli_fetch_assoc($pQuery))
                            {
                                ?>
                                <tr>
                                    <td><?php echo $port_item["ID"]; ?></td>
                                    <td><?php echo $port_item["PortTitle"]; ?></td>
                                    <td>
                                        <a href="port-item?a=edit&id=<?php echo $port_item["ID"]; ?>" class="btn btn-primary btn-custom btn-sm"><i class="bi bi-pencil-square"></i></a>
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
                                            <input type="text" class="form-control" id="item_title" placeholder="Lorem Ipsum Generator">
                                            <label for="item_title">Item Title</label>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <form enctype="multipart/form-data">
                                            <div class="input-group">
                                                <input type="file" class="form-control form-select-custom" id="item_featured" accept="image/*">    
                                            </div>
                                        </form>
                                    </div>  
                                </div>
                                <div class="row">
                                    <div class="col">
                                        <div class="form-floating mb-3">
                                            <textarea class="form-control" placeholder="Item short descrption" id="item_desc" style="height: 220px; resize: none;"></textarea>
                                            <label for="item_desc">Item short descrption</label>
                                        </div>
                                    </div>
                                </div>

                                <textarea name="itemContent" id="itemContent"></textarea>                                
                                <script>CKEDITOR.replace("itemContent");</script>
                                <div class="my-4">
                                    <button type="submit" id="insert_item" class="btn btn-primary btn-custom">Insert item</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php }   
            else if (isset($_GET['a']) == "edit" && isset($_GET['id']))  
            {
                $content = mysqli_query($SQL, "SELECT * FROM portfolio_items WHERE ID='$url_port_id'");
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
                                                <input type="text" class="form-control" id="edit_port_title" placeholder="Lorem Ipsum Generator" value="<?php echo $load_content["PortTitle"]; ?>">
                                                <label for="edit_port_title">Blog Title</label>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <form enctype="multipart/form-data">
                                                <div class="input-group">
                                                    <input type="file" class="form-control form-select-custom" id="edit_port_featured" accept="image/*">
                                                </div>
                                            </form>
                                        </div>  
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-floating mb-3">
                                                <textarea class="form-control" placeholder="Item short descrption" id="edit_port_desc" style="height: 220px; resize: none;"><?php echo $load_content["PortDesc"]; ?></textarea>
                                                <label for="edit_port_desc">Item short descrption</label>
                                            </div>
                                        </div>
                                    </div>
                                    <textarea name="editPortContent" id="editPortContent"></textarea>
                                    <script>
                                        let content = '<?php echo mysqli_real_escape_string($SQL, $load_content["PortContent"]); ?>';
                                        CKEDITOR.replace('editPortContent');
                                        CKEDITOR.instances.editPortContent.setData(content, {
                                            callback: function() {
                                                this.checkDirty();
                                            }
                                        } );
                                    </script>
                                    <div class="my-4">
                                        <button type="submit" id="delete_item" data-item-id="<?php echo $load_content["ID"]; ?>" class="btn btn-outline-danger">Delete item</button>
                                        <button type="submit" id="save_item" data-item-id="<?php echo $load_content["ID"]; ?>" class="btn btn-primary btn-custom">Save changes</button>
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