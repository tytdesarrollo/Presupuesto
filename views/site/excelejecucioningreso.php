<?php
$this->title = 'Excel';

//Inicio de exportación en Excel
header('Content-type: application/vnd.ms-excel');
header("Content-Disposition: attachment; filename=REPORTE_RECOMPOSICION_PRESUPUESTO.xls"); //Indica el nombre del archivo resultante
header("Pragma: no-cache");
header("Expires: 0");
/*
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
 
 echo $table;*/
?>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<table class="table table-bordered">	
	<?php foreach ($cabRecompPresu as $key): ?>
		<thead>		
			<tr style = 'font-weight:bold'>
				<th class="text-center"><?=$key['EMPRESA']?></th>
			</tr>
			<tr>
				<th></th>
			</tr>
			<tr style = 'font-weight:bold'>
				<th class="text-center"><?=$key['NOMBRE_REPORTE']?></th>
			</tr>	
			<tr>
				<th></th>
			</tr>
			<tr>
				<th class="text-center">REPRESENTANTE</th>
				<th class="text-center">NIT</th>
				<th class="text-center">VIGENCIA</th>
				<th class="text-center">FECHA</th>
				<th class="text-center">PERIODO DE INICIO DEL REPORTE</th>
				<th class="text-center">PERIODO DE FIN DEL REPORTE</th>
				<th class="text-center">FUERZA</th>
				<th class="text-center">MODALIDAD</th>
			</tr>			
		</thead>
		<tbody>
			<tr>
				<td class="text-center"><?=utf8_decode($key['REPRESENTANTE'])?></td>
				<td class="text-center"><?=utf8_decode($key['NIT'])?></td>
				<td class="text-center"><?=utf8_decode($key['VIGENCIA'])?></td>
				<td class="text-center"><?=utf8_decode($key['FECHA_HOY'])?></td>
				<td class="text-center"><?=utf8_decode($key['FECHA_INI'])?></td>
				<td class="text-center"><?=utf8_decode($key['FECHA_FIN'])?></td>
				<td class="text-center"><?=utf8_decode($key['FUERZA'])?></td>
				<td class="text-center"><?=utf8_decode($key['MODALIDAD'])?></td>
			</tr>
		</tbody>
	<?php endforeach ?>					
</table>

<br>

<table class="table table-bordered table-striped" style="text-align: center;">
	<thead>
		<tr style="background:#8BC34A; color:#000; font-weight:bold">
			<?php for ($i = 0; $i < $cantidad; $i++){ ?>
				<th class="text-center"><?=utf8_decode($nombreColExc[$i])?></th>
			<?php } ?>
		</tr>
	</thead>
	<tbody>
		<?php foreach ($spPresuRecomp as $key): ?>
			<tr class="divider">
				<?php for ($i = 0; $i < $cantidad; $i++){ ?>
					<td><?=utf8_decode($key[$columnas[$i]])?></td>
				<?php } ?>
			</tr>
		<?php endforeach ?>		
	</tbody>
</table>