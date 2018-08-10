<?php
	use app\models\SpReportesFiltroMes;

	$prueba = new SpReportesFiltroMes();
	$exec = $prueba->procedimiento('01/01/2016','09/08/2018','2017','50000','SUMI');


	


	echo count($exec);



	