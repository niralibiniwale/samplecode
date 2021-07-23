<?php
    session_start(); 

    include 'dbconnection.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $userid = $_GET['userid'];
    echo $userid;
    $sql = "DELETE FROM `user` WHERE `ID`= ". $userid;
    

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = 'Success: User deleted successfully.';
        header("Location: userlist.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
?>