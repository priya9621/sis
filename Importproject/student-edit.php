<?php
require_once 'header.php';
include('../connection.php');

$id = $_GET['id'];

$edit = "SELECT * FROM tbl_student WHERE id='$id'";
$student_edit = mysqli_query($mysqli, $edit);
if (mysqli_num_rows($student_edit) > 0) {
    while ($row = mysqli_fetch_array($student_edit)) {
?>

<?php
if (isset($_POST['update_btn'])) {
    $roll_no = $_POST['rollno'];
    $name = $_POST['name'];
    $father_name = $_POST['father'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $class = $_POST['class'];
    $section = $_POST['section'];
    $mobile_no = $_POST['mobileno'];
    $class_teacher_name = $_POST['teacher'];
    $school_name = $_POST['school'];
    $address = $_POST['address'];

    $old_image = $row['image_name']; // existing image from database
    $new_image = "SCHOOL-" . $school_name . "-NAME-" . $name . "-ROLL No-" . $roll_no ."-CLASS-" . $class ."-SECTION-" . $section . '.' . pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION); // new uploaded image

    $upload_dir = "./imagess/$school_name/student/";

    // Ensure the upload directory exists
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true); // Create directory if it doesn't exist
    }

    // If a new image is uploaded
    if ($_FILES['image']['error'] == 0) {
        move_uploaded_file($_FILES['image']['tmp_name'], $upload_dir . $new_image);

        // Delete old image if it exists
        if (file_exists($upload_dir . $old_image)) {
            unlink($upload_dir . $old_image);
        }
        $update_filename = $new_image; // Use the new image name
    } else {
        // No new image uploaded
        $update_filename = $old_image;
    }

    // Update query with image field
    $query = "UPDATE tbl_student SET roll_no='$roll_no', name='$name', father_name='$father_name', dob='$dob', gender='$gender', class='$class', section='$section', mobile_no='$mobile_no', class_teacher_name='$class_teacher_name', school_name='$school_name', address='$address', image_name='$update_filename' WHERE id='$id'";
    $update = mysqli_query($mysqli, $query);

    if ($update) {
        $_SESSION['alert'] = "Student updated successfully!";
        header('Location: student.php'); // Redirect on success
        exit();
    } else {
        $_SESSION['alert'] = "Data update failed!";
        header('Location: student-edit.php?id=' . $id); // Redirect on failure
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="./js-jquery.js"></script>
    <script src="./student-update-validation.js"></script>
    <title>Edit Student</title>
</head>
<body class="bg-image" style="background-size: 200vh; background-image:url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">   

<div class="container">
    <div class="panel panel-danger">
        <div class="panel-heading">
            <h4 class="text-info text-uppercase text-center">Update Student</h4>
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
                    <label class="control-label col-sm-5">Roll No:</label>
                    <div class="form-group col-sm-1">
                        <input class="form-control" type="text" value="<?php echo $row['roll_no']?>" name="rollno" required>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label col-sm-5">Name:</label>
                    <div class="form-group col-sm-3">
                        <input class="form-control" type="text" value="<?php echo $row['name']?>" name="name" required>
                    </div>
                </div> 

                <div class="form-group">
                    <label class="control-label col-sm-5">Father's Name:</label>
                    <div class="form-group col-sm-3">
                        <input class="form-control" type="text" value="<?php echo $row['father_name']?>" name="father" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5">Date of Birth:</label>
                    <div class="form-group col-sm-3">
                        <input class="form-control" type="date" value="<?php echo $row['dob']?>" name="dob" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5" for="gender">Gender:</label>
                    <div class="form-group col-sm-2">
                        <select class="form-control" name="gender" required>
                            <option value="">Select Gender</option>
                            <option value="male" <?php echo ($row['gender'] == 'male') ? 'selected' : ''; ?>>Male</option>
                            <option value="female" <?php echo ($row['gender'] == 'female') ? 'selected' : ''; ?>>Female</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5">Class:</label>
                    <div class="form-group col-sm-2">
                        <input class="form-control" type="text" value="<?php echo $row['class']?>" name="class" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5">Section:</label>
                    <div class="form-group col-sm-2">
                        <input class="form-control" type="text" value="<?php echo $row['section']?>" name="section" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5">Mobile Number:</label>
                    <div class="form-group col-sm-2">
                        <input class="form-control" type="text" value="<?php echo $row['mobile_no']?>" name="mobileno" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5">Class Teacher Name:</label>
                    <div class="form-group col-sm-3">
                        <input class="form-control" type="text" value="<?php echo $row['class_teacher_name']?>" name="teacher" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5">School Name:</label>
                    <div class="form-group col-sm-3">
                        <input class="form-control" type="text" value="<?php echo $row['school_name']?>" name="school" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5">Address:</label>
                    <div class="form-group col-sm-3">
                        <textarea rows="5" cols="2" class="form-control" name="address" required><?php echo $row['address']?></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5">Upload Image:</label>
                    <input type="file" name="image">
                    <input type="hidden" name="old_image" value="<?php echo $row['image_name']; ?>" />
                </div>

                <div class="form-group">
                    <label class="control-label col-sm-5"></label>
                    <div class="col-sm-3">
                        <a href="student.php" class="btn btn-danger mx-3" style="border-radius: 10px;">Cancel</a>
                        <input type="submit" class="btn btn-warning" style="border-radius: 10px;" name="update_btn" value="Update">
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