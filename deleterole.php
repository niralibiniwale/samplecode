<?php
    session_start(); 

    include 'dbconnection.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $roleid = $_GET['roleid'];
    echo $userid;
    $sql = "DELETE FROM `Role` WHERE `ID`= ". $roleid;
    

    if (mysqli_query($conn, $sql)) {
        $_SESSION['success'] = 'Success: Role deleted successfully.';
        header("Location: rolelist.php");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    mysqli_close($conn);
?>