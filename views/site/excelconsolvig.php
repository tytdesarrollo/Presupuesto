<?php
$this->title = 'Excel';
/*
//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=Reporte.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");
*/

$table = "<table cellpadding='0' cellspacing='0' id='sheet0' border='1'>		
		<thead>
			<tr style='background:#8BC34A; color:#000; font-weight:bold'>";
			
			 foreach($DATO as $row):
															
				$table.= "<th>".$row."</th>";									
											
								endforeach;
				$table.="</tr>
		  </thead>
		    <tbody>";
			
			foreach($COLUMN_ARR as $COLUMN_ARR2):
															
				$table.=$COLUMN_ARR2;								
											
								endforeach;
								
	/*		$table.="</tbody></table></td>
			<td><table cellpadding='0' cellspacing='0' id='sheet0' border='1'><tbody>";
			
			foreach($DESCRIPCION_ARR as $DESCRIPCION_ARR2):
															
				$table.='<tr><td>'.$DESCRIPCION_ARR2.'</td></tr>';								
											
								endforeach;
								
			$table.="</tbody></table></td>
			<td><table cellpadding='0' cellspacing='0' id='sheet0' border='1'><tbody>";
			
			foreach($PRESU_INI_ARR as $PRESU_INI_ARR2):
															
				$table.='<tr><td>'.$PRESU_INI_ARR2.'</td></tr>';								
											
								endforeach;
								
			$table.="</tbody></table></td>
			<td><table cellpadding='0' cellspacing='0' id='sheet0' border='1'><tbody>";
			
			foreach($ADICIONES_ARR as $ADICIONES_ARR2):
															
				$table.='<tr><td>'.$ADICIONES_ARR2.'</td></tr>';								
											
								endforeach;
								
			$table.="</tbody></table></td>
			<td><table cellpadding='0' cellspacing='0' id='sheet0' border='1'><tbody>";
			
			foreach($REDUCCION_ARR as $REDUCCION_ARR2):
															
				$table.='<tr><td>'.$REDUCCION_ARR2.'</td></tr>';								
											
								endforeach;
								
			$table.="</tbody></table></td>
			<td><table cellpadding='0' cellspacing='0' id='sheet0' border='1'><tbody>";
			
			foreach($PRESU_DEFI_ARR as $PRESU_DEFI_ARR2):
															
				$table.='<tr><td>'.$PRESU_DEFI_ARR2.'</td></tr>';								
											
								endforeach;
 */
 echo $table;
?>