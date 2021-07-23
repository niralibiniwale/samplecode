<?php 
    // require 'dbconnection.php';

    include 'header.php';

    if(isset($_SESSION['login_id'])){
        header('Location: userlist.php');
        exit;
    }

    require 'google-api/vendor/autoload.php';

    // Creating new google client instance
    $client = new Google_Client();

    // Enter your Client ID
    $client->setClientId('1025458327849-3bd5ifgftkm2oc97gkgub5dqh3b9resb.apps.googleusercontent.com');
    // Enter your Client Secrect
    $client->setClientSecret('JkrqLkJO5516FLn0DI8xOASc');
    // Enter the Redirect URL
    $client->setRedirectUri('http://localhost/sample_admin/index.php');

    // Adding those scopes which we want to get (email & profile Information)
    $client->addScope("email");
    $client->addScope("profile");
?>
    <div class="divContainerForm">
        <img src="assets/images/user-removebg-preview.png" class="user-center" />
        <div class="divInnerContainerForm">
            <div class="row">
                <div class="col-12">
                    <form class="" action="login.php" method="post">
                        <?php
                            if (isset($_SESSION['error'])) {
                        ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php
                                    if (isset($_SESSION['error'])) {
                                        echo $_SESSION['error'];
                                        unset($_SESSION['error']);
                                    }
                                ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                            }
                        ?>
                        <div class="mb-3 row">
                            <!-- <label for="txtemailoruser" class="col-sm-2 col-form-label">Email or Username <span class="errordisplay">*</span></label> -->
                            <div class="col-sm-12">
                                <input type="text" class="form-control" name="txtemailoruser" id="txtemailoruser" required placeholder="Email / Username">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <!-- <label for="txtpassword" class="col-sm-2 col-form-label">Password <span class="errordisplay">*</span></label> -->
                            <div class="col-sm-12">
                                <input type="password" class="form-control" name="txtpassword" id="txtpassword" required placeholder="Password">
                            </div>
                        </div>
                        <div class="d-grid gap-2">
                            <input type="submit" name="btnsubmit" value="Login" class="btn btn-outline-dark btn-lg">
                        </div>
                        <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-12 socialoption">
                    <hr><p class="">Or</p><hr>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                        if(isset($_GET['code'])):

                            $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);

                            if(!isset($token["error"])){

                                $client->setAccessToken($token['access_token']);

                                // getting profile information
                                $google_oauth = new Google_Service_Oauth2($client);
                                $google_account_info = $google_oauth->userinfo->get();

                                // Storing data into database
                                $id = mysqli_real_escape_string($conn, $google_account_info->id);
                                $full_name = mysqli_real_escape_string($conn, trim($google_account_info->name));
                                $email = mysqli_real_escape_string($conn, $google_account_info->email);
                                $profile_pic = mysqli_real_escape_string($conn, $google_account_info->picture);

                                // checking user already exists or not
                                $sql = "SELECT * FROM `user` WHERE `google_id`='$id'";
                                $get_user = mysqli_query($conn, $sql);

                                if(mysqli_num_rows($get_user) > 0) {
                                    while($row = mysqli_fetch_assoc($get_user)) {
                                        $validuser = $row['Username'];
                                        $_SESSION['valid'] = $validuser;
                                        $_SESSION['name'] = $row['Name'];
                                        $_SESSION['id'] = $row['ID'];
                                        header('Location: userlist.php');
                                        exit;
                                    }

                                } else {
                                    $date = date('Y-m-d H:i:s');

                                    // if user not exists we will insert the user
                                    $sql = "INSERT INTO `user`(`Name`,`google_id`,`profile_image`,`Email`,`Username`,`created_date`) VALUES('$full_name','$id','$profile_pic','$email','$email','$date')";

                                    $insert = mysqli_query($conn, $sql);

                                    if($insert){
                                        $sql = "SELECT * FROM `user` WHERE `google_id`='$id'";
                                        $get_user = mysqli_query($conn, $sql);
                                        if(mysqli_num_rows($get_user) > 0) {
                                            while($row = mysqli_fetch_assoc($get_user)) {
                                                $validuser = $row['Username'];
                                                $_SESSION['valid'] = $validuser;
                                                $_SESSION['name'] = $row['Name'];
                                                $_SESSION['id'] = $row['ID'];
                                                header('Location: userlist.php');
                                                exit;
                                            }
                            
                                        }
                                    }
                                    else{
                                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                                        echo "Sign up failed!(Something went wrong).";
                                    }

                                }

                            }
                            else{
                                header('Location: index.php');
                                exit;
                            }
                            
                        else: 
                            // Google Login Url = $client->createAuthUrl(); 
                    ?>
                        <a class="login-btn" href="<?php echo $client->createAuthUrl(); ?>"><img src="assets/images/googlesignin.png" class="mx-auto d-block" /></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
<?php include 'footer.php'; ?>