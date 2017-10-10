<?PHP //VAR_DUMP($DATO[0]) ?>

<?php
								
									foreach($DATO as $row):
									
									endforeach;

									$codigos = "";
									$desc = "";
									for($i=0;$i<count($row);$i++) {

										$codigos = $codigos.$row[$i]['CODI_ESM'].'_*';
										$desc = $desc.$row[$i]['NOM_ESM'].'_*';									
										

									}
									
									$items = array($codigos,$desc);
									
									VAR_DUMP($items);
								 ?>
								