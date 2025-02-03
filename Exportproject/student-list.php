<?php

namespace micron;

use \micron\Student;

require_once __DIR__ . '/Student.php';

require_once './header.php';

// echo $_POST['school'];
// exit();
// Initialize selectedSchool variable
$selectedSchool = ''; 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['school'])) {
    $_SESSION['selectedSchool'] = $_POST['school']; // Save to session
}

include '../connection.php';

$selectedSchool = $_SESSION['selectedSchool'] ?? '';


$class = $_GET['class'] ?? '';
$section = $_GET['section'] ?? '';

// Base query to fetch students

$student_result_query = "SELECT * FROM tbl_student WHERE school_name = '$selectedSchool'";


if (!empty($class)) {
    $student_result_query .= " AND class = '$class'";
}
    
if (!empty($section)) {
    $student_result_query .= " AND section = '$section'";
}

$student_result = mysqli_query($mysqli, $student_result_query);

// Fetch distinct classes
$sql_class = "SELECT DISTINCT class FROM tbl_student";
$result_class = mysqli_query($mysqli, $sql_class);

// Fetch distinct sections
$sql_section = "SELECT DISTINCT section FROM tbl_student";
$result_section = mysqli_query($mysqli, $sql_section);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous"/>
    <title>Student Information Page!</title>
</head>
<body class="bg-image" style="background-size: 200vh; background-image:url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">   


<section>
    <div class="container">
        <div class="d-flex justify-content-center">
            <h1 class="font-weight-bold text-warning" style="margin-top: -30px;">
                <?php echo !empty($selectedSchool) ? htmlspecialchars($selectedSchool) : 'school'; ?> 
                <span class="text-light">Student Record</span>
            </h1>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container-fluid bg-3 text-center">
            <a href=" <?php echo base_url; ?>Exportproject/std-select-sch.php" class="btn btn-warning pull-left">
                <span class="glyphicon glyphicon-backward"></span> Back
            </a>

            <?php { ?>
                <a href="allstudent.php?school=<?php echo $selectedSchool ?>&class=<?php echo $class ?>&section=<?php echo $section ?>" class="btn btn-success pull-right">
                    <span class="glyphicon glyphicon-export"></span> All Data Export
                </a>
            <?php } ?>  
        </div>

        <div class="panel panel-info" style="margin-top:10px">
            <h4 class="text-info text-uppercase mx-3 font-weight-bold">Student Information</h4>
            <div class="panel-body">
                <?php if (!empty($student_result)) { ?>

                <!-- Search Filter -->
                <div class="pull-right mb-3 p-0" style="display: flex; align-items: center;">
                    <form class="d-flex" method="GET">
                        <input type="text" id="searchField" name="search" placeholder="Search here" onkeyup="searchByAnyField()" class="form-control m-2">
                    </form>
                </div>

                <!-- Filters Form -->
                <form class="form-horizontal col-sm-1" method="GET">
                <div class="form-group">
                    <!-- Class Dropdown -->
                    <label class="control-label" for="Class"></label>
                    <select class="form-control" name="class" id="Class" onchange="submit()">
                        <option value="">Class</option>
                        <?php while ($row_class = mysqli_fetch_assoc($result_class)) { ?>
                            <option value="<?php echo $row_class['class']; ?>" <?php echo ($class == $row_class['class'] ? 'selected' : ''); ?>>
                                <?php echo $row_class['class']; ?>
                            </option>
                        <?php } ?>
                        <option value="">none</option>
                    </select>

                    <!-- Section Dropdown -->
                    <label class="control-label" for="Section"></label>
                    <select class="form-control" name="section" id="Section" onchange="submit()">
                        <option value="">Section</option>
                        <?php while ($row_section = mysqli_fetch_assoc($result_section)) { ?>
                            <option value="<?php echo $row_section['section']; ?>" <?php echo ($section == $row_section['section'] ? 'selected' : ''); ?>>
                                <?php echo $row_section['section']; ?>
                            </option>
                        <?php } ?>
                        <option value="">none</option>

                    </select>
                </div>
            </form>


                <!-- Table Start -->
                <div class="table-responsive">
                    <table class="table table-bordered table-striped">
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
                            <?php while ($row = mysqli_fetch_assoc($student_result)) { ?>
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
                <!-- Table End -->
                <?php } else { ?>
                    <p class='text-center text-danger'>Record Not Found</p>
                <?php } ?>
            </div>
        </div>
    </div>
</section>

<script>
    function searchByAnyField() {
        var input = document.getElementById('searchField').value.toLowerCase();
        var table = document.querySelector('table tbody');
        var rows = table.getElementsByTagName('tr');

        for (var i = 0; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            var match = false;

            // Loop through each cell in the row
            for (var j = 1; j < cells.length; j++) {
                if (cells[j] && cells[j].innerHTML.toLowerCase().includes(input)) {
                    match = true;
                    break;
                }
            }

            rows[i].style.display = match ? "" : "none";
        }
    }
</script>
</body>
</html>
