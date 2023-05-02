<?php

namespace App\Controllers;

require_once 'C:\OSPanel\domains\codeigniter\blog\vendor\autoload.php';


use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\Writer\Csv;



class Home extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function spreadsheet_format_download()
    {

        $con = mysqli_connect("localhost", "root", "", "ci4_blog");


        if (isset($_POST['export_btn'])) {
            $ext = $_POST['export_file_type'];
            $filename = "Реестр_СМП" . time();

            $query = "SELECT * FROM posts ORDER BY id DESC";
            $query_run = mysqli_query($con, $query);

            if (mysqli_num_rows($query_run) > 0) {
                $spreadsheet = new Spreadsheet();
                $activeWorksheet = $spreadsheet->getActiveSheet();

                $activeWorksheet->setCellValue('A1', 'id');
                $activeWorksheet->setCellValue('B1', 'title');
                $activeWorksheet->setCellValue('C1', 'description');
                $activeWorksheet->setCellValue('D1', 'created_at');
                $activeWorksheet->setCellValue('E1', 'updated_at');

                $rowCount = 2;
                foreach ($query_run as $data) {
                    $activeWorksheet->setCellValue('A' . $rowCount, $data['id']);
                    $activeWorksheet->setCellValue('B' . $rowCount, $data['title']);
                    $activeWorksheet->setCellValue('C' . $rowCount, $data['description']);
                    $activeWorksheet->setCellValue('D' . $rowCount, $data['created_at']);
                    $activeWorksheet->setCellValue('E' . $rowCount, $data['updated_at']);
                    $rowCount++;
                }

                if ($ext == 'xlsx') {
                    $writer = new Xlsx($spreadsheet);
                    $final_fileName = $filename . 'xlsx';
                } elseif ($ext == 'xls') {
                    $writer = new Xls($spreadsheet);
                    $final_fileName = $filename . 'xls';
                } elseif ($ext == 'csv') {
                    $writer = new Csv($spreadsheet);
                    $final_fileName = $filename . 'csv';
                }



                header('Content-Type: application/vnd.ms-excel');
                header('Content-Disposition: attachment; filename="' . urlencode($final_fileName) . '"');
                $writer->save('php://output');

            } else {
                $_SESSION['status'] = "No Record found to export";
                header("Location: index.php");
            }
        }
    }

}


