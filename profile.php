<?php 
    session_start();
    require_once("config.php");
    if (!isLogged()) { redirect("home"); }   
?>
<!doctype html>
<html lang="en">
  	<head>
	  	<?php include 'elements/head.php'; ?>
        <style>
            body { height: 100vh; }
            /*footer { position: fixed; width: 100%; bottom: 0; }*/
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
        <div class="animated">   
            <?php include 'elements/nav.php'; ?>

            <div class="container px-2 py-2 my-2">
                <div class="row gx-5 justify-content-center">
                    <div class="text-center mb-5">
                        <?php 
                            $fullname = explode(" ", $userData["Name"]);
                        ?>
                        <h2 class="fw-bolder text-white">Welcome back, <?php echo $fullname[0]; ?></h2>
                        <p class="lead fw-normal text-white-80 mb-0">Everything about your profile you can find on this page</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Settings section-->
        <section class="py-1">
            <div class="container mt-5 mb-5">
                <div class="row gutters-sm">
                    <div class="col-md-4 d-md-block mb-4">
                        <div class="d-flex flex-column align-items-center text-center my-2">
                            <img class="rounded-circle mt-2" width="150px" src="assets/profile/<?php echo $userData["Avatar"]; ?>">
                            <span class="font-weight-bold"><?php echo $userData["Name"]; ?></span>
                            <span class="text-black-50"><?php echo $userData["EMail"]; ?></span>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <nav class="nav flex-column nav-pills nav-gap-y-1">
                                    <a href="#profile" data-bs-toggle="tab" class="nav-item active nav-link has-icon nav-link-faded">
                                        <i class="bi bi-person pe-2"></i></i>Profile Information
                                    </a>
                                    <a href="#account" data-bs-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                                        <i class="bi bi-gear pe-2"></i></i>Account Settings
                                    </a>
                                    <a href="#security" data-bs-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                                        <i class="bi bi-shield-check pe-2"></i>Security
                                    </a>
                                    <a href="#notification" data-bs-toggle="tab" class="nav-item nav-link has-icon nav-link-faded">
                                        <i class="bi bi-bell pe-2"></i>Notification
                                    </a>
                                </nav>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-body tab-content">
                                <div class="tab-pane active" id="profile">
                                    <h6>YOUR PROFILE INFORMATION</h6>
                                    <hr>
                                    <form>
                                        <div class="d-flex justify-content-between align-items-center experience py-2">
                                            <span class="text-uppercase text-muted">Date joined</span>
                                            <span class="border px-3 p-1 bg-light text-dark rounded-3"><i class="fa fa-plus"></i>&nbsp;<?php echo date("F j, Y, g:i a", strtotime($userData["Joined"])); ?></span>
                                        </div>

                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="full_name" type="text" value="<?php echo $userData["Name"]; ?>" placeholder="John Wick" />
                                            <label for="full_name">Full Name</label>
                                        </div>
                                            
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="user_phone" type="text" value="<?php echo $userData["Phone"]; ?>" placeholder="Phone" />
                                            <label for="user_phone">Phone</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="user_gender" type="text" value="<?php echo setGender($userData["Gender"]); ?>" placeholder="Gender" disabled/>
                                            <label for="user_gender">Gender</label>
                                        </div>
                                        <div class="form-floating mb-3">
                                            <input class="form-control" id="user_bday" type="date" value="<?php echo $userData["Birthday"]; ?>" disabled/>
                                            <label for="user_bday">Birthday</label>
                                        </div>

                                        <button type="submit" id="update_profile" data-profile="<?php echo $userData["ID"]; ?>" class="btn btn-outline-primary btn-sm">Update Profile</button>
                                    </form>
                                </div>

                                <div class="tab-pane" id="account">
                                    <h6>ACCOUNT SETTINGS</h6>
                                    <hr>
                                    <form>
                                        <div class="form-group">
                                        <label class="d-block text-danger">Delete Account</label>
                                            <p class="text-muted font-size-sm">Once you delete your account, there is no going back. Please be certain.</p>
                                        </div>
                                        <button type="submit" id="delete_account" data-account="<?php echo $userData["ID"]; ?>" class="btn btn-danger">Delete Account</button>
                                    </form>
                                </div>

                                <div class="tab-pane" id="security">
                                    <h6>SECURITY SETTINGS</h6>
                                    <hr>
                                    <form>
                                        <div class="form-group">
                                            <label class="d-block">Change Password</label>
                                            <input type="password" id="old_password" class="form-control" placeholder="Enter your old password">
                                            <input type="password" id="new_password" class="form-control mt-1" placeholder="New password">
                                            <input type="password" id="cf_password" class="form-control mt-1" placeholder="Confirm new password">
                                            <p class="small text-muted mt-2">Changing your password will log you out, after that you need to login again to confirm the process.</p>
                                        </div>
                                        <button type="submit" id="update_password" data-account="<?php echo $userData["ID"]; ?>" class="btn btn-outline-primary btn-sm my-2">Update password</button>
                                    </form>
                                    <hr>
                                    <form>
                                        <div class="form-group">
                                            <label class="d-block">Two Factor Authentication</label>
                                            <button class="btn btn-info" type="button">Enable two-factor authentication</button>
                                            <p class="small text-muted mt-2">Two-factor authentication adds an additional layer of security to your account by requiring more than just a password to log in.</p>
                                        </div>
                                    </form>
                                    <hr>
                                    <form>
                                        <div class="form-group mb-0">
                                            <label class="d-block">Sessions</label>
                                            <p class="font-size-sm text-secondary">This is a list of devices that have logged into your account. Revoke any sessions that you do not recognize.</p>
                                            <?php 
                                            $user_id = returnID();
                                            $query = mysqli_query($SQL, "SELECT * FROM sessions WHERE User='$user_id' ORDER BY ID DESC");
                                            if (mysqli_num_rows($query) > 0)
                                            {
                                                while ($session = mysqli_fetch_assoc($query))
                                                {
                                                    $country = explode(",", $session["Location"]);
                                                ?>
                                                    <ul class="list-group list-group-sm my-1">
                                                        <li class="list-group-item has-icon">
                                                            <div>
                                                                <h6 class="mb-0"><?php echo $session["Location"]; ?> - <?php echo $session["IP"]; ?></h6>
                                                                <small class="text-muted">Your current session seen in <?php echo $country[1]; ?></small>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                <?php }
                                            }
                                            ?>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane" id="notification" style="user-select: none;">
                                    <h6>NOTIFICATION SETTINGS</h6>
                                    <hr>
                                    <form>
                                        <div class="form-group">
                                            <label class="d-block mb-0">Security Alerts</label>
                                            <div class="small text-muted mb-3">Receive security alert notifications via email</div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="setting1" checked="">
                                                <label class="custom-control-label" for="setting1">Email each time a vulnerability is found</label>
                                            </div>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="setting2" checked="">
                                                <label class="custom-control-label" for="setting2">Email each time when my account login with different approach</label>
                                            </div>
                                        </div>
                                        <div class="form-group mb-2 mt-4">
                                            <label class="d-block mt-2 mb-2">SMS Notifications</label>
                                            <ul class="list-group list-group-sm">
                                                <li class="list-group-item has-icon">
                                                    <input type="checkbox" class="custom-control-input" id="setting3" checked="">
                                                    <label class="custom-control-label" for="setting3">Comments</label>
                                                </li>
                                                <li class="list-group-item has-icon">
                                                    <input type="checkbox" class="custom-control-input" id="setting4" checked="">
                                                    <label class="custom-control-label" for="setting4">Updates from people</label>
                                                </li>
                                                <li class="list-group-item has-icon">
                                                    <input type="checkbox" class="custom-control-input" id="setting5" checked="">
                                                    <label class="custom-control-label" for="setting5">Reminders</label>
                                                </li>
                                                <li class="list-group-item has-icon">
                                                    <input type="checkbox" class="custom-control-input" id="setting6" checked="">
                                                    <label class="custom-control-label" for="setting6">Events</label>
                                                </li>
                                                <li class="list-group-item has-icon">
                                                    <input type="checkbox" class="custom-control-input" id="setting7" checked="">
                                                    <label class="custom-control-label" for="setting7">Newsletter</label>
                                                </li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
  	</body>
  	<?php include 'elements/scripts.php'; ?>
</html>