<?php
    session_start();

    include 'dbconnection.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if(isset($_POST['txtname'])){
        $name = $_POST['txtname'];
        $date = date('Y-m-d H:i:s');
        if(!empty($_POST['txtroleid'])){
            $sql = "UPDATE `Role`
            SET `Name` = '$name', `updated_date` = '$date'
            WHERE `ID` = ". $_POST['txtroleid'];
            $success = 'Success: Role updated successfully.';
        } else{
            $sql = "INSERT INTO `Role` (`Name`, `created_date`)
            VALUES ('$name', '$date')";
            $success = 'Success: Role added successfully.';
        }
        
        if (mysqli_query($conn, $sql)) {
            $_SESSION['success'] = $success;
            header("Location: rolelist.php");
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }

    mysqli_close($conn);
?>