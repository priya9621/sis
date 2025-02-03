<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php 
     if(isset($_GET['class'])){
        echo 'You Selected Class: '.$_GET['class'];
     } else{
        echo 'Class Not Selected';
     }
     if(isset($_GET['section'])){
        echo '<br/>You Selected Section: '.$_GET['section'].'<br/>';
     } else{
        echo '<br/>Section Not Selected<br/>';
     }
    ?>
    <form>
        <label for="Class">Class :</label>
        <select name="class" id="Class" onchange="submit()">
            <option value="">Select Class</option>
            <option value="11" <?php echo ($_GET['class']=='11'?'selected':'')?>>11</option>
            <option value="12" <?php echo ($_GET['class']=='12'?'selected':'')?>>12</option>
            <option value="13" <?php echo ($_GET['class']=='13'?'selected':'')?>>13</option>
            <option value="">None</option>
           
        </select>
        <select name="section" id="Class" onchange="submit()">
            <option value="">Select Section</option>
            <option value="A" <?php echo ($_GET['section']=='A'?'selected':'')?>>A</option>
            <option value="B" <?php echo ($_GET['section']=='B'?'selected':'')?>>B</option>
            <option value="C" <?php echo ($_GET['section']=='C'?'selected':'')?>>C</option>
            <option value="">None</option>
           
        </select>
       
    </form>
</body>
</html>
<!-- Class Filter -->
            <!-- <form action="<?php htmlentities($_SERVER['PHP_SELF'])?>" method="POST">
                <select name="class" class="form-select mb-4 p-3" id="classSelect" style="background-color:antiquewhite;" onchange="submit()">
                    <option value="">Select Class</option>
                    <?php while ($row = mysqli_fetch_assoc($result_class)) {
                        echo '<option value="' . htmlspecialchars($row["class"]) . '">' . htmlspecialchars($row["class"]) . '</option>';
                    } ?>
                </select>
                </form> -->
                
                <form action="<?php htmlentities($_SERVER['PHP_SELF'])?>" method="POST">
            <!-- Section Filter -->
                <!-- <select name="section" class="form-select mb-4 p-3" id="sectionSelect" style="background-color:antiquewhite;" onchange="submit()">
                    <option value="">Select Section</option>
                    <?php while ($row = mysqli_fetch_assoc($result_section)) {
                        echo '<option value="' . htmlspecialchars($row["section"]) . '">' . htmlspecialchars($row["section"]) . '</option>';
                    } ?>
                </select>
            </form> -->

            <?php


 
require_once __DIR__ . '/Student.php';
 
require_once './header.php';

if(isset($_GET['school'])){
    $school =  $_GET['school'];
}

// Initialize selectedSchool variable
$selectedSchool = ''; 
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['school'])) {
    $_SESSION['selectedSchool'] = $_POST['school']; // Save to session
}

// $selectedSchool = $_SESSION['selectedSchool'] ?? ''; // Retrieve from session

// $student = new Student();
// $student_result = $student->getAllStudent();


include '../connection.php';

$selectedSchool = $_SESSION['selectedSchool'] ?? '';

if (isset($_GET['school']) && isset($_POST['class'])) {
    $school = $_GET['school'];
    $class = $_POST['class'];
    $student_result_query = "SELECT * FROM tbl_student WHERE school_name = '$selectedSchool' OR (class = '$school' AND section = '$school')";
    
    }if (isset($_POST['class']) && isset($_POST['section'])) {
        $class = $_POST['class'];
        $section = $_POST['section'];
        $class = $class;
        $section = $section;
        $student_result_query = "SELECT * FROM tbl_student WHERE school_name = '$selectedSchool' AND class = '$class' AND section = '$section'";

    } elseif (isset($_POST['class'])) {
        $class = $_POST['class'];
        $class = $class;
        $student_result_query = "SELECT * FROM tbl_student WHERE school_name = '$selectedSchool' AND class = '$class'";

    } elseif (isset($_POST['section'])) {
        $section = $_POST['section'];
        $section = $section;
        $student_result_query = "SELECT * FROM tbl_student WHERE school_name = '$selectedSchool' AND section = '$section'";

    } else {
        $student_result_query = "SELECT * FROM tbl_student WHERE school_name = '$selectedSchool'";
    }
    
    $student_result = mysqli_query($mysqli,$student_result_query);

// while($row=mysqli_fetch_assoc($student_result)){
//     print_r($row);
// }
// exit;

// Fetch distinct classes

$sql_class = "SELECT DISTINCT class FROM tbl_student"; 
$result_class = mysqli_query($mysqli, $sql_class);

// Fetch distinct sections

$sql_section = "SELECT DISTINCT section FROM tbl_student";
$result_section = mysqli_query($mysqli, $sql_section);
 

?>