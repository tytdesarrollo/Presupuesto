<?PHP //VAR_DUMP($DATO[0]) ?>

<?php
								
									foreach($DATO as $row):
									
									endforeach;

				
									for($i=0;$i<count($row);$i++) {

										$row[$i]['COD_FUERZA'].'<br />';
										$row[$i]['NOM_FUERZA'].'<br />';
										
										$items = array( $row[$i]['NOM_FUERZA']=>$row[$i]['COD_FUERZA']);

									}
									
									VAR_DUMP($items);
								 ?>
								