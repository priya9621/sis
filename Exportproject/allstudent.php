<?php

namespace micron;

use \micron\Student;
 
require_once __DIR__ . '/Student.php';

// $student_result = $student->getAllStudent();    

session_start();

// Check if admin is logged in
if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location:admin-login.php");
    exit();
}
 
$selectedSchool = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['school'])) {
    $_SESSION['selectedSchool'] = $_POST['school']; // Save to session
}


$selectedSchool = $_SESSION['selectedSchool'] ?? ''; 

$class = $_GET['class'] ?? '';
$section = $_GET['section'] ?? '';


$student_result_query = "SELECT * FROM tbl_student WHERE school_name = '$selectedSchool'";

if (!empty($class)) {
    $student_result_query .= " AND class = '$class'";
}
    
if (!empty($section)) {
    $student_result_query .= " AND section = '$section'";
} 

$selectedSchool = ''; 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $selectedSchool = $_SESSION['school'] ?? ''; 
    // echo $selectedSchool;
    // exit;
}

$student = new student();

include '../connection.php';

// Execute the query
$student_result = mysqli_query($mysqli, $student_result_query);

// Handle Export Functionality
if (isset($_POST["export"])) {
    $searchQuery = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

    // Filter the results if a search query exists
    if (!empty($searchQuery)) {
        $student_result = array_filter($student_result, function ($student) use ($searchQuery) {
            return strpos(strtolower($student['roll_no']), $searchQuery) !== false ||
                strpos(strtolower($student['id']), $searchQuery) !== false || 
                strpos(strtolower($student['name']), $searchQuery) !== false ||
                strpos(strtolower($student['father_name']), $searchQuery) !== false ||
                strpos(strtolower($student['dob']), $searchQuery) !== false ||
                strpos(strtolower($student['gender']), $searchQuery) !== false ||
                strpos(strtolower($student['class']), $searchQuery) !== false ||
                strpos(strtolower($student['section']), $searchQuery) !== false ||
                strpos(strtolower($student['mobile_no']), $searchQuery) !== false ||
                strpos(strtolower($student['class_teacher_name']), $searchQuery) !== false ||
                strpos(strtolower($student['school_name']), $searchQuery) !== false ||
                strpos(strtolower($student['image_name']), $searchQuery) !== false ||
                strpos(strtolower($student['updated_at']), $searchQuery) !== false;
        });
    }

    // Proceed with export if data is available
    if (!empty($student_result)) {
        // Export the filtered student data (Assume exportStudentDatabase is implemented in Student class)
        $student = new Student();
        $student->exportStudentDatabase($student_result); // Assuming exportStudentDatabase handles export logic
    } else {
        echo "<script>alert('No data available for export.');</script>";
    }
}

// Fetch distinct classes and sections for dropdowns
$sql_class = "SELECT DISTINCT class FROM tbl_student";
$result_class = mysqli_query($mysqli, $sql_class);

$sql_section = "SELECT DISTINCT section FROM tbl_student";
$result_section = mysqli_query($mysqli, $sql_section);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>Student Information Page!</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous"/>
</head>
<body class="bg-image" style="background-size: 200vh; background-image:url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">   

<div class="container-fluid col-sm col-md">
    <div class="container-fluid text-center">
        <a href="student-list.php" class="btn btn-warning pull-left" style='margin-top: 60px; margin-right:10px;'>
            <span class="glyphicon glyphicon-backward"></span> Back
        </a>

        <!-- Search bar and Export button -->
        <div class="pull-right" style="display: flex; align-items: center; margin-top: 30px;">
            <!-- Export button -->
            <form action="" method="post">
                <button type="submit" id="btnExport" name='export' class="btn btn-success pull-right" style='margin-top:30px; margin-right:10px;' value="Export to Excel" class="btn btn-info"> 
                    <span class="glyphicon glyphicon-export"></span> Export Data
                </button>
            </form>
        </div>
    </div>

    <div class="panel panel-info" style="margin-top:10px">
        <h4 class="text-info text-uppercase mx-3 font-weight-bold">Student Information</h4>
        <div class="panel-body">
            <?php if (!empty($student_result)) { ?>

           <div class="table-responsive">
            <?php
            //  Fetch the search query from the URL
             $searchQuery = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';
                  // Filter student data if a search query exists
                if (!empty($searchQuery)) {
                    $student_result = array_filter($student_result, function ($student) use ($searchQuery) {
                        return strpos(strtolower($student['roll_no']), $searchQuery) !== false ||
                            strpos(strtolower($student['id']), $searchQuery) !== false || 
                            strpos(strtolower($student['name']), $searchQuery) !== false ||
                            strpos(strtolower($student['father_name']), $searchQuery) !== false ||
                            strpos(strtolower($student['dob']), $searchQuery) !== false ||
                            strpos(strtolower($student['gender']), $searchQuery) !== false ||
                            strpos(strtolower($student['class']), $searchQuery) !== false ||
                            strpos(strtolower($student['section']), $searchQuery) !== false ||
                            strpos(strtolower($student['mobile_no']), $searchQuery) !== false ||
                            strpos(strtolower($student['class_teacher_name']), $searchQuery) !== false ||
                            strpos(strtolower($student['school_name']), $searchQuery) !== false ||
                            strpos(strtolower($student['image_name']), $searchQuery) !== false ||
                            strpos(strtolower($student['updated_at']), $searchQuery) !== false;
                    });
                }
             ?>
            
           <table class="table table-bordered table-striped col-sm col-md">
                <thead>
                    <tr style="background-color:bisque;">
                        <th>Sr.No</th>
                        <th>Roll.No</th>
                        <th>Name</th>
                        <th>Father Name</th>
                        <th>DOB</th>
                        <th>Gender</th>
                        <th>Class</th>
                        <th>Section</th>
                        <th>Mobile No</th>
                        <th>Class Teacher</th>
                        <th>Address</th>
                        <th>School Name</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                <?php while($row=mysqli_fetch_assoc($student_result)) { ?>
                    <tr align="center">
                            <td style="background-color:bisque;"><?php echo htmlspecialchars($row['id']); ?></td>
                            <td><?php echo htmlspecialchars($row['roll_no']); ?></td>
                            <td><?php echo htmlspecialchars($row['name']); ?></td>
                            <td><?php echo htmlspecialchars($row['father_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['dob']); ?></td>
                            <td><?php echo htmlspecialchars($row['gender']); ?></td>
                            <td><?php echo htmlspecialchars($row['class']); ?></td>
                            <td><?php echo htmlspecialchars($row['section']); ?></td>
                            <td><?php echo htmlspecialchars($row['mobile_no']); ?></td>
                            <td><?php echo htmlspecialchars($row['class_teacher_name']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['school_name']); ?></td>
                            <td>
                                <img src="<?php echo "../Importproject/imagess/" . htmlspecialchars($row['school_name']) . "/student/" . htmlspecialchars($row['image_name']); ?>" width="75" height="75" alt="student_image_name">
                            </td> 
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
           </div>

            <?php } else { ?>
                <tr>
                    <td class='text-center text-danger' colspan='13'>Record Not Found</td>
                </tr>
            <?php } ?>
        </div>
    </div>
</div>
<!-- 
<script>
    // Update hidden input field for export with the current search query
    document.getElementById('btnExport').addEventListener('click', function () {
        var searchValue = document.getElementById('searchName').value.trim();
        document.getElementById('searchQuery').value = searchValue; // Set hidden input value
    });

    // Function to filter table data based on search
    function searchByAnyField() {
        var input = document.getElementById('searchName').value.toLowerCase();
        var table = document.querySelector('table tbody');
        var rows = table.getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            var match = false;
            
            // Loop through each cell in the row, excluding the first column (ID)
            for (var j = 1; j < cells.length; j++) {
                if (cells[j] && cells[j].innerHTML.toLowerCase().includes(input)) {
                    match = true;
                    break;
                }
            }
            
            rows[i].style.display = match ? "" : "none";
        }
    }
</script> -->
</body>
</html>
