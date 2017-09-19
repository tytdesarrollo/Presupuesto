<?php
$this->title = 'Excel';

//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");

$table = "<table cellpadding='0' cellspacing='0' id='sheet0' border='0'>
		<tbody>
		  <tr style = 'font-weight:bold'>
			<td>".$RAZON_SOCIAL."</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr style = 'font-weight:bold'>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr style = 'font-weight:bold'>
			<td>".$CABEZERA[1]."</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr style = 'font-weight:bold'>
			<td>&nbsp;</td>
			<td>Representante Legal:</td>
			<td>NIT:</td>
			<td>Vigencia:</td>
			<td>Fecha:</td>
			<td>Periodo de rendici&oacute;n</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>VALORES EN PESOS</td>
			<td>".$CABEZERA[2]."</td>
			<td>".$CABEZERA[3]."</td>
			<td>".$CABEZERA[4]."</td>
			<td>".$CABEZERA[5]."</td>
			<td>De ".$IN_PERIODO1." a ".$IN_PERIODO2."</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  <tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		  </tr>
		  </tbody>
			</table>
			
		<table cellpadding='0' cellspacing='0' id='sheet0' border='1'>		
		<thead>
			<tr style='background:#8BC34A; color:#000; font-weight:bold'>
			  <th>
				ESTABLECIMIENTO DE SANIDAD MILITAR
			  </th>
			  <th>
				TIPO DE PROCESO (Dispensacion, Requisicion, Suministro)
			  </th>
			  <th>
				PRESUPUESTO INCIAL
			  </th>
			  <th>
				ADICIONES 
			  </th>
			  <th>
				REDUCCIONES 
			  </th>
			  <th>
				PRESUPUESTO DEFINITIVO
			  </th>
			  <th>
				AUTORIZACION PAGO
			  </th>
			  <th>
				SALDO POR EJECUTAR
			  </th>
			</tr>
		  </thead>
		  <tbody>
		  <tr>
			<td><table cellpadding='0' cellspacing='0' id='sheet0' border='1'><tbody>";
			
		foreach($BLOQUE1_ARR as $BLOQUE1_ARR1){
		$table.='<tr style="text-align: left;"><td>'.utf8_decode($BLOQUE1_ARR1).'</td></tr>';
		}
			
			$table.="</tbody></table></td>
			<td><table cellpadding='0' cellspacing='0' id='sheet0' border='1'><tbody>";
			
		foreach($BLOQUE2_ARR as $BLOQUE2_ARR2){
		$table.='<tr><td>'.$BLOQUE2_ARR2.'</td></tr>';
		}
			
			$table.="</tbody></table></td>
			<td><table cellpadding='0' cellspacing='0' id='sheet0' border='1'><tbody>";
			
		foreach($BLOQUE3_ARR as $BLOQUE3_ARR3){
		$table.='<tr><td>'.$BLOQUE3_ARR3.'</td></tr>';
		}
			
			$table.="</tbody></table></td>
			<td><table cellpadding='0' cellspacing='0' id='sheet0' border='1'><tbody>";
			
		foreach($BLOQUE4_ARR as $BLOQUE4_ARR4){
		$table.='<tr><td>'.$BLOQUE4_ARR4.'</td></tr>';
		}
			
			$table.="</tbody></table></td>
			<td><table cellpadding='0' cellspacing='0' id='sheet0' border='1'><tbody>";
			
		foreach($BLOQUE5_ARR as $BLOQUE5_ARR5){
		$table.='<tr><td>'.$BLOQUE5_ARR5.'</td></tr>';
		}
			
			$table.="</tbody></table></td>
			<td><table cellpadding='0' cellspacing='0' id='sheet0' border='1'><tbody>";
			
		foreach($BLOQUE_F as $BLOQUE_F1){
		$table.='<tr><td>'.$BLOQUE_F1.'</td></tr>';
		}
			
			$table.="</tbody></table></td>
			<td><table cellpadding='0' cellspacing='0' id='sheet0' border='1'><tbody>";
			
		foreach($BLOQUE7_ARR as $BLOQUE7_ARR7){
		$table.='<tr><td>'.$BLOQUE7_ARR7.'</td></tr>';
		}
			
			$table.="</tbody></table></td>
			<td><table cellpadding='0' cellspacing='0' id='sheet0' border='1'><tbody>";
			
		foreach($BLOQUE_H as $BLOQUE_H1){
		$table.='<tr><td>'.$BLOQUE_H1.'</td></tr>';
		}
			
			$table.="</tbody></table></td>
		  </tr>
		  </tbody>
		  </table>";
		  /*
		foreach($BLOQUE1_ARR as $BLOQUE1_ARR1){
		$table.='<tr><td>'.$BLOQUE1_ARR1.'</td></tr>';
		}
		*/
 
 echo $table;
?>
