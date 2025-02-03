<?php
require_once 'header.php';
include('../connection.php');

if (isset($_POST['submit'])) {
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

    // Check if an image file is uploaded
    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $allowedfiletypes = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
        $filetype = $_FILES["image"]["type"];
        $filename = $_FILES["image"]["name"];
        $filesize = $_FILES["image"]["size"];
        $maxsize = 5 * 1024 * 1024;

        $ext = pathinfo($filename, PATHINFO_EXTENSION);

        // Rename file based on student and school information
        $filename = "SCHOOL-" . $school_name . "-NAME-" . $name . "-ROLL-" . $roll_no . "-CLASS-" . $class . "-SECTION-" . $section . "." . $ext;

        // Check if directory exists, create it if not
        $dir = './imagess/' . $school_name . '/student/';
        if (!is_dir($dir)) {
            if (!mkdir($dir, 0777, true)) {
                die("Failed to create directory for images.");
            }
        }

        // Move the uploaded file to the target directory
        $uploadPath = $dir . $filename;
        if (!move_uploaded_file($_FILES["image"]["tmp_name"], $uploadPath)) {
            die("There was an error uploading the file!");
        }
    } else {
        die("Error: No file uploaded or invalid file.");
    }

    // Insert into the database
    $insert = "INSERT INTO tbl_student(roll_no, name, father_name, dob, gender, class, section, mobile_no, class_teacher_name, school_name, address, image_name) 
               VALUES('$roll_no', '$name', '$father_name', '$dob', '$gender', '$class', '$section', '$mobile_no', '$class_teacher_name', '$school_name', '$address', '$filename')";
    $ret = mysqli_query($mysqli, $insert);

    if ($ret) {
        $_SESSION['alert'] = "Student add Successfully!"; // Set success message
        header('Location: student.php');
        exit();
    } else {
        $_SESSION['alert'] = "Error saving record."; // Set error message
        header('Location: std-form.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Add Student</title>
    <script src="./js-jquery.js"></script>
    <script src="./std-validation.js"></script>
</head>

<body class="bg-image" style="background-size: 200vh; background-image:url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">

    <div class="container">
        <div class="container-fluid bg-3 text-center">
            <h3></h3>
            <a href="student.php" class="btn btn-info pull-right" style='margin-top:-30px'>
                <span class="glyphicon glyphicon-book"></span> View Record
            </a>
            <br>

            <div class="panel panel-danger">
                <div class="panel-heading">
                    <h4 class="text-info text-uppercase text-justify text-center">ADD STUDENT</h4>
                </div>

                <form class="form-horizontal container" method="post" enctype="multipart/form-data">
                    <div class="panel-body">
                        <!-- Form Fields -->
                        <div class="form-group">
                            <label class="control-label col-sm-5">Roll.no :</label>
                            <div class="col-sm-1">
                                <input class="form-control" id="rno" type="text" name="rollno" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">Name :</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="name" type="text" name="name" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">Father Name :</label>
                            <div class="col-sm-3">
                                <input class="form-control" id="fname" type="text" name="father" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">DOB :</label>
                            <div class="col-sm-2">
                                <input class="form-control" id="dob" type="date" name="dob" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5" for="gender">Gender :</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="gender" id="gen" required>
                                    <option value="">Select Gender</option>
                                    <option value="male">Male</option>
                                    <option value="female">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">Class :</label>
                            <div class="col-sm-1">
                                <input class="form-control" type="text" name="class" id="class" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">Section :</label>
                            <div class="col-sm-2">
                                <select class="form-control" name="section" id="section" required>
                                    <option value="">Select Section</option>
                                    <option value="No Section">No Section</option>
                                    <option value="Nursery">Nursery</option>
                                    <option value="A">A</option>
                                    <option value="B">B</option>
                                    <option value="C">C</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">Mobile Number :</label>
                            <div class="col-sm-2">
                                <input class="form-control" type="text" name="mobileno" id="mobno" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">Class Teacher Name :</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="text" name="teacher" id="tname" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">School Name :</label>
                            <div class="col-sm-3">
                                <input class="form-control" type="text" name="school" id="school" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">Address :</label>
                            <div class="col-sm-3">
                                <textarea rows="5" class="form-control" name="address" id="address" required></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-5">Upload Image :</label>
                            <div class="col-sm-3">
                                <input type="file" name="image" id="image" required />
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-3 col-sm-offset-5">
                                <a href="student.php" class="btn btn-danger mx-3" style="border-radius: 10px;">Cancel</a>
                                <input type="submit" class="btn btn-success" id="btnsubmit" style="border-radius: 10px;" name="submit" value="Submit">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php
    // Display the session alert if exists
    if (isset($_SESSION['alert'])) {
        echo "<script>alert('" . $_SESSION['alert'] . "');</script>";
        unset($_SESSION['alert']); // Clear the alert after showing it
    }
    ?>
</body>
</html>
