<?php
// session_start();

if (isset($_POST["modal"]))
{
    require_once("../config.php");

    $modal = $_POST["modal"];

    if ($modal == "modalLogin")
    { ?>
        <div class="modal fade show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Sign In</h5>
                        <span id="closeModal" class="btn-border btn-modal-close">X</span>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input class="form-control" id="email" type="email" placeholder="name@example.com" value="<?php if (isset($_COOKIE["email"])) { echo $_COOKIE["email"]; } ?>" />
                                <label for="email">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="password" type="password" placeholder="Password" value="<?php if (isset($_COOKIE["password"])) { echo $_COOKIE["password"]; } ?>" />
                                <label for="password">Enter password</label>
                            </div>
                            <div class="form-check form-switch mx-2">
                                <input class="form-check-input" type="checkbox" id="rememberMe" <?php echo(isset($_COOKIE["email"])) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="rememberMe" style="user-select: none;">Remember me</label>
                                <a href="reset-password" class="float-end">Forgot Password?</a>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="closeModal">Close</button>
                            <button type="submit" id="btnSignIn" class="btn btn-primary btn-custom">Sign In</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }
    if ($modal == "modalRegister")
    { ?>
        <div class="modal fade show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Sign Up</h5>
                        <span id="closeModal" class="btn-border btn-modal-close">X</span>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="user_email" placeholder="name@example.com">
                                <label for="user_email">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" class="form-control" id="user_pass" placeholder="password">
                                <label for="user_pass">Password</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="user_name" placeholder="John Wick">
                                <label for="user_name">Full Name</label>
                            </div>
                            <div class="form-check form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="user_gender">
                                <label class="form-check-label" for="user_gender" style="user-select: none;">Check the switch if you're Male.</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="user_phone" placeholder="Phone Number">
                                <label for="user_phone">Phone Number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="user_bday" type="date"/>
                                <label for="user_bday">Birthday</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="closeModal">Close</button>
                            <button type="submit" id="btnSignUp" class="btn btn-primary btn-custom">Sign Up</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }
    if ($modal == "modalDeleteAcc")
    { ?>
        <div class="modal fade show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Deactivate my account</h5>
                        <span id="closeModal" class="btn-border btn-modal-close">X</span>
                    </div>
                    <form>
                        <div class="modal-body">
                            <p>You are about to deactive your account, please choose wisley if you want to continue!</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light" id="closeModal">Close</button>
                            <button type="submit" id="btn_delete_account" data-acc-id="<?php echo $_POST['account']; ?>" class="btn btn-outline-danger">Delete</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }
    // new modal load here
}
else { redirect("../home"); }
?>