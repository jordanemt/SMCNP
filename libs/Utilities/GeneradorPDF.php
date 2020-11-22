<?php
require_once dirname(__FILE__).'/vendor/autoload.php';
use Spipu\Html2Pdf\Html2Pdf;
use Spipu\Html2Pdf\Exception\Html2PdfException;
use Spipu\Html2Pdf\Exception\ExceptionFormatter;
class GenerarPDF{
	private $checkbox=array();
	private $cursosReprobados=array();


	public function  Createcheckbox($objects,$options,$opcion){
		
		
		$validator=false;
		$temp=array();
		foreach ($options as $option ) {
			foreach ($objects as $key ) {
				if($key===$option){
					$validator=true;
				}
			}
			
			if($validator===true){
				$validator=false;
				if($opcion=="cursosAprobados"){
					array_push($this->checkbox, array("name"=>$option,"checked"=>"x"));
				}else{
					array_push($this->cursosReprobados, array("name"=>$option,"checked"=>"x"));
				}
				
			}else{
				if($opcion=="cursosAprobados"){
					array_push($this->checkbox, array("name"=>$option,"checked"=>""));
				}else{
					array_push($this->cursosReprobados, array("name"=>$option,"checked"=>""));
				}
			}
		}
		
		
	}

  public function generar($Estudiante,$cursosDePreferencia,$cursosReprobados){
  	try {
    ob_start();

	    include 'PDF.php';
	    $content = ob_get_clean();
	    $html2pdf = new Html2Pdf('P', 'A4', 'fr');
	    $html2pdf->setDefaultFont('Arial');
	    $html2pdf->writeHTML($content);
            
            $folder_destination = 'report_files/' . $Estudiante['card'];
            if (!file_exists($folder_destination)) {
                mkdir($folder_destination, 0777, true);
            }

            $html2pdf->output(__DIR__ . '/comprobante.pdf', 'F');
            rename(__DIR__ . '/comprobante.pdf', $folder_destination . '/comprobante.pdf');
	} catch (Html2PdfException $e) {
	    $html2pdf->clean();
	    $formatter = new ExceptionFormatter($e);
	    echo $formatter->getHtmlMessage();
	}
  }
  public function initMethod($Estudiante,$cursosDePreferencia,$cursosReprobados){
  	$checkboxCursos=array("Informática","Ingles conversacional","Contabilidad","Química","Física","Biología");
  	$checkboxCursosRepetidos=array("Español","Ciencias","Estudios Sociales","Matématica","Inglés","Cívica","Ética","Química","Física","Biología");
  	$this->Createcheckbox($cursosDePreferencia,$checkboxCursos,"cursosAprobados");
  	$this->Createcheckbox($cursosReprobados,$checkboxCursosRepetidos,"cursosReprobados");
  	$this->generar($Estudiante,$this->checkbox,$this->cursosReprobados);
  }
}
//$princiapl=new GenerarPDF();
//$cursosPreferidos=array("Informática","Biología");
//$cursosReprobados=array("Español","Ética");
//$Estudiante=array(
//				'id'=>"70000000",
//                'name' => "Justin",
//    'card' => "1-2123-1231",
//                'first_lastname' => "Villalobos",
//                'second_lastname' => "Espinoza",
//                'birthdate' => "01/11/2021",
//                "age"=>"17",
//                "months"=>"0",
//                'gender' => "M",
//                'nationality' => "Costarricense",
//                'personal_phone' => "88888888",
//                'other_phone' => "88888888",
//                'mep_mail' => "correo@correo.com",
//                'other_mail' => "correo@correo.com",
//                'direction' => "Direccion de la direccion",
//                'contact_name' => "Daniela",
//                'contact_phone' => "888888",
//                "suffering"=>"Diabetes",
//                "id_adecuacy"=>"0",
//                "parent"=>array("card"=>"70000001","full_name"=>"Juan V V","ocupation"=>"Delegado","work_place"=>"Colono","phone"=>"8888888"),
//                "enrollment"=>array("section"=>"A","_date"=>"20/10/2020","year"=>"2020","degree"=>"7")
//            );
//$princiapl->initMethod($Estudiante,$cursosPreferidos,$cursosReprobados);
//?>
