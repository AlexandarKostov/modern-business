<?php
// session_start();


if (isset($_POST["modal"]))
{
    include_once('../include/mysql.php');
    include_once('../include/functions.php');

    $modal = $_POST["modal"];

    if ($modal == "editUser")
    { ?>
        <div class="modal fade show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <?php $setUser = $_POST['userID'];
                        $query = mysqli_query($SQL, "SELECT * FROM users WHERE ID='$setUser'");
                        if (mysqli_num_rows($query) > 0) { $setInfo = mysqli_fetch_assoc($query); } ?>
                        <h5 class="modal-title">Update profile for <strong><?php echo $setInfo["Name"]; ?></strong></h5>
                        <span id="closeModal" class="btn-border btn-modal-close">X</span>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="email" class="form-control" id="email" placeholder="name@example.com" value="<?php echo $setInfo["EMail"]; ?>" disabled>
                                <label for="email">Email address</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="name" placeholder="John Wick" value="<?php echo $setInfo["Name"]; ?>">
                                <label for="name">Full Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="ugender" placeholder="Gender" value="<?php echo($setInfo["Gender"] == 0) ? 'Male' : 'Female';  ?>" disabled>
                                <label for="ugender">Gender</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="pnumber" placeholder="Phone Number" value="<?php echo $setInfo["Phone"]; ?>">
                                <label for="pnumber">Phone Number</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input class="form-control" id="bday" type="date" value="<?php echo $setInfo["Birthday"]; ?>"/>
                                <label for="bday">Birthday</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check_access" <?php echo($setInfo["Admin"] == 1) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="check_access" style="user-select: none;">Enable or Disable user access.</label>
                            </div>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="check_approved" <?php echo($setInfo["Approved"] == 1) ? 'checked' : ''; ?>>
                                <label class="form-check-label" for="check_approved" style="user-select: none;">Enable or Disable user account.</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="closeModal">Close</button>
                            <button type="submit" data-user-id="<?php echo $_POST['userID']; ?>" id="btnSaveUser" class="btn btn-primary btn-custom">Save Changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }
    if ($modal == "insertTestimonial")
    { ?>
        <div class="modal fade show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Insert new testimonial</h5>
                        <span id="closeModal" class="btn-border btn-modal-close">X</span>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="testimonial_text" style="height: 140px !important; resize: none;"></textarea>
                                <label for="testimonial_text">Comments</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="testimonial_user" placeholder="John Wick">
                                <label for="testimonial_user">John Wick</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="testimonial_title" placeholder="CEO & Founder">
                                <label for="testimonial_title">CEO, programmer, self-employed ..</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="closeModal">Close</button>
                            <button type="submit" id="btn_insert_testimonial" class="btn btn-primary btn-custom">Insert</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }
    if ($modal == "editTestimonial")
    { ?>
        <div class="modal fade show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Edit existing testimonial</h5>
                        <span id="closeModal" class="btn-border btn-modal-close">X</span>
                    </div>
                    <form>
                        <?php 
                        $t_id = $_POST["t_id"];
                        $query = mysqli_query($SQL, "SELECT * FROM testimonial WHERE ID='$t_id'");
                        $tData = mysqli_fetch_assoc($query);
                        ?>
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <textarea class="form-control" placeholder="Leave a comment here" id="edit_testimonial_text" style="height: 140px !important; resize: none;"><?php echo $tData["Text"]; ?></textarea>
                                <label for="edit_testimonial_text">Comments</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="edit_testimonial_user" value="<?php echo $tData["Name"]; ?>" placeholder="John Wick">
                                <label for="edit_testimonial_user">John Wick</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="edit_testimonial_title" value="<?php echo $tData["Title"]; ?>" placeholder="CEO & Founder">
                                <label for="edit_testimonial_title">CEO, programmer, self-employed ..</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="closeModal">Close</button>
                            <button type="submit" id="btn_edit_testimonial" data-testimonial="<?php echo $tData["ID"]; ?>" class="btn btn-primary btn-custom">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }
    if ($modal == "addCategory")
    { ?>
        <div class="modal fade show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Insert new category</h5>
                        <span id="closeModal" class="btn-border btn-modal-close">X</span>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="category_name" placeholder="News">
                                <label for="category_name">Category name</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="closeModal">Close</button>
                            <button type="submit" id="btn_insert_category" class="btn btn-primary btn-custom">Insert category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }
    if ($modal == "addMember")
    { ?>
        <div class="modal fade show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Add new team member</h5>
                        <span id="closeModal" class="btn-border btn-modal-close">X</span>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="input-group">
                                <input type="file" class="form-control" id="member_avatar" accept="image/*">
                            </div>
                            <p class="ml-1 mb-3 text-muted small">Choose avatar</p>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="member_name" placeholder="John Wik">
                                <label for="member_name">Full Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="member_title" placeholder="Title">
                                <label for="member_title">Title</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger" id="closeModal">Close</button>
                            <button type="submit" id="btn_add_member" class="btn btn-primary btn-custom">Insert member</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }
    if ($modal == "editMember")
    { ?>
        <div class="modal fade show" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <?php 
                        $member = $_POST["member"];
                        $mQuery = mysqli_query($SQL, "SELECT * FROM team WHERE ID='$member'");
                        $setMember = mysqli_fetch_assoc($mQuery);
                        ?>
                        <h5 class="modal-title">Edit team member: <?php echo $setMember["Name"]; ?></h5>
                        <span id="closeModal" class="btn-border btn-modal-close">X</span>
                    </div>
                    <form>
                        <div class="modal-body">
                            <div class="input-group">
                                <input type="file" class="form-control" id="edit_member_avatar" accept="image/*">
                            </div>
                            <p class="ml-1 mb-3 text-muted small">Choose new avatar</p>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="edit_member_name" value="<?php echo $setMember["Name"]; ?>" placeholder="John Wik">
                                <label for="edit_member_name">Full Name</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="text" class="form-control" id="edit_member_title" value="<?php echo $setMember["Title"]; ?>" placeholder="Title">
                                <label for="edit_member_title">Title</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" data-member="<?php echo $setMember["ID"]; ?>" id="btn_delete_member" class="btn btn-outline-danger">Delete member</button>
                            <button type="submit" data-member="<?php echo $setMember["ID"]; ?>" id="btn_edit_member" class="btn btn-primary btn-custom">Save changes</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <?php }
    // new modal load here
}
else { redirect("../dashboard"); }
?>