<?php
    // session_start();

    include 'dbconnection.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_POST['txtemailoruser']) && isset($_POST['txtpassword'])){
        $name = $_POST['txtemailoruser'];
        $password = $_POST['txtpassword'];

        $sql = "SELECT * FROM user WHERE `Email` = '$name' OR `Username` = '$name'";

        $query = mysqli_query($conn, $sql);

        if (mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                if (password_verify($password, $row['Password'])) {
                    $validuser = $row['Username'];
                    $_SESSION['valid'] = $validuser;
                    $_SESSION['name'] = $row['Name'];
                    $_SESSION['id'] = $row['ID'];

                    if(isset($_SESSION['valid'])) {
                        header("Location: userlist.php");			
                    }
                } else {
                    $_SESSION['error'] = 'Error: Wrong Password, Try again.';
                    header("Location: index.php");
                }
            }
        } else {
            $_SESSION['error'] = 'Error: Wrong Username/Email, Try again.';
            header("Location: index.php");
        }
    }

    mysqli_close($conn);
?>