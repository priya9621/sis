<?php

namespace micron;

use \micron\Staff;

require_once __DIR__ . '/Staff.php';

require_once './header.php';

// echo $_POST['school'];
// exit();

if(isset($_GET['school'])){
   $section =  $_GET['school'];
   
}

// Initialize selectedSchool variable
$selectedSchool = ''; 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['school'])) {
    $_SESSION['selectedSchool'] = $_POST['school']; // Save to session
}

include '../connection.php';


$selectedSchool = $_SESSION['selectedSchool'] ?? ''; 

$designation = $_GET['designation'] ?? '';

// Base query to fetch students

$staff_result_query = "SELECT * FROM tbl_staff WHERE school_name = '$selectedSchool'";

if ($designation) {
    $staff_result_query .= " AND designation = '$designation'";
}

$staff_result = mysqli_query($mysqli, $staff_result_query);




// Fetch distinct designations

$sql_designation = "SELECT DISTINCT designation FROM tbl_staff";
$result_designation = mysqli_query($mysqli, $sql_designation);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous"/>
    <title>Staff Information Page!</title>
</head>

<body class="bg-image" style="background-size: 200vh; background-image:url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">
    
    <div class="container">
        <div class="d-flex justify-content-center">
        <h1 class="font-weight-bold text-warning" style="margin-top: -30px;">
            <?php echo !empty($selectedSchool) ? htmlspecialchars($selectedSchool) : 'school'; ?> 
            <span class="text-light">Staff Record</span>
        </h1>
        </div>
    </div>

    <div class="container-fluid py-5">
        <div class="container-fluid text-center">
            <a href="<?php echo base_url; ?>Exportproject/staff-select-school.php" class="btn btn-warning pull-left">
                <span class="glyphicon glyphicon-backward"></span> Back</a>
            
                <?php { ?>
                <a href="allstaff.php?school=<?php echo $selectedSchool?>&designation=<?php echo $designation ?>" class="btn btn-success pull-right">
                    <span class="glyphicon glyphicon-export"></span> All Data Export
                </a>
            <?php } ?> 
        </div>

        <div class="panel panel-info" style="margin-top: 20px;">
            <h4 class="text-info font-weight-bold text-uppercase mx-3">Staff Information</h4>
            <div class="panel-body">
                <?php if (!empty($staff_result)) { ?>

                <!-- Search Filter -->
                <div class="pull-right mb-3 p-0" style="display: flex; align-items: center;">
                    <form class="d-flex" method="GET">
                        <input type="text" id="searchField" name="search" placeholder="Search here" onkeyup="searchByAnyField()" class="form-control m-2">
                    </form> 
                </div>

                 <!-- Filters Form -->
                <form class="form-horizontal col-sm-2" method="GET">
                <div class="form-group">
                    <!-- designation Dropdown -->
                    <label class="control-label" for="Designation"></label>
                    <select class="form-control" name="designation" id="des" onchange="submit()">
                        <option value="">Select Designation</option>
                        <?php while ($row_designation = mysqli_fetch_assoc($result_designation)) { ?>
                            <option value="<?php echo $row_designation['designation']; ?>" <?php echo ($designation == $row_designation['designation'] ? 'selected' : ''); ?>>
                                <?php echo $row_designation['designation']; ?>
                            </option>
                        <?php } ?>
                        <option value="">none</option>
                    </select>
                </div>
                </form>
                   <div class="table-responsive">
                   <table class="table table-bordered table-striped" id="tab">
                        <thead>
                            <tr style="background-color:bisque;">
                                <th>Id</th>
                                <th>Designation</th>
                                <th>Name</th>
                                <th>Gender</th>
                                <th>Mobile No</th>
                                <th>Email</th>
                                <th>School Name</th>
                                <th>Address</th>
                                <th>Image</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php while($row=mysqli_fetch_assoc($staff_result)) { ?>
                            <tr align="center">
                                    <td style="background-color:bisque;"><?php echo htmlspecialchars($row['id']); ?></td>
                                    <td><?php echo htmlspecialchars($row['designation']); ?></td>
                                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                                    <td><?php echo htmlspecialchars($row['mobile_no']); ?></td>
                                    <td><?php echo htmlspecialchars($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars($row['school_name']); ?></td>
                                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                                    <td>
                                    <img src="<?php echo "../Importproject/imagess/" . htmlspecialchars($row['school_name']) . "/staff/" . htmlspecialchars($row['image_name']); ?>" width="75" height="75" alt="staff_image_name">
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

    <script>
        /*
        function filterTable() {
            var selectedDesignation = document.getElementById('designationSelect').value;
           // $_SESSION['section']=selectedDesignation;
            var table = document.querySelector('table tbody');
            var rows = table.getElementsByTagName('tr');

            for (var i = 0; i < rows.length; i++) {
                var designationCell = rows[i].getElementsByTagName('td')[1]; // 2nd column is Designation
                if (designationCell) {
                    rows[i].style.display = selectedDesignation === "" || designationCell.innerHTML === selectedDesignation ? "" : "none";
                }
            }
        }*/

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
