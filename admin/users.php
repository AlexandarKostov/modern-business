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
            <h2 class="mb-4 text-capitalize"><?php echo($setPathName[0]) ? 'Manage Users' : ''; ?></h2>

            <div class="container mb-3 mt-3">
            <table class="table table-striped table-boardered" style="width: 100%" id="mydatatable">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>EMail</th>
                        <th>Status</th>
                        <th>Access</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        $users = mysqli_query($SQL, "SELECT * FROM users");
                        if (mysqli_num_rows($users) > 0)
                        {
                            while ($uData = mysqli_fetch_assoc($users)) 
                            {
                                echo '
                                    <tr>
                                        <td>'.$uData["ID"].'</td>
                                        <td>'.$uData["Name"].'</td>
                                        <td><a href="mailto:'.$uData["EMail"].'">'.$uData["EMail"].'</a></td>
                                        <td><span class="'.userStatus($uData["Approved"]).' text-uppercase">'.userStatus($uData["Approved"]).'</span></td>
                                        <td><span class="'.userAccess($uData["Admin"]).' text-uppercase">'.userAccess($uData["Admin"]).'</span></td>
                                        <td>
                                            <button id="editUser" data-user="'.$uData["ID"].'" class="btn btn-primary btn-custom btn-sm"><i class="bi bi-pencil-square"></i></button>
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
    <?php include 'elements/scripts.php'; ?>
    </body>
    <script>
        $('#mydatatable').DataTable({
            ordering: false,
            lengthMenu: [[5, 10, 25, 50, 100, -1], [5, 10, 25, 50, 100, "All"]]
        });
    </script>
</html>