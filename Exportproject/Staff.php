<?php

namespace micron;

use \micron\DataSource;

require './vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

class Staff
{
    private $ds;

    function __construct()
    {
        require_once __DIR__ . '/DataSource.php';
        $this->ds = new DataSource();
    }

    public function getAllStaff()
    {
        $query = "SELECT * FROM tbl_staff";
        $result = $this->ds->select($query);
        return $result;
    }

    public function exportStaffDatabase($staff_result)
    {
        // Create a new Spreadsheet object
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set the column headers
        $headers = [
            'Sr.No',
            'Staff Id',
            'Designation',
            'Name',
            'Gender',
            'Email',
            'Mobile No',
            'School Name',
            'Address',
            'Image'
        ];

        // Set the header row and align it
        foreach ($headers as $key => $header) {
            $sheet->setCellValueByColumnAndRow($key + 1, 1, $header);
            $sheet->getStyleByColumnAndRow($key + 1, 1)
                ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
        }

        // Set column widths
        $columnWidths = [10, 15, 25, 25, 15, 25, 15, 30, 20, 15];
        foreach ($columnWidths as $col => $width) {
            $sheet->getColumnDimensionByColumn($col + 1)->setWidth($width);
        }

        // Populate the data rows and center align
        foreach ($staff_result as $key => $row) {
            $rowNumber = $key + 2; // Start from the second row

            // Set row data
            $sheet->setCellValueByColumnAndRow(1, $rowNumber, $row['id']);
            $sheet->setCellValueByColumnAndRow(2, $rowNumber, $row['staff_id']);
            $sheet->setCellValueByColumnAndRow(3, $rowNumber, htmlspecialchars($row['designation']));
            $sheet->setCellValueByColumnAndRow(4, $rowNumber, htmlspecialchars($row['name']));
            $sheet->setCellValueByColumnAndRow(5, $rowNumber, htmlspecialchars($row['gender']));
            $sheet->setCellValueByColumnAndRow(6, $rowNumber, htmlspecialchars($row['email'])); // Added email field
            $sheet->setCellValueByColumnAndRow(7, $rowNumber, htmlspecialchars($row['mobile_no']));
            $sheet->setCellValueByColumnAndRow(8, $rowNumber, htmlspecialchars($row['school_name']));
            $sheet->setCellValueByColumnAndRow(9, $rowNumber, htmlspecialchars($row['address']));

            // Center the text in each row
            for ($col = 1; $col <= 9; $col++) {
                $sheet->getStyleByColumnAndRow($col, $rowNumber)
                    ->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER)
                    ->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
            }

            // Add the image if exists and center it
            $imagePath = "../Importproject/imagess/" . htmlspecialchars($row['school_name']) . "/staff/" . htmlspecialchars($row['image_name']);
            if (file_exists($imagePath)) {
                $drawing = new \PhpOffice\PhpSpreadsheet\Worksheet\Drawing();
                $drawing->setName('Staff Image');
                $drawing->setDescription('Staff Image');
                $drawing->setPath($imagePath);
                $drawing->setCoordinates('J' . $rowNumber); // Correct column for image

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
                $sheet->setCellValueByColumnAndRow(10, $rowNumber, 'Image not found');
                $sheet->getStyleByColumnAndRow(10, $rowNumber)
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
?>
