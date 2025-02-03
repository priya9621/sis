<?php

namespace micron;

use \micron\Staff;

require_once __DIR__ . '/Staff.php';

session_start();

if (!isset($_SESSION["logged_in"]) || $_SESSION["logged_in"] !== true) {
    header("Location:admin-login.php");
    exit();
}

$selectedSchool = '';
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['school'])) {
    $_SESSION['selectedSchool'] = $_POST['school']; // Save to session
}

$selectedSchool = $_SESSION['selectedSchool'] ?? ''; 


$designation = $_GET['designation'] ?? '';

// Base query to fetch students

$staff_result_query = "SELECT * FROM tbl_staff WHERE school_name = '$selectedSchool'";

if ($designation) {
    $staff_result_query .= " AND designation = '$designation'";
}else{

    $staff_result_query = "SELECT * FROM tbl_staff Where school_name='$selectedSchool'";

}

// $selectedSchool = ''; 
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $selectedSchool = $_SESSION['school'] ?? ''; 
    // echo $selectedSchool;
    // exit;
}



// Fetch all staff data
$staff = new Staff();
// $staff_result = $staff->getAllStaff();

include '../connection.php';

$staff_result = mysqli_query($mysqli,$staff_result_query);

if (isset($_POST["export"])) {
    $searchQuery = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

    if (!empty($searchQuery)) {
        $staff_result = array_filter($staff_result, function ($staff) use ($searchQuery) {
            return strpos(strtolower($staff['designation']), $searchQuery) !== false ||
                strpos(strtolower($staff['id']), $searchQuery) !== false ||
                strpos(strtolower($staff['name']), $searchQuery) !== false ||
                strpos(strtolower($staff['staff_id']), $searchQuery) !== false ||
                strpos(strtolower($staff['gender']), $searchQuery) !== false ||
                strpos(strtolower($staff['mobile_no']), $searchQuery) !== false ||
                strpos(strtolower($staff['email']), $searchQuery) !== false ||
                strpos(strtolower($staff['school_name']), $searchQuery) !== false ||
                strpos(strtolower($staff['address']), $searchQuery) !== false ||
                strpos(strtolower($staff['image_name']), $searchQuery) !== false ||
                strpos(strtolower($staff['updated_at']), $searchQuery) !== false;
        });
    }

    if (!empty($staff_result)) { // Check if there are filtered results to export
        $staff->exportStaffDatabase($staff_result); // Export filtered data
    } else {
        echo "<script>alert('No data available for export.');</script>"; // Alert if no data
    }
}


// Fetch distinct designations
$sql = "SELECT DISTINCT designation FROM tbl_staff";
$result = mysqli_query($mysqli, $sql);

// Get selected school from session or fallback to default 'school'
// $selectedSchool = isset($_SESSION['selected_school']) ? $_SESSION['selected_school'] : 'school';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" crossorigin="anonymous" />
    <title>Staff Information Page!</title>
</head>

<body class="bg-image" style="background-size: 200vh; background-image:url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">

    <div class="container-fluid">
        <div class="container-fluid bg-3 text-center">
            <a href="staff-list.php" class="btn btn-warning pull-left" style='margin-top:30px; margin-right:10px;'>
                <span class="glyphicon glyphicon-backward"></span> Back
            </a>
            <form action="" method="post">
                <button type="submit" id="btnExport" name='export' class="btn btn-success pull-right" style='margin-top:30px; margin-right:10px;' value="Export to Excel" class="btn btn-info"> 
                    <span class="glyphicon glyphicon-export"></span> Export Data
                </button>
            </form>
        </div>

        <div class="panel panel-info" style="margin-top:10px">
            <h4 class="text-info font-weight-bold text-uppercase mx-3">Staff Information</h4>
            <div class="panel-body">
                <?php if (!empty($staff_result)) { ?>
                    
                        <div class="table-responsive">
                        <?php
                            // Fetch the search query from the URL
                            $searchQuery = isset($_GET['search']) ? strtolower(trim($_GET['search'])) : '';

                            // Filter the staff data if a search query exists
                            if (!empty($searchQuery)) {
                                $staff_result = array_filter($staff_result, function ($staff) use ($searchQuery) {
                                    return strpos(strtolower($staff['designation']), $searchQuery) !== false ||
                                    strpos(strtolower($staff['id']), $searchQuery) !== false ||
                                    strpos(strtolower($staff['name']), $searchQuery) !== false ||
                                    strpos(strtolower($staff['staff_id']), $searchQuery) !== false ||
                                    strpos(strtolower($staff['gender']), $searchQuery) !== false ||
                                    strpos(strtolower($staff['mobile_no']), $searchQuery) !== false ||
                                    strpos(strtolower($staff['email']), $searchQuery) !== false ||
                                    strpos(strtolower($staff['school_name']), $searchQuery) !== false ||
                                    strpos(strtolower($staff['address']), $searchQuery) !== false ||
                                    strpos(strtolower($staff['image_name']), $searchQuery) !== false ||
                                    strpos(strtolower($staff['updated_at']), $searchQuery) !== false;
                                });
                            }
                            ?>

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
                                    <td><?php echo htmlspecialchars ($row['designation']); ?></td>
                                    <td><?php echo htmlspecialchars ($row['name']); ?></td>
                                    <td><?php echo htmlspecialchars ($row['gender']); ?></td>
                                    <td><?php echo htmlspecialchars ($row['mobile_no']); ?></td>
                                    <td><?php echo htmlspecialchars ($row['email']); ?></td>
                                    <td><?php echo htmlspecialchars ($row['school_name']); ?></td>
                                    <td><?php echo htmlspecialchars ($row['address']); ?></td>
                                    <td>
                                        <img src="<?php echo "../Importproject/imagess/" . htmlspecialchars($row['school_name']) . "/staff/" . htmlspecialchars($row['image_name']); ?>" width="75" height="75" alt="staff_image">
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                        </div>
                <?php } else { ?>
                    <p class='text-center text-danger'>Record Not Found</p>
                <?php } ?>
            </div>
        </div>
    </div>
</body>
</html>
