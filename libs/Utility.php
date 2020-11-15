<?php

class Utility {
    
    public function __construct() {
        //Construct conf
    }
    
    public function generateReport($data) {
        require_once 'libs/phpexcel/Classes/PHPExcel.php';
        $objPHPExcel = new PHPExcel();
        $objPHPExcel->getProperties()
                ->setCreator("SMCNP")
                ->setLastModifiedBy("SMCNP")
                ->setTitle("Reporte de matrícula")
                ->setDescription("Demostracion sobre como crear archivos de Excel desde PHP.")
                ->setKeywords("Excel Office 2007 openxml php");

        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A1', 'Cédula')
                ->setCellValue('B1', 'Nombre')
                ->setCellValue('C1', 'P/Apellido')
                ->setCellValue('D1', 'S/Apellido')
                ->setCellValue('E1', 'Sección')
                ->setCellValue('F1', 'F/Matrícula')
                ->setCellValue('G1', 'Materías/R')
                ->setCellValue('H1', 'Servicios')
                ->setCellValue('I1', 'Ruta')
                ->setCellValue('J1', 'F/Nacimiento')
                ->setCellValue('K1', 'Género')
                ->setCellValue('L1', 'Nacionalidad')
                ->setCellValue('M1', 'Número')
                ->setCellValue('N1', 'O/Número')
                ->setCellValue('O1', 'Correo/MEP')
                ->setCellValue('P1', 'Correo')
                ->setCellValue('Q1', 'Distrito')
                ->setCellValue('R1', 'Dirección')
                ->setCellValue('S1', 'Padecimiento')
                ->setCellValue('T1', 'Adecuación')
                ->setCellValue('U1', 'IMAS')
                ->setCellValue('V1', 'Padre/Madre')
                ->setCellValue('W1', 'Trabaja')
                ->setCellValue('X1', 'M/Sexualidad')
                ->setCellValue('Y1', 'M/Etíca')
                ->setCellValue('Z1', 'Nuevo');
        
        $index = 2;
        foreach ($data as $item) {
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $index, $item['card'])
                ->setCellValue('B' . $index, $item['name'])
                ->setCellValue('C' . $index, $item['first_lastname'])
                ->setCellValue('D' . $index, $item['second_lastname'])
                ->setCellValue('E' . $index, $item['section'])
                ->setCellValue('F' . $index, $item['enroll_date'])
                ->setCellValue('G' . $index, $item['repeating_matters'])
                ->setCellValue('H' . $index, '')
                ->setCellValue('I' . $index, $item['route'])
                ->setCellValue('J' . $index, $item['birthdate'])
                ->setCellValue('K' . $index, $item['gender'])
                ->setCellValue('L' . $index, $item['nationality'])
                ->setCellValue('M' . $index, $item['personal_phone'])
                ->setCellValue('N' . $index, $item['other_phone'])
                ->setCellValue('O' . $index, $item['mep_mail'])
                ->setCellValue('P' . $index, $item['other_mail'])
                ->setCellValue('Q' . $index, $item['district'])
                ->setCellValue('R' . $index, $item['direction'])
                ->setCellValue('S' . $index, $item['suffering'])
                ->setCellValue('T' . $index, $item['adequacy'])
                ->setCellValue('U' . $index, $item['is_imas_benefit'])
                ->setCellValue('V' . $index, $item['is_teenage_father'])
                ->setCellValue('W' . $index, $item['is_working'])
                ->setCellValue('X' . $index, $item['is_sexual_matter'])
                ->setCellValue('Y' . $index, $item['is_ethics_matter'])
                ->setCellValue('Z' . $index, $item['is_new_student']);
            
            $index ++;
        }

        $objPHPExcel->getActiveSheet()->setTitle('Reporte');
        $objPHPExcel->setActiveSheetIndex(0);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="reporte_de_estudiantes.xlsx"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $objWriter->save('php://output');
        exit;
    }
}