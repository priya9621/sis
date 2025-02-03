<?php

use micron\DataSource;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;

require_once './DataSource.php';
$db = new DataSource();
$conn = $db->getConnection();
require_once('./vendor/autoload.php');

$message = ''; // Initialize message variable
$type = ''; // Initialize type variable

if (isset($_POST["import"])) {

    $allowedFileType = [
        'application/vnd.ms-excel',
        'text/xls',
        'text/xlsx',
        'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'
    ];

    if (in_array($_FILES["file"]["type"], $allowedFileType)) {

        $targetPath = './uploads/' . $_FILES['file']['name'];
        move_uploaded_file($_FILES['file']['tmp_name'], $targetPath);

        $Reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
        $spreadSheet = $Reader->load($targetPath);
        $excelSheet = $spreadSheet->getActiveSheet();
        $spreadSheetAry = $excelSheet->toArray();
        $sheetCount = count($spreadSheetAry);

        array_shift($spreadSheetAry); // Remove header row

        // Get the drawings collection for images
        $drawingCollection = $excelSheet->getDrawingCollection();
        $imagesByRow = [];

        foreach ($drawingCollection as $drawing) {
            if ($drawing instanceof Drawing) {
                $coordinates = $drawing->getCoordinates();
                $row = preg_replace('/[^0-9]/', '', $coordinates);
                $extension = $drawing->getExtension();

                if (!empty($spreadSheetAry[$row - 2])) {
                    $staff_id = mysqli_real_escape_string($conn, $spreadSheetAry[$row - 2][0]);
                    $name = mysqli_real_escape_string($conn, $spreadSheetAry[$row - 2][1]);
                    $designation = mysqli_real_escape_string($conn, $spreadSheetAry[$row - 2][2]);
                    $mobile_no = mysqli_real_escape_string($conn, $spreadSheetAry[$row - 2][4]);
                    $school_name = mysqli_real_escape_string($conn, $spreadSheetAry[$row - 2][6]);

                    $filename = "SCHOOL-{$school_name}-NAME-{$name}-DESIGNATION-{$designation}-MOBILENO-{$mobile_no}-" . uniqid() . ".$extension";
                    $imageFullPath = "./imagess/$school_name/staff/$filename";

                    if (!file_exists("./imagess/$school_name/staff/")) {
                        mkdir("./imagess/$school_name/staff/", 0777, true);
                    }

                    $imageData = file_get_contents($drawing->getPath());
                    if (file_put_contents($imageFullPath, $imageData) !== false) {
                        $imagesByRow[$row][] = $filename;
                    }
                }
            }
        }

        foreach ($spreadSheetAry as $i => $row) {
            $staff_id = mysqli_real_escape_string($conn, $row[0] ?? '');
            $name = mysqli_real_escape_string($conn, $row[1] ?? '');
            $designation = mysqli_real_escape_string($conn, $row[2] ?? '');
            $gender = mysqli_real_escape_string($conn, $row[3] ?? '');
            $mobile_no = mysqli_real_escape_string($conn, $row[4] ?? '');
            $email = mysqli_real_escape_string($conn, $row[5] ?? '');
            $school_name = mysqli_real_escape_string($conn, $row[6] ?? '');
            $address = mysqli_real_escape_string($conn, $row[7] ?? '');

            $rowIndex = $i + 2;
            $image_names = isset($imagesByRow[$rowIndex]) ? implode(',', $imagesByRow[$rowIndex]) : '';

            if (!empty($staff_id) || !empty($name)) {
                $query = "INSERT INTO tbl_staff (staff_id, name, designation, gender, mobile_no, email, school_name, address, image_name) 
                          VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
                $paramType = "sssssssss";
                $paramArray = array(
                    $staff_id,
                    $name,
                    $designation,
                    $gender,
                    $mobile_no,
                    $email,
                    $school_name,
                    $address,
                    $image_names
                );
                $insertId = $db->insert($query, $paramType, $paramArray);

                if (!empty($insertId)) {
                    $type = "success";
                    $message = "Excel Data Imported into the Database";
                } else {
                    $type = "error";
                    $message = "Problem in Importing Excel Data";
                }
            }
        }
    } else {
        $type = "error";
        $message = "Invalid File Type. Upload Excel File.";
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href=".\style.css">
    <style>
        .alert {
            padding: 10px;
            margin: 40px 0;
            border-radius: 5px;
            display: none;
            /* Hide by default */
            position: fixed;
            top: 20px;
            right: 10px;
            z-index: 1000;
        }

        .alert-success {
            background-color: #4CAF50;
            color: white;
        }

        .alert-error {
            background-color: #f44336;
            color: white;
        }
    </style>
    <script>
        function showAlert(message, type) {
            const alertBox = document.createElement('div');
            alertBox.className = `alert alert-${type}`;
            alertBox.innerText = message;
            document.body.appendChild(alertBox);
            alertBox.style.display = 'block';

            // Hide the alert after 3 seconds
            setTimeout(function() {
                alertBox.style.display = 'none';
                document.body.removeChild(alertBox);
            }, 3000);
        }
    </script>
</head>

<body class="bg-image" style="background-size: 200vh; background-image:url('https://slidechef.net/wp-content/uploads/2021/11/Real-Classroom-Background.jpg');">

    <div class="outer-container py-5" style="background-color: #dee2ed;">
        <div class="row">
            <form class="form-horizontal" action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data" onsubmit="return validateFile()">
                <div class="input-row">
                    <a href="./Template/import-staff-template.xlsx" download>Download Excel Template</a>
                    <br><br>
                    <label>Choose Your Excel Sheet To Import Data</label>
                    <div>
                        <input type="file" name="file" id="file" class="file" accept=".xls,.xlsx">
                    </div>
                    <div class="import">
                        <button type="submit" id="submit" name="import" class="btn-submit">Import Excel and Save Data</button>
                    </div>
                </div>
            </form>
            <?php if (!empty($message)) { ?>
                <script>
                    showAlert('<?php echo $message; ?>', '<?php echo $type; ?>');
                </script>
            <?php } ?>
        </div>
    </div>

    </div>
</body>

</html>