<style type="text/css">
  .header{
    witdh:100%;
    display:flex;
    grid-template-columns:35% 35% 35%; 
  }

  .body{

  }
  .footer{
    
  }
 

  div.special { margin: auto; width:95%; padding: 2px; }
  div.special table { width:100%; font-size:10px;  }
  .topLeftRight     { border-top:1px solid #000; border-left:1px solid #000; border-right:1px solid #000;}
  .topLeftBottom    { border-top:1px solid #000; border-left:1px solid #000; border-bottom:1px solid #000; }
  .topLeft          { border-top:1px solid #000; border-left:1px solid #000; }
  .bottomLeft       { border-bottom:1px solid #000; border-left:1px solid #000; }
  .topRight         { border-top:1px solid #000; border-right:1px solid #000; }
  .bottomRight      { border-bottom:1px solid #000; }
  .topRightBottom   { border-top:1px solid #000; border-bottom:1px solid #000; border-right:1px solid #000; }


</style>
<page style="font-size: 12px" >
  <div class="header">
  
    <table style="width: 100%; border-bottom: solid 1px #00000;">
        <tr>
            <td style="width: 20%;height:50px;"><img src="public/img/ri_1.png"/></td>
            <td style="width: 60%; height:50px;">
              <div style="text-align: center">
                <strong><p style="font-size: 18px;color: #0c5161;">MINISTERIO DE EDUCACIÓN PÚBLICA<BR />COLEGIO NOCTURNO DE POCOCÍ</p></strong>
              </div>
              </td>
            <td style="width: 20%; height:50px;"><img src="public/img/ri_2.png"/></td>
        </tr>
        
    </table>
  </div>
  
  <br />
  <div class="body" style="height:680px;width:100%;">
    <div class="special">
        <table>
          <tr>
            <td  style="width: 30%;"></td>
            <td  style="width: 40%;">
              <strong><span style="font-size: 18px">MATRICULA 2021</span></strong>

            </td>
            <td  style="width: 15%; height:10px;">
              <div style="display:flex;text-align:bottom;">
                <strong> <span style="font-size: 16px;margin-left: 25px;padding-top:25px;">Seccion</span></strong>
              </div>
            </td>
           <td style="width: 15%;text-align:left;" class="bottomRight"><?php echo $Estudiante["enrollment"]["section"]?></td>
          </tr>
          
   
        </table>

            
      </div>
      <br/>
      <div class="special">
        <table>
          <tr>
                <td style="width: 10%;"> <strong> <span style="font-size: 14px;">Fecha:</span></strong></td>

                <td style="width: 10%;font-size: 14px" class="bottomRight"><?php echo $Estudiante["enrollment"]["_date"]?></td>

                <td style="width: 25%;text-align:right;margin-left: 25px;"> <strong> <span style="font-size: 14px;">Nivel a Matricular:</span></strong></td>

                <td style="width: 15%;font-size: 14px" class="bottomRight"><?php echo $Estudiante["enrollment"]["degree"]?></td>

                <td style="width: 25%;text-align:right;margin-left: 25px;"><strong> <span style="font-size: 14px;">Taller(7°, 8° y 9°):</span></strong></td>

               
                  <td style="width: 15%;" class="bottomRight"></td>
            </tr>
           
          </table>
         
          <table >
            
            <tr>
               <td style="width: 30%;">
                <strong><span style="font-size: 16px;text-decoration: underline;text-decoration-color:black;"><p>Datos del estudiante</p></span></strong>

              </td>
              <td style="width: 40%; "></td>
              <td style="width: 20%;height:10px;text-align:bottom;">

                  <strong> <p style="font-size: 14px;margin-left: 45px;">Ciencia (11°)</p></strong>
                
            </td>
               <td style="width: 10%;text-align:left;" class="bottomRight"></td>
            </tr>
          
            
          </table>

          <br/><br />

          <table >
            <tr>
              <td style="width: 20%;text-align:left;" class="bottomRight"><?php echo $Estudiante["name"]?></td>
              <td style="width: 5%;"></td>
              <td style="width: 20%;text-align:left;" class="bottomRight"><?php echo $Estudiante["first_lastname"]?></td>
                <td style="width: 5%;"></td>
              <td style="width: 20%;text-align:left;" class="bottomRight"><?php echo $Estudiante["second_lastname"]?></td>
                <td style="width: 5%;"></td>
              <td style="width: 20%;text-align:left;" class="bottomRight"><?php echo $Estudiante["id"]?></td>
            </tr>
            <tr>
              <td style="width: 20%;text-align:center;" class="">
                <span style="font-size: 14px;"><p>Primer apellido</p></span>
              </td>
              <td style="width: 5%;"></td>
              <td style="width: 20%;text-align:center;" class="">
                 <span style="font-size: 14px;"><p>Segundo apellido</p></span>
              </td>
                <td style="width: 5%;"></td>
              <td style="width: 20%;text-align:center;" class="">
                 <span style="font-size: 14px"><p>Nombre</p></span>
              </td>
                <td style="width: 5%;"></td>
              <td style="width: 20%;text-align:center;" class="">
                 <span style="font-size: 14px;"><p>Cedula</p></span>
              </td>
            </tr>
          </table>


          <table>
            <tr>
              
               <td style="width: 21%;height:10px;text-align:left;">

                 <p style="font-size: 14px;margin-top:25px;">Fecha de nacimiento:</p>
                
            </td>
              <td style="width: 12%;;" class="bottomRight">
                <p style="margin-left: 15px;margin-top:25px;"><?php echo $Estudiante["birthdate"]?></p></td>
              <td style="width: 7%;height:10px;text-align:bottom;">

                 <p style="font-size: 14px;margin-left: 15px;margin-top:25px;">Edad:</p>
                
            </td>
                <td style="width: 10%;margin-left: 0px;" class="bottomRight"><p style="margin-left: 15px;margin-top:25px;"><?php echo $Estudiante["age"]?></p></td>
              <td style="width: 11%;height:10px;text-align:bottom;">

                 <p style="font-size: 14px;margin-left: 15px;margin-top:25px;">Años y</p>
                
            </td>
                <td style="width: 5%;" class="bottomRight"><p style="margin-left: 15px;margin-top:25px;"><?php echo $Estudiante["months"]?></p></td>
              <td style="width: 10%;height:10px;text-align:bottom;">

                 <p style="font-size: 14px;margin-left: 0px;margin-top:25px;">Meses.</p>
                
            </td>
               <td style="width: 7%;height:10px;text-align:bottom;">

                 <p style="font-size: 14px;margin-left: 15px;margin-top:22px;">Sexo:</p>
                
            </td>
              <td style="width: 20%;" class="">
                
                <div style="display:inline-block;margin-top:23px;">

                     <label style="font-size: 14px;"><?php if($Estudiante["gender"]==="F" || $Estudiante["gender"]=="1"){echo "(x)";}else{echo "()";}?> </label>
                    <label for="op1"  style="margin-left:5px;font-size: 14px;">F</label>
                    
                     <label style="margin-left:15px;font-size: 14px;"><?php if($Estudiante["gender"]==="M" || $Estudiante["gender"]=="0"){echo "(x)";}else{echo "()";}?> </label>
                    <label for="op2" style="margin-left:0px;font-size: 14px;"> M</label>
                </div>
              </td>
            </tr>
          </table>
          <table>
            <tr>
                <td style="width: 15%;text-align:left;" >
                 <span style="font-size: 14px;margin-left: 45px;;"><p>Nacionalidad:</p></span>
                </td>
                <td style="width: 25%;" class="bottomRight"><p style="margin-left: 15px;margin-top:25px;"><?php echo $Estudiante["nationality"]?></p></td>
              <td style="width: 10%;height:10px;text-align:bottom;"></td>
                <td style="width: 20%;height:10px;text-align:bottom;;">

                   <p style="font-size: 14px;margin-left: 35px;">Teléfono Hogar:</p>
                  
              </td>
                  <td style="width: 25%;" class="bottomRight"><p style="margin-left: 15px;margin-top:25px;"><?php echo $Estudiante["other_phone"]?></p></td>
              </tr>
          </table>

           <table>
            <tr>
                <td style="width: 18%;text-align:left;" >
                 <span style="font-size: 14px;margin-left: 15px;"><p>Correo electrónico:</p></span>
                </td>
                <td style="width: 35%;" class="bottomRight"><p style="margin-left: 15px;margin-top:25px;"><?php echo $Estudiante["mep_mail"]?></p></td>
                <td style="width: 25%;height:10px;text-align:bottom;;">

                   <p style="font-size: 14px;margin-left: 35px;">Teléfono estudiante:</p>
                  
              </td>
                  <td style="width: 20%;" class="bottomRight"><p style="margin-left: 15px;margin-top:25px;"><?php echo $Estudiante["personal_phone"]?></p></td>
              </tr>
          </table>



          <table >
            <tr>
              <td style="width: 20%;"><p style="font-size: 14px;">Residencia:</p></td>
              <td style="width: 15%;text-align:left;" class="bottomRight"><p style="margin-left: 15px;margin-top:25px;">Limón</p></td>
              <td style="width: 5%;"></td>
              <td style="width: 15%;text-align:left;" class="bottomRight"><p style="margin-left: 15px;margin-top:25px;">Pococí</p></td>
                <td style="width: 5%;"></td>
              <td style="width: 15%;text-align:left;" class="bottomRight"></td>
                <td style="width: 5%;"></td>
             
            </tr>
            <tr>
              <td style="width: 20%;"></td>
              <td style="width: 15%;text-align:center;" class="">
                <span style="font-size: 12px;"><p>Provincia</p></span>
              </td>
              <td style="width: 5%;"></td>
              <td style="width: 15%;text-align:center;" class="">
                 <span style="font-size: 12px;"><p>Cantón</p></span>
              </td>
                <td style="width: 5%;"></td>
              <td style="width: 15%;text-align:center;" class="">
                 <span style="font-size: 12px"><p>Distrito</p></span>
              </td>
                <td style="width: 5%;"></td>
              
            </tr>
          </table>
          <table>
              <tr>
                <td style="width: 20%;text-align:left;" >
                 <span style="font-size: 14px;margin-left: 15px;"><p> Dirección Exacta:</p></span>
                </td>
                <td style="width: 65%;" class="bottomRight"><p style="margin-left: 15px;margin-top:25px;"><?php echo $Estudiante["direction"]?></p></td>
                  
              </tr>

          </table>

          <table>
              <tr>
                <td style="width: 30%;text-align:left;margin-top:0px;" >
                 <span style="font-size: 14px;margin-left: 15px;"><p>Presenta alguna enfermedad:</p></span>
                </td>
                 <td style="width: 20%;" class="">
                
                  <div style="display:inline-block;margin-top:10px;">

                       <label style="margin-left:15px;font-size: 14px;"><?php if(strlen($Estudiante["suffering"])=="0"){echo "(x)";}else{echo "()";}?> </label>
                      <label for="op1"  style="margin-left:5px;font-size: 14px;">No</label>
                      
                       <label style="margin-left:15px;font-size: 14px;"><?php if( strlen($Estudiante["suffering"])>"0"){echo "(x)";}else{echo "()";}?> </label>
                      <label for="op2" style="margin-left:15px;font-size: 14px;"> Si</label>
                  </div>
                </td>
                <td style="width: 15%;text-align:left;height:25px;" >
                 <span style="font-size: 14px;margin-left: 15px;"><p>especifique:</p></span>
                </td>
                <td style="width: 35%;" class="bottomRight">
                    <p style="margin-left: 15px;margin-top:25px;"><?php echo $Estudiante["suffering"]?></p>
                </td>
                  
              </tr>
              

          </table>
          <table>
            <tr>  
                <td style="width: 35%;text-align:left;height:25px;" >
                 <span style="font-size: 14px;margin-left: 15px;"><p>Tiene adecuación curricular apropiada:</p></span>
                </td>
                 <td style="width: 20%;" class="">
                
                  <div style="display:inline-block;margin-top:10px;">

                     <label style="margin-left:15px;font-size: 14px;"><?php if(strlen($Estudiante["id_adecuacy"])=="0"){echo "(x)";}else{echo "()";}?> </label>
                      <label for="op1"  style="margin-left:5px;font-size: 14px;">No</label>
                      
                      <label style="margin-left:15px;font-size: 14px;"><?php if(strlen($Estudiante["id_adecuacy"])!="0"){echo "(x)";}else{echo "()";}?> </label>
                      <label for="op2" style="margin-left:15px;font-size: 14px;"> Si</label>
                  </div>
                </td>
                <td></td><td></td>
              </tr>
          </table>

          <table>
            <tr>
                <td style="width: 37%;text-align:left;" >
                 <span style="font-size: 14px;margin-left: 15px;"><p>En caso de emergencia comunicarse con:</p></span>
                </td>
                <td style="width: 30%;" class="bottomRight"><p style="margin-left: 15px;margin-top:25px;"><?php echo $Estudiante["contact_name"]?></p></td>
                <td style="width: 15%;height:10px;text-align:bottom;">

                   <p style="font-size: 14px;margin-left: 35px;">Teléfono:</p>
                  
              </td>
                  <td style="width: 17%;" class="bottomRight"><p style="margin-left: 15px;margin-top:25px;"><?php echo $Estudiante["contact_phone"]?></p></td>
              </tr>
          </table>
          <?php if($Estudiante["age"]<18){?>
          <table >
            
            <tr>
               <td style="width: 50%;">
                <strong><span style="font-size: 16px;text-decoration: underline;text-decoration-color:black;"><p>Datos del Padre, Madre o Encargado</p></span></strong>

              </td>
            </tr>
          </table>
          <table>
            <tr>
                <td style="width: 20%;text-align:left;height:25px;" >
                 <span style="font-size: 14px;margin-left: 15px;"><p> Nombre Completo:</p></span>
                </td>
                <td style="width: 65%;" class="bottomRight"><p style="margin-left: 15px;margin-top:25px;"><?php echo $Estudiante["parent"]["full_name"]?></p></td>
                  
              </tr>

          </table>
        <?php } ?>
           
          <table >
            <tr>
                <td style="width: 10%;text-align:left;" >
                 <span style="font-size: 14px;margin-left: 15px;"><p>Cedula:</p></span>
                </td>
                <td style="width: 30%;" class="bottomRight"><p style="margin-left: 15px;margin-top:25px;"><?php echo $Estudiante["parent"]["card"]?></p></td>
                <td style="width: 15%;height:10px;text-align:bottom;">

                   <p style="font-size: 14px;margin-left: 35px;">Teléfono:</p>
                  
              </td>
                  <td style="width: 17%;" class="bottomRight"><p style="margin-left: 15px;margin-top:25px;"><?php echo $Estudiante["parent"]["phone"]?></p></td>
              </tr>
          </table>
          <table style="">
            <tr>
                <td style="width: 13%;text-align:left;" >
                 <span style="font-size: 14px;margin-left: 15px;"><p>Ocupación:</p></span>
                </td>
                <td style="width: 30%;" class="bottomRight"><p style="margin-left: 15px;margin-top:20px;"><?php echo $Estudiante["parent"]["ocupation"]?></p></td>
                <td style="width: 25%;text-align:bottom;">

                   <p style="font-size: 14px;margin-left: 35px;">Lugar de Trabajo:</p>
                  
              </td>
                  <td style="width: 17%;" class="bottomRight"><p style="margin-left: 15px;margin-top:15px;"><?php echo $Estudiante["parent"]["work_place"]?></p></td>
              </tr>
          </table>
      </div>
  </div>
  <div class="footer" style=";margin-top:0px;">
      <div  style="text-align:center; padding-bottom: 1%;">
       <strong><span  style="font-size: 18px">MARQUE LAS MATERIAS DE SU PREFERENCIA EN TALLER Y CIENCIA</span></strong><br>
    </div>
        <div style="width: 100%; border: solid 1px #000000;  font-size: 4mm; line-height: 150%;">
        
        <div style="display:inline-block;margin-top: 0%;">

            <label for="op1"  style="margin-left:25px;">Taller III ciclo:</label>
            

            <label for="op2" style="margin-left:25px;"> Informática</label>
            <label >(<?php echo $cursosDePreferencia[0]["checked"]?>) </label>

            <label for="op3" style="margin-left:25px;"> Inglés conversacional</label>
            <label >(<?php echo $cursosDePreferencia[1]["checked"]?>) </label>

            <label for="op4" style="margin-left:25px;"> Contabilidad</label>
            <label >(<?php echo $cursosDePreferencia[2]["checked"]?>) </label>

            <br/>

            <label for="op5" style="margin-left:25px;"> Ciencias en Educación Diversificada:</label>
            

            <label for="op6" style="margin-left:25px;"> Química</label>
            <label >(<?php echo $cursosDePreferencia[3]["checked"]?>) </label>

            <label for="op7" style="margin-left:25px;"> Física</label>
            <label >(<?php echo $cursosDePreferencia[4]["checked"]?>) </label>

            <label for="op8"  style="margin-left:25px;">Biología</label>
            <label >(<?php echo $cursosDePreferencia[5]["checked"]?>) </label>

            <br />
         
          </div>
        </div>
        <div  style="text-align:center;margin-top:35px;">
        <strong><span  style="font-size: 18px">MARQUE LAS MATERIAS QUE REPITE O NO HA GANADO:</span></strong><br>
      </div>
         <div style="width: 100%; border: solid 1px #000000;  font-size: 4mm; line-height: 150%;">
       
        <div style="display:inline-block;">

            <label for="op1"  style="margin-left:25px;">Español</label>
            <label >(<?php echo $cursosReprobados[0]["checked"]?>) </label>

            <label for="op2" style="margin-left:25px;"> Ciencias</label>
            <label >(<?php echo $cursosReprobados[1]["checked"]?>) </label>

            <label for="op3" style="margin-left:25px;"> Estudios Sociales</label>
            <label >(<?php echo $cursosReprobados[2]["checked"]?>) </label>

            <label for="op4" style="margin-left:25px;"> Matemática</label>
            <label >(<?php echo $cursosReprobados[3]["checked"]?>) </label>

            <label for="op5" style="margin-left:25px;"> Inglés</label>
            <label >(<?php echo $cursosReprobados[4]["checked"]?>) </label>

            <label for="op6" style="margin-left:25px;"> Cívica</label>
            <label >(<?php echo $cursosReprobados[5]["checked"]?>) </label>

            <label for="op8"  style="margin-left:25px;">Ética</label>
            <label >(<?php echo $cursosReprobados[6]["checked"]?>) </label> <br/>

            <label for="op7" style="margin-left:25px;"> Taller III ciclo</label>
            
            <label for="op9" style="margin-left:25px;"> Química</label>
            <label >(<?php echo $cursosReprobados[7]["checked"]?>) </label>

            <label for="op11" style="margin-left:25px;"> Física</label>
            <label >(<?php echo $cursosReprobados[8]["checked"]?>) </label>

             <label for="op10" style="margin-left:25px;"> Biología</label>
            <label >(<?php echo $cursosReprobados[9]["checked"]?>) </label>

            <br />
         
          </div>
          
        </div>
        <br/><br/>
        <div class="special">
            <table >
            <tr>
              
              <td style="width: 45%;text-align:left;" class="bottomRight"></td>
              <td style="width: 10%;"></td>
              <td style="width: 45%;text-align:left;" class="bottomRight"></td>
              
            </tr>
            <tr>
              
              <td style="width: 45%;text-align:center;" class="">
                <span style="font-size: 14px;"><strong><p>Firma del estudiante o encargado legal</p></strong></span>
              </td>
              <td style="width: 10%;"></td>
              <td style="width: 45%;text-align:center;" class="">
                 <span style="font-size: 14px;"><strong><p>Firma del profesor (a) que matricula</p></strong></span>
              </td>
               
              
            </tr>
          </table>
          </div>
  </div>
</page>
