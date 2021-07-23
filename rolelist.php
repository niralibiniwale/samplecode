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
        <a href="role.php" class="btn btn-outline-dark btn-lg">Add Role</a>
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
        <table class="table table-dark table-striped" id="table" data-toggle="table" data-search="true" data-pagination="true">
            <thead>
                <tr>
                    <th scope="col" data-sortable="true">#</th>
                    <th scope="col" data-sortable="true">Name</th>
                    <th scope="col" data-searchable="false">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql = "SELECT * FROM Role";
                    $query = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($query) > 0) {
                        $i=1;
                        while($row = mysqli_fetch_assoc($query)) {
                            echo '<tr>';
                                echo '<th scope="row">';
                                echo $i;
                                echo '</th>';
                                echo '<td>';
                                echo $row['Name'];
                                echo '</td>';
                                echo '<td>';
                                echo '<a href="role.php?roleid='.$row['ID'].'"><i class="fas fa-user-edit"></i></a>';
                                echo "<a onClick=\"javascript: return confirm('Please confirm deletion');\" href='deleterole.php?roleid=".$row['ID']."' class='ms-2'><i class='fas fa-user-times'></i></a>";
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