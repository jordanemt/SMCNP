<?php
require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;

class Utility {

    private $checkbox = array();
    private $cursosReprobados = array();
    
    private function createFolder($folder) {
        $oldmask = umask(0);
        mkdir($folder, 0777, true);
        umask($oldmask);
    }
    
    public function saveFile($file_form_name, $folder_name) {
        if (isset($_FILES[$file_form_name])) {
            $file_name = $_FILES[$file_form_name]['name'];
            $file_tmp = $_FILES[$file_form_name]['tmp_name'];
            $file_size = $_FILES[$file_form_name]['size'];
            $file_error = $_FILES[$file_form_name]['error'];

            $file_ext = explode('.', $file_name);
            $file_actual_ext = strtolower(end($file_ext));

            $allowed = array('pdf', 'docx', 'png', 'jpg', 'jpeg');
            if (in_array($file_actual_ext, $allowed)) {
                if ($file_error === 0) {
                    if ($file_size < 500000) {
                        $folder_destination = 'report_files/' . $folder_name;
                        if (!file_exists($folder_destination)) {
                            $this->createFolder($folder_destination);
                        }
                        $file_new_name = $file_form_name . '.' . $file_actual_ext;
                        $file_destination = $folder_destination . '/' . $file_new_name;
                        move_uploaded_file($file_tmp, $file_destination);
                    } else {
                        throw new Exception('El archivo excede los 5mb');
                    }
                } else {
                    throw new Exception('Ocurrió un error con los archivos');
                }
            }
        }
    }

    public function createVaucher($Estudiante,$cursosDePreferencia,$cursosReprobados) {
        $checkboxCursos = array("Informática", "Inglés", "Contaduría", "Química", "Física", "Biología");
        $checkboxCursosRepetidos = array("Español", "Ciencias", "Estudios Sociales", "Matemática", "Inglés", "Cívica", "Ética", "Química", "Física", "Biología", 'Taller lll ciclo');
        $this->createcheckbox($cursosDePreferencia, $checkboxCursos, "cursosAprobados");
        $this->createcheckbox($cursosReprobados, $checkboxCursosRepetidos, "cursosReprobados");
        $this->htmlToPdf($Estudiante, $this->checkbox, $this->cursosReprobados);
    }

    private function htmlToPdf($Estudiante, $cursosDePreferencia, $cursosReprobados) {
        try {
            ob_start();
            include 'Utilities/PDF.php';
            $content = ob_get_clean();
            $html2pdf = new Html2Pdf('P', 'A4', 'fr');
            $html2pdf->setDefaultFont('Arial');
            $html2pdf->writeHTML($content);

            //$folder_destination = 'report_files/' . $Estudiante['card'];
            $folder_destination = '/usr/share/matricula/report_files/' . $Estudiante['card'];
            if (!file_exists($folder_destination)) {
                $this->createFolder($folder_destination);
            }

            $html2pdf->output($folder_destination . '/comprobante.pdf', 'F');
            //rename(__DIR__ . '/comprobante.pdf', '' . $folder_destination . '/comprobante.pdf');
        } catch (Html2PdfException $e) {
            $html2pdf->clean();
            $formatter = new ExceptionFormatter($e);
            throw new Exception('Error al generar el comprobante');
        }
    }
    
    private function createcheckbox($objects, $options, $opcion) {
        $validator = false;
        $temp = array();
        foreach ($options as $option) {
            
            foreach ($objects as $key) {
                if ($key === $option) {
                    $validator = true;
                }
            }

            if ($validator === true) {
                $validator = false;
                if ($opcion == "cursosAprobados") {
                    array_push($this->checkbox, array("name" => $option, "checked" => "x"));
                } else {
                    array_push($this->cursosReprobados, array("name" => $option, "checked" => "x"));
                }
            } else {
                if ($opcion == "cursosAprobados") {
                    array_push($this->checkbox, array("name" => $option, "checked" => ""));
                } else {
                    array_push($this->cursosReprobados, array("name" => $option, "checked" => ""));
                }
            }
            
        }
    }

    public function sendGmailMail($FromUser, $FromName, $Subject, $Body, $archivos) {
        require_once 'PhpMailer/PHPMailerAutoload.php';
        require_once 'libs/Config.php';
        $config = Config::singleton();

        $mail = new phpmailer();
        $mail->isSMTP();
        $mail->Host = $config->get('gmailHost');
        $mail->SMTPAuth = $config->get('gmailHost');
        $mail->SMTPSecure = $config->get('gmailSecure');
        $mail->Port = $config->get('gmailPort');
        $mail->Username = $config->get('gmailUser');
        $mail->Password = $config->get('gmailPass');
        $mail->CharSet = 'UTF-8';
        $mail->Encoding = 'base64';

        $mail->From = $FromUser;
        $mail->FromName = $FromName;
        $mail->AddAddress($FromUser);
        for ($i = 0; $i < count($archivos); $i++) {
            $mail->addAttachment($archivos[$i]);
        }
        $mail->Subject = $Subject;
        $mail->Body = $Body;
        if (!$mail->send()) {
            throw new Exception('Error al enviar el correo');
        }
    }

    public function generateReport() {
        require_once 'model/StudentModel.php';
        $studentModel = new StudentModel();
        $data = $studentModel->getStudentEnrollment();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet
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
            if($item['enroll_num'] === null) continue;
            $serviceName_list = $studentModel->getAllServiceNameById($item['id']);
            $services = 'No';
            if ($serviceName_list !== null) {
                $names = array();
                foreach ($serviceName_list as $serviceName) {
                    array_push($names, $serviceName['name']);
                }
                $services = join(', ', $names);
            }

            $sheet
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

        $writer = new Xlsx($spreadsheet);
        $writer->save('report_files/reporte.xlsx');
    }

    public function sendContentZipReportFiles() {
        $rootPath = realpath('report_files/');

        // Initialize archive object
        $zip = new ZipArchive();
        $zip->open('reporte.zip', ZipArchive::CREATE | ZipArchive::OVERWRITE);

        // Create recursive directory iterator
        $files = new RecursiveIteratorIterator(
                new RecursiveDirectoryIterator($rootPath),
                RecursiveIteratorIterator::LEAVES_ONLY
        );

        foreach ($files as $file) {
            if (!$file->isDir()) {
                // Get real and relative path for current file
                $filePath = $file->getRealPath();
                $relativePath = substr($filePath, strlen($rootPath) + 1);

                // Add current file to archive
                $zip->addFile($filePath, $relativePath);
            }
        }

        $zip->close();

        $reportZip = "reporte.zip";
        $file_name = basename($reportZip);

        header("Content-Type: application/zip");
        header("Content-Disposition: attachment; filename=$file_name");
        header("Content-Length: " . filesize($reportZip));

        readfile($reportZip);
        unlink('reporte.zip');
    }

}
