<?php
    session_start();

    include 'dbconnection.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_POST['txtname']) && isset($_POST['txtemail']) && isset($_POST['txtusername']) && isset($_POST['txtpassword']) && isset($_POST['drprole'])){
        $name = $_POST['txtname'];
        $email = $_POST['txtemail'];
        $username = $_POST['txtusername'];
        $password = $_POST['txtpassword'];
        $role = $_POST['drprole'];
        $date = date('Y-m-d H:i:s');

        // Securing password using password_hash
        $secure_pass = password_hash($password, PASSWORD_BCRYPT);

        if(!empty($_FILES["txtprofilepic"]['name'])){
            $profileImageName = time() . '-' . $_FILES["txtprofilepic"]["name"];
            // For image upload
            $target_dir = "assets/images/profile_picture/";
            $target_file = $target_dir . basename($profileImageName);

            if (empty($error)) {
                if(move_uploaded_file($_FILES["txtprofilepic"]["tmp_name"], $target_file)) {
                    if(!empty($_POST['useridhidden'])){
                        $sql = "UPDATE `user`
                        SET `Name` = '$name', `profile_image` = '$target_file',`Role_ID` = '$role',`updated_date` = '$date'
                        WHERE `ID` = ". $_POST['useridhidden'];
                        $success = 'Success: User updated successfully.';
                    } else{
                        $sql = "INSERT INTO `user` (`Name`, `profile_image`, `Email`, `Username`, `Password`, `Role_ID`, `created_date`)
                        VALUES ('$name', '$target_file', '$email', '$username', '$secure_pass', '$role' , '$date')";
                        $success = 'Success: User added successfully.';
                    }
                }
            }
        } else {
            if(!empty($_POST['useridhidden'])){
                $sql = "UPDATE `user`
                SET `Name` = '$name', `Role_ID` = '$role',`updated_date` = '$date'
                WHERE `ID` = ". $_POST['useridhidden'];
                $success = 'Success: User updated successfully.';
            } else{
                $sql = "INSERT INTO `user` (`Name`, `Email`, `Username`, `Password`, `Role_ID`, `created_date`)
                VALUES ('$name', '$email', '$username', '$secure_pass', '$role' , '$date')";
                $success = 'Success: User added successfully.';
            }
        }

        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = $success;
            header("Location: userlist.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>