<?php
 // Start the session
 require_once 'header.php';
 include('../connection.php');
 
 if (isset($_POST['delete'])) {
     $delete = $_POST['delete'];
     $delete_num = "DELETE FROM tbl_staff WHERE id='$delete'";
     $delete_id = mysqli_query($mysqli, $delete_num);
 
     if ($delete_id) {
         $_SESSION['alert'] = "Record deleted successfully."; // Set success message
     } else {
         $_SESSION['alert'] = "Failed to delete the record."; // Set error message
     }
     header('Location: staff.php');
     exit();
 }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet"href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous"/>
    <link rel="stylesheet" href="..\style.css">
    <title>Staff Information Page!</title>
</head>

<body class="bg-image"   style="background-size: 200vh; background-image:url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">   

<?php
    include ('staff-index.php');
?>

<div class="container-fluid py-4">
    
<div class="container-fluid bg-3 text-center"> 
    <a href="staff-form.php" class="btn btn-info pull-right" style='margin-top:-10px; margin-right:10px;'>
    <span class="glyphicon glyphicon-plus-sign"></span>Add Record</a>
</div>

 <div class="panel panel-info" style="margin-top:10px">
 <h4 class="text-info font-weight-bold text-uppercase">staff information</h4>
                <script>
                    // Check for session alert and display it
                    <?php if (isset($_SESSION['alert'])): ?>
                        alert("<?php echo $_SESSION['alert']; ?>");
                        <?php unset($_SESSION['alert']); // Clear the message after displaying ?>
                    <?php endif; ?>
                </script>
                
    <div class="panel-body">
    <?php
                include('../connection.php');

                $select = "SELECT * FROM tbl_staff ";
                
                $select_from = mysqli_query($mysqli,$select);
            ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr class="active">
                        <th>Id</th>
                        <th>Staff Id</th>
                        <th>Designation</th>
                        <th>Name</th>
                        <th>Gender</th>
                        <th>Mobile No</th>
                        <th>Email</th>
                        <th>School Name</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Update At</th>
                        <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if(mysqli_num_rows($select_from ) >0){
                    
                    while($query= mysqli_fetch_assoc($select_from)){
                    
                    ?>
                        <tr align="center">
                            <td><?php echo $query['id']; ?></td>
                            <td><?php echo $query['staff_id']; ?></td>
                            <td><?php echo $query['designation']; ?></td>
                            <td><?php echo $query['name']; ?></td>
                            <td><?php echo $query['gender']; ?></td>
                            <td><?php echo $query['mobile_no']; ?></td>
                            <td><?php echo $query['email']; ?></td>
                            <td><?php echo $query['school_name']; ?></td>
                            <td><?php echo $query['address']; ?></td>
                            <td>
                                <img src="<?php echo "./imagess/".$query['school_name']."/staff"."/".$query['image_name']; ?>"  width="75" height="75" alt="staff_image">
                            </td>
                            <td><?php echo $query['updated_at']; ?></td>


                            <td>
                            <form method="post">
                                    <a href="staff-edit.php?id=<?php echo $query['id']; ?>" class="btn btn-success mt-3 mx-3" style="border-radius: 10px;"><i class='fas fa-edit' style="font-size: 20px;"></i></a>
                                    <button type="submit" onClick="return confirm('Please confirm deletion');" 
                                    class="btn btn-danger mt-3" style="border-radius: 10px;" name="delete" value="<?php echo $query['id']; ?>"><i class='fas fa-trash' style="font-size: 20px;"></i></button>
                                </form>
                            </td>
                        </tr>  
                        <?php
                            }
                        
                            }else{                    
                        ?> 
                            <tr>
                                <td class='text-center  text-danger' colspan='12'>Record Not Found</td>
                            </tr>
                        <?php
                        }
                        ?>
                    </tbody>
                </table>
        </div>
    </div>
  </div>
</div>
</div>
</body>
</html>