
<?php 
    session_start();
    
    if(!isset($_SESSION['valid'])) {
        header('Location: index.php');
    }

    include 'header.php';

    if(isset($_GET['roleid'])){
        $role_id = $_GET['roleid'];
        $sql = "SELECT * FROM Role WHERE `ID` = " . $role_id;
        $query = mysqli_query($conn, $sql);
        if (mysqli_num_rows($query) > 0) {
            while($row = mysqli_fetch_assoc($query)) {
                $role_name = $row['Name'];
            }
        }
    }
?>
    <div class="row justify-content-center">
        <div class="col-6">
            <form class="" action="rolesave.php" method="post">
                <input type="hidden" value="<?php echo $role_id; ?>" name="txtroleid" />
                <div class="mb-3 row">
                    <label for="txtname" class="col-sm-2 col-form-label">Name</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="txtname" id="txtname" value="<?php echo $role_name; ?>">
                    </div>
                </div>
                <div class="d-grid gap-2 col-6 mx-auto">
                    <input type="submit" name="btnsubmit" value="Submit" class="btn btn-dark btn-lg">
                </div>
            </form>
        </div>
    </div>
    

<?php include 'footer.php'; ?>