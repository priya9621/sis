<?php
require_once './header.php';
include('../connection.php');                                      

if (isset($_POST['submit'])) {
    $staff_id = $_POST['staffid'];
    $name = $_POST['name'];
    $designation = $_POST['designation'];
    $gender = $_POST['gender'];
    $mobile_no = $_POST['mobileno'];
    $email = $_POST['email'];
    $school_name = $_POST['school'];
    $address = $_POST['address'];

    if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
        $allowedfiletypes = array("jpg"=>"image/jpg","jpeg"=>"image/jpeg","gif"=>"image/gif","png"=>"image/png");
        
        $filename = $_FILES["image"]["name"];  
        $filetype = $_FILES["image"]["type"]; 
        $filesize = $_FILES["image"]["size"]; 
    
        $maxsize = 5 * 1024 * 1024;
    
        // Sanitize the filename
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $filename = "SCHOOL-" . $school_name . "-NAME-" . $name . "-Designation-" . $designation . "-MOBILENO-" . $mobile_no . "." . $ext;

        // Set the directory path
        $upload_dir = "./imagess/" . $school_name . "/staff/";

        // Check if directory exists, if not, create it
        if (!is_dir($upload_dir)) {
            mkdir($upload_dir, 0777, true);
        }

        // Move the uploaded file to the target directory
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $upload_dir . $filename)) {
            header('Location: staff.php');
        } else {
            echo "There was an error uploading the file!";
        }
    } else {
        echo "Please upload a valid image.";
    }

    
    $insert = "INSERT INTO tbl_staff(staff_id,name,designation,gender,mobile_no,email,school_name,address,image_name) 
    VALUES('$staff_id','$name','$designation','$gender','$mobile_no','$email','$school_name','$address','$filename')";
    $ret = mysqli_query($mysqli,$insert);
    
    if ($ret) {
        $_SESSION['alert'] = "Student add Successfully!"; // Set success message
        header('Location: staff.php');
        exit();
    } else {
        $_SESSION['alert'] = "Error saving record."; // Set error message
        header('Location: staff-form.php');
        exit();
    }
    
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet"href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <title>Document</title>
    <script src="./js-jquery.js"></script>
    <script src="./staff-validation.js"></script>
</head>
<body class="bg-image "   style="background-size: 200vh; background-image:url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">   

 <div class="container">
 <div class="container-fluid bg-3 text-center">
    <h3></h3>
    <a href="staff.php" class="btn btn-info pull-right" 
        style='margin-top:-30px'>
    <span class="glyphicon glyphicon-book"></span>
    View Record
    </a>
    <br>

    <div class="panel panel-danger">
    <div class="panel-heading"><h4 class="text-info text-uppercase text-justify text-center">Add Staff</h4></div>

        <form class="form-horizontal" method="post" enctype="multipart/form-data">
            <div class="panel-body">

            <div class="form-group">
                <label class="control-label col-sm-5">Staff Id :</label>
                <div class="form-group col-sm-1">
                    <input class="form-control" type="staffiid" name="staffid" id="staff" required>
                </div>
            </div> 

            <div class="form-group">
                <label class="control-label col-sm-5">Name :</label>
                <div class="form-group col-sm-3">
                    <input class="form-control" type="text" name="name" id="name" required>
                </div>
            </div>    
             
            <div class="form-group">
                <label class="control-label col-sm-5">Designation :</label>
                <div class="form-group col-sm-3">
                    <input class="form-control" type="text" name="designation" id="des" required>
                </div>
            </div>
           
            <div class="form-group">
            <label class="control-label col-sm-5" for="gender">Gender :</label>
            <div class="form-group col-sm-2">
            <select class="form-control" name="gender" id="gen">
                <option value="">Select Gender</option>
                <option value="male">Male</option>
                <option value="female">Female</option>
            </select>
            </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-5">Mobile Number :</label>
                <div class="form-group col-sm-2">
                    <input class="form-control" type="mobileno" name="mobileno"  id="mobno" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-5">Email :</label>
                <div class="form-group col-sm-3">
                    <input class="form-control" type="email" name="email" id="email" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-5">School Name :</label>
                <div class="form-group col-sm-3">
                    <input class="form-control" type="text" name="school" id="school" required>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label col-sm-5">Address :</label>
                <div class="form-group col-sm-3">
                    <textarea rows="5" cols="2" class="form-control" name="address" id="address" required></textarea>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label col-sm-5">Upload Image :</label>
                <input type="file" name="image" id="image" value="upload"/>
             </div>

            <div class="form-group">
              <label class="control-label col-sm-5"></label>
              <div class="form-group col-sm-3 ">
              <a href="staff.php" class="btn btn-danger mx-3" style="border-radius: 10px;">cancel</a>
                <input type="submit" class="btn btn-success" style="border-radius: 10px;" name="submit" id="btnsubmit" value="Submit">
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

