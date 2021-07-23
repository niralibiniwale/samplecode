<?php 
    // session_start(); 

    // include 'dbconnection.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    include 'header.php';
?>
    <div class="d-grid gap-2 d-md-flex justify-content-md-end">
        <a href="user.php" class="btn btn-outline-dark btn-lg">Add User</a>
    </div>
    <?php
        if (isset($_SESSION['success'])) {
    ?>
        <div class="successdisplay alert alert-success alert-dismissible fade show" role="alert">
            <?php
                if (isset($_SESSION['success'])) {
                    echo $_SESSION['success'];
                    unset($_SESSION['success']);
                }
            ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        }
    ?>
    <div class="table-responsive">
        <table class="table table-dark table-striped userTable" id="table" data-toggle="table" data-search="true" data-pagination="true">
            <thead>
                <tr>
                    <th scope="col" data-sortable="true">#</th>
                    <th scope="col" data-sortable="false">Profile Picture</th>
                    <th scope="col" data-sortable="true">Name</th>
                    <th scope="col" data-sortable="true">Email</th>
                    <th scope="col" data-sortable="true">Role</th>
                    <th scope="col" data-searchable="false">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM user WHERE ID != ". $_SESSION['id'];
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        $i=1;
                        while($row = mysqli_fetch_assoc($query)) {
                            $sql_role = "SELECT * FROM Role";
                            $query_role = mysqli_query($conn, $sql_role);
                            
                            echo '<tr>';
                                echo '<th scope="row">';
                                echo $i;
                                echo '</th>';
                                echo '<td>';
                                ?>
                                <img src="<?php echo empty($row['profile_image']) ? 'assets/images/user-default.jpg' : $row['profile_image']; ?>" />
                                <?php
                                echo '</td>';
                                echo '<td>';
                                echo $row['Name'];
                                echo '</td>';
                                echo '<td>';
                                echo $row['Email'];
                                echo '</td>';
                                
                                echo '<td>';
                                        // print_r[$row_role];
                                        if (mysqli_num_rows($query_role) > 0) {
                                            while($row_role = mysqli_fetch_assoc($query_role)) {
                                                if($row['Role_ID'] == $row_role['ID']){
                                                    echo $row_role['Name'];
                                                } 
            
                                                // echo '<pre>';
                                                // print_r($row_role);
                                                // echo '</pre>';                                        
                                            }
                                        }
                                        // echo $row['Role_ID'];
                                        echo '</td>';
                                echo '<td>';
                                echo '<a href="user.php?userid='.$row['ID'].'"><i class="fas fa-user-edit"></i></a>';
                                echo "<a onClick=\"javascript: return confirm('Please confirm deletion');\" href='deleteuser.php?userid=".$row['ID']."' class='ms-2'><i class='fas fa-user-times'></i></a>"; //use double quotes for js inside php!
                                //echo '<a href="deleteuser.php?userid='.$row['ID'].'" class="ms-2" onClick=\"return 
                                //confirm("are you sure you want to delete??");\"><i class="fas fa-user-times"></i></i></a>';
                                //echo $row['Role'];
                                echo '</td>';
                            echo '</tr>';
                            $i++;
                        }
                    }
                ?>
            </tbody>
        </table>
    </div>
<?php include 'footer.php'; ?>