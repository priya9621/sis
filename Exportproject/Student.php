<?php

namespace micron;

use \micron\DataSource;

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Student
{
    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/DataSource.php';
        $this->ds = new DataSource();
    }

    public function getAllStudent()
    {
        $query = "SELECT * FROM tbl_student";
        $result = $this->ds->select($query);
        return $result;
    }

    public function exportStudentDatabase($student_result)
    {
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the column headers
        $headers = [
            'Sr.No',
            'Roll.No',
            'Name',
            'Father Name',
            'DOB',
            'Gender',
            'Class',
            'Section',
            'Mobile No',
            'Class Teacher',
            'Address',
            'School Name',
            'Image'
        ];

        // Set the header row
        // foreach ($headers as $key => $header) {
        //     $sheet->setCellValueByColumnAndRow($key + 1, 1, $header);
        // }

        //Set column widths
        $columnWidths = [10, 15, 25, 25, 15, 15, 10, 10, 15, 25, 30, 20, 15];
        foreach ($columnWidths as $col => $width) {
            $sheet->getColumnDimensionByColumn($col + 1)->setWidth($width);
        }



        /// Set the header row and center align
        foreach ($headers as $key => $header) {
            $sheet->setCellValueByColumnAndRow($key + 1, 1, $header);
            $sheet->getStyleByColumnAndRow($key + 1, 1)
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }

        // Populate the data rows and center align
        foreach ($student_result as $key => $row) {
            $rowNumber = $key + 2; // Start from the second row
            $sheet->setCellValueByColumnAndRow(1, $rowNumber, $row['id']);
            $sheet->setCellValueByColumnAndRow(2, $rowNumber, $row['roll_no']);
            $sheet->setCellValueByColumnAndRow(3, $rowNumber, $row['name']);
            $sheet->setCellValueByColumnAndRow(4, $rowNumber, $row['father_name']);
            $sheet->setCellValueByColumnAndRow(5, $rowNumber, $row['dob']);
            $sheet->setCellValueByColumnAndRow(6, $rowNumber, $row['gender']);
            $sheet->setCellValueByColumnAndRow(7, $rowNumber, $row['class']);
            $sheet->setCellValueByColumnAndRow(8, $rowNumber, $row['section']);
            $sheet->setCellValueByColumnAndRow(9, $rowNumber, $row['mobile_no']);
            $sheet->setCellValueByColumnAndRow(10, $rowNumber, $row['class_teacher_name']);
            $sheet->setCellValueByColumnAndRow(11, $rowNumber, $row['address']);
            $sheet->setCellValueByColumnAndRow(12, $rowNumber, $row['school_name']);

            // Center the text in each row
            for ($col = 1; $col <= 12; $col++) {
                $sheet->getStyleByColumnAndRow($col, $rowNumber)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            }

            // Add the image if exists and center it
            $imagePath = "../Importproject/imagess/" . htmlspecialchars($row['school_name']) . "/student/" . htmlspecialchars($row['image_name']);
            if (file_exists($imagePath)) {
                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName('Student Image');
                $drawing->setDescription('Student Image');
                $drawing->setPath($imagePath);
                $drawing->setCoordinates('M' . $rowNumber); // Set where to place the image

                // Get the image size and set the dimensions
                list($width, $height) = getimagesize($imagePath);
                $maxHeight = 75;
                $heightRatio = $maxHeight / $height;
                $drawing->setHeight($maxHeight);
                $drawing->setWidth($width * $heightRatio);

                // Set row height to match the image
                $sheet->getRowDimension($rowNumber)->setRowHeight($maxHeight);

                // Add the image to the sheet
                $drawing->setWorksheet($sheet);
            } else {
                // Handle the missing image case
                $sheet->setCellValueByColumnAndRow(13, $rowNumber, 'Image not found');
                $sheet->getStyleByColumnAndRow(13, $rowNumber)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            }
        }


        // Set the filename
        $filename = 'Export_excel_' . time() . '.xlsx';

        ob_clean();

        // Set the headers for download
        header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
        header("Content-Disposition: attachment; filename=\"$filename\"");
        
        // Write the file to output
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit();
    }
}
