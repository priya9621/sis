<?php
require_once 'header.php';
include ('../connection.php');

$id = $_GET['id'];

$edit = "SELECT * FROM tbl_staff WHERE id='$id'";
$staff_edit = mysqli_query($mysqli, $edit);
if (mysqli_num_rows($staff_edit) > 0) {
    while ($row = mysqli_fetch_array($staff_edit)) {
?>

<?php
if (isset($_POST['update_btn'])) {
    $update_id = $_POST['id'];
    $staff_id = $_POST['staffid'];
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $gender = $_POST['gender'];
    $mobile_no = $_POST['mobileno'];
    $email = $_POST['email'];
    $school_name = $_POST['school'];
    $address = $_POST['address'];

    // Handle file upload if an image is provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
        $allowedfiletypes = array("jpg"=>"image/jpg", "jpeg"=>"image/jpeg", "gif"=>"image/gif", "png"=>"image/png");
        
        // Ensure a folder exists for this school's staff images
        $folderPath = "./imagess/$school_name/staff/";
        if (!file_exists($folderPath)) {
            mkdir($folderPath, 0777, true); // Create the directory if it doesn't exist
        }

        // Prepare a unique filename
        $filename = "SCHOOL-".$school_name."-NAME-".$name."-Designation-".$designation."-MOBILENO-".$mobile_no.'.'.pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);

        // Upload the image
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $folderPath.$filename)) {
            // Save the filename in the database as well
            $query = "UPDATE tbl_staff SET staff_id='$staff_id', name='$name', designation='$designation', gender='$gender', mobile_no='$mobile_no', email='$email', school_name='$school_name', address='$address', image_name='$filename' WHERE id='$id'";
            $update = mysqli_query($mysqli, $query);

            if ($update) {
                $_SESSION['alert'] = "Staff updated successfully!";
                header('Location: staff.php'); // Redirect on success
                exit();
            } else {
                $_SESSION['alert'] = "Data update failed!";
                header('Location: staff-edit.php?id=' . $id); // Redirect on failure
                exit();
            }
        } else {
            $_SESSION['alert'] = "Image upload failed!";
            header('Location: staff-edit.php?id=' . $id); // Redirect on failure
            exit();
        }
    } else {
        // If no image is uploaded, update without the image field
        $query = "UPDATE tbl_staff SET staff_id='$staff_id', name='$name', designation='$designation', gender='$gender', mobile_no='$mobile_no', email='$email', school_name='$school_name', address='$address' WHERE id='$id'";
        $update = mysqli_query($mysqli, $query);

        if ($update) {
            $_SESSION['alert'] = "Staff updated successfully!";
            header('Location: staff.php'); // Redirect on success
            exit();
        } else {
            $_SESSION['alert'] = "Data update failed!";
            header('Location: staff-edit.php?id=' . $id); // Redirect on failure
            exit();
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Update Staff</title>
    <script src="./js-jquery.js"></script>
    <script src="./staff-update-validation.js"></script>
</head>
<body class="bg-image" style="background-size: 200vh; background-image:url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">   

<div class="container">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h4 class="text-info text-uppercase text-center">Update Staff</h4>
        </div>

        <!-- Success/Error Alert -->
        <?php if (isset($_SESSION['alert'])): ?>
            <div class="alert alert-danger text-center">
                <?php echo $_SESSION['alert']; ?>
                <?php unset($_SESSION['alert']); // Clear the message after displaying ?>
            </div>
        <?php endif; ?>

        <form class="form-horizontal container" method="post" enctype="multipart/form-data">
            <div class="panel-body">

                <div class="form-group">
                    <label class="control-label col-sm-5">Staff Id :</label>
                    <div class="form-group col-sm-1">
                        <input class="form-control" type="text" value="<?php echo $row['staff_id']?>" name="staffid" id="staff" required>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label col-sm-5">Name :</label>
                    <div class="form-group col-sm-3">
                        <input class="form-control" type="text" value="<?php echo $row['name']?>" name="name" id="name" required>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label col-sm-5">Designation :</label>
                    <div class="form-group col-sm-2">
                        <input class="form-control" type="text" value="<?php echo $row['designation']?>" name="designation" id="des" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5" for="gender">Gender :</label>
                    <div class="form-group col-sm-2">
                        <select class="form-control" name="gender" id="gen" required>
                            <option value="">Select Gender</option>
                            <option value="male" <?php echo ($row['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                            <option value="female" <?php echo ($row['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label col-sm-5">Mobile Number :</label>
                    <div class="form-group col-sm-2">
                        <input class="form-control" type="Mobileno" value="<?php echo $row['mobile_no']?>" name="mobileno" id="mobno" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5">Email :</label>
                    <div class="form-group col-sm-3">
                        <input class="form-control" type="email" value="<?php echo $row['email']?>" name="email" id="email" required>
                    </div>
                </div>
                
                <div class="form-group">
                    <label class="control-label col-sm-5">School Name :</label>
                    <div class="form-group col-sm-3">
                        <input class="form-control" type="text" value="<?php echo $row['school_name']?>" name="school" id="school" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5">Address :</label>
                    <div class="form-group col-sm-3">
                        <textarea rows="5" cols="2" class="form-control" name="address" id="address" required><?php echo $row['address']?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5">Upload Image :</label>
                    <input type="file" name="image" id="image">
                    <input type="hidden" name="old_image" value="<?php echo $row['image_name']; ?>" />
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5"></label>
                    <div class="col-sm-3">
                        <a href="staff.php" class="btn btn-danger mx-3" style="border-radius: 10px;">Cancel</a>
                        <input type="submit" class="btn btn-warning" style="border-radius: 10px;" name="update_btn" id="btnupdate" value="Update">
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

<?php
    }
} else {
    echo "No data found for this ID";
}
?>
</body>
</html>