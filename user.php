
<?php 
    session_start();
    
    if(!isset($_SESSION['valid'])) {
        header('Location: index.php');
    }

    include 'header.php';

    if(isset($_GET['userid'])){
        $user_id = $_GET['userid'];
        $sql = "SELECT * FROM user WHERE `ID` = " . $_GET['userid'];
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $name = $row['Name'];
                $email = $row['Email'];
                $user_name = $row['Username'];
                $password = $row['Password'];
                $roleid = $row['Role_ID'];
                $googleid = $row['google_id'];
                $profileimage = $row['profile_image'];
            }
        }
    }
?>
    <div class="row justify-content-center">
        <div class="col-6">
            <form class="" action="usersave.php" method="post" enctype="multipart/form-data">
                <input type="hidden" name="useridhidden" value="<?php echo $user_id; ?>" />
                <div class="mb-3 row">
                    <label for="txtname" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txtname" id="txtname" value="<?php echo $name; ?>" required />
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="txtemail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="txtemail" id="txtemail" value="<?php echo $email; ?>" <?php echo empty($email) ? '' : 'readonly' ?> required />
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="txtusername" class="col-sm-2 col-form-label">Username</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txtusername" id="txtusername" value="<?php echo $user_name; ?>" <?php echo empty($user_name) ? '' : 'readonly' ?> required />
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="txtpassword" class="col-sm-2 col-form-label">Password</label>
                    <div class="col-sm-10">
                        <input type="password" class="form-control" name="txtpassword" id="txtpassword" value="<?php echo $password; ?>" <?php echo (empty($password) && empty($googleid)) ? '' : 'readonly' ?> required />
                    </div>
                </div>

                <div class="mb-3 row">
                    <label for="drprole" class="col-sm-2 col-form-label">Select Role</label>
                    <div class="col-sm-10">
                        <select class="form-select" name="drprole" id="drprole" aria-label="Default select example" required>
                            <option value="">Select Role</option>
                            <?php
                                $sql = "SELECT * FROM Role";
                                $query = mysqli_query($conn, $sql);
                                if (mysqli_num_rows($query) > 0) {
                                    while($row = mysqli_fetch_assoc($query)) {
                                        $role_id = $row['ID'];
                                        $role_name = $row['Name'];
                                        ?>
                                        <option value="<?php echo $role_id?>" <?php echo ($roleid == $role_id) ? "selected" : ""?>><?php echo $role_name?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="txtuserpicture" class="col-sm-2 col-form-label">Profile Picture</label>
                    <div class="col-sm-10">
                        <input type="file" class="form-control mb-3" name="txtprofilepic" id="txtprofilepic" accept="image/*" onChange="displayImage(this)" />
                        <img src="<?php echo empty($profileimage) ? 'assets/images/user-default.jpg' : $profileimage; ?>" onClick="triggerClick()" id="profileDisplay" name="profileDisplay" />
                    </div>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <input type="submit" name="btnsubmit" value="Submit" class="btn btn-dark btn-lg">
                </div>
                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
            </form>
        </div>
    </div>

<?php include 'footer.php'; ?>