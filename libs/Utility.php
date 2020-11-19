<?php

class Utility {

    public function __construct() {
        //Construct conf
    }

    public function generateReport() {
        require_once 'model/StudentModel.php';
        $studentModel = new StudentModel();
        $data = $studentModel->getStudentEnrollment();

        require_once 'libs/phpexcel/Classes/PHPExcel.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
                ->setCreator("SMCNP")
                ->setLastModifiedBy("SMCNP")
                ->setTitle("Reporte de matrícula")
                ->setDescription("Demostracion sobre como crear archivos de Excel desde PHP.")
                ->setKeywords("Excel Office 2007 openxml php");

        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Código/Matrícula')
                ->setCellValue('B1', 'Cédula')
                ->setCellValue('C1', 'Nombre')
                ->setCellValue('D1', 'P/Apellido')
                ->setCellValue('E1', 'S/Apellido')
                ->setCellValue('F1', 'F/Nacimiento')
                ->setCellValue('G1', 'Sección')
                ->setCellValue('H1', 'F/Matrícula')
                ->setCellValue('I1', 'M/Repitentes')
                ->setCellValue('J1', 'Servicios')
                ->setCellValue('K1', 'Ruta')
                ->setCellValue('L1', 'Género')
                ->setCellValue('M1', 'Nacionalidad')
                ->setCellValue('N1', 'Número')
                ->setCellValue('O1', 'O/Número')
                ->setCellValue('P1', 'Correo/MEP')
                ->setCellValue('Q1', 'Correo')
                ->setCellValue('R1', 'Distrito')
                ->setCellValue('S1', 'Dirección')
                ->setCellValue('T1', 'Padecimiento')
                ->setCellValue('U1', 'Adecuación')
                ->setCellValue('V1', 'IMAS')
                ->setCellValue('W1', 'Padre/Madre')
                ->setCellValue('X1', 'Trabaja')
                ->setCellValue('Y1', 'M/Sexualidad')
                ->setCellValue('Z1', 'M/Etíca')
                ->setCellValue('AA1', 'Nuevo');

        $index = 2;
        foreach ($data as $item) {
            $serviceName_list = $studentModel->getAllServiceNameById($item['id']);
            $services = 'No';
            if ($serviceName_list !== null) {
                $names = array();
                foreach ($serviceName_list as $serviceName) {
                    array_push($names, $serviceName['name']);
                }
                $services = join(', ', $names);
            }

            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A' . $index, ($item['enroll_num'] !== null) ? str_pad($item['enroll_num'], 4, '0', STR_PAD_LEFT) : 'NM')
                    ->setCellValue('B' . $index, $item['card'])
                    ->setCellValue('C' . $index, $item['name'])
                    ->setCellValue('D' . $index, $item['first_lastname'])
                    ->setCellValue('E' . $index, $item['second_lastname'])
                    ->setCellValue('F' . $index, $item['birthdate'])
                    ->setCellValue('G' . $index, ($item['section'] !== null) ? $item['section'] : 'NM')
                    ->setCellValue('H' . $index, ($item['enroll_date'] !== null) ? $item['enroll_date'] : 'NM')
                    ->setCellValue('I' . $index, ($item['repeating_matters'] !== null) ? $item['repeating_matters'] : 'No')
                    ->setCellValue('J' . $index, $services)
                    ->setCellValue('K' . $index, ($item['route'] !== null) ? $item['route'] : 'N/A')
                    ->setCellValue('L' . $index, $item['gender'])
                    ->setCellValue('M' . $index, $item['nationality'])
                    ->setCellValue('N' . $index, $item['personal_phone'])
                    ->setCellValue('O' . $index, ($item['other_phone'] !== null) ? $item['other_phone'] : 'No')
                    ->setCellValue('P' . $index, $item['mep_mail'])
                    ->setCellValue('Q' . $index, ($item['other_mail'] !== null) ? $item['other_mail'] : 'No')
                    ->setCellValue('R' . $index, $item['district'])
                    ->setCellValue('S' . $index, $item['direction'])
                    ->setCellValue('T' . $index, ($item['suffering'] !== null) ? $item['suffering'] : 'No')
                    ->setCellValue('U' . $index, ($item['adequacy'] !== null) ? $item['adequacy'] : 'No')
                    ->setCellValue('V' . $index, $item['is_imas_benefit'])
                    ->setCellValue('W' . $index, ($item['is_teenage_father'] !== null) ? $item['is_teenage_father'] : 'N/A')
                    ->setCellValue('X' . $index, $item['is_working'])
                    ->setCellValue('Y' . $index, $item['is_sexual_matter'])
                    ->setCellValue('Z' . $index, $item['is_ethics_matter'])
                    ->setCellValue('AA' . $index, $item['is_new_student']);

            $index++;
        }
        
        $objPHPExcel->getActiveSheet()->setTitle('Reporte');
        $objPHPExcel->setActiveSheetIndex(0);

        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('report_files/reporte.xlsx');
        $this->sendZip();
        exit();
    }
    
    private function sendZip() {
        // Get real path for our folder
        $rootPath = realpath('report_files/');

        // Initialize archive object
        $zip = new ZipArchive();
        $zip->open('reporte.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        /** @var SplFileInfo[] $files */
        $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($rootPath),
                RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $name => $file) {
            // Skip directories (they would be added automatically)
            if (!$file->isDir()) {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        // Zip archive will be created only after closing object
        $zip->close();
        
        $yourfile = "reporte.zip";
        $file_name = basename($yourfile);

        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Length: " . filesize($yourfile));

        readfile($yourfile);

        unlink('reporte.zip');
    }

}
