<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'Resultados presupuesto consolidado';
?>
<script src="https://code.highcharts.com/highcharts.src.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<div class="site-index">
	<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-6">
			<div class="panel bg-dark-54 panel-mini-info">
				<div class="panel-body">
					<div class="lab-info dis-inline-block">
						Anticipo
					</div>
					<div class="cont-info dis-inline-block"><span>$35.000.000.000,00</span></div>
				</div>
			</div>
		</div>
		<div class="col-xs-12 col-sm-6">
			<div class="panel bg-dark-54 panel-mini-info">
				<div class="panel-body">
					<div class="lab-info dis-inline-block">
						Total amortizado
					</div>
					<div class="cont-info dis-inline-block"><span>$<?=$total?></span></div>
				</div>
			</div>
		</div>
	</div>
	</div>
	<div class="container">
		<div class="row">
			<div class="col-md-8">
				<div class="panel panel-default panel-vigencias">
					<div class="panel-body">
						<div class="row">
							<div class="col-xs-12">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
												<th></th>
												<th>Valor Presupuesto</th>
												<th>Valor autorizado a pagar</th>
												<th>Saldo</th>
											</tr>
										</thead>
										<tbody>
											<tr class="divider"></tr>
											<?php foreach ($spreportesmain as $key): ?>		
											<?php $ano = intval(preg_replace('/[^0-9]+/', '', $key['VIGEN']), 10) ?>	
											<?php $onclick = 'onclick="graficar('.$key['VALOR_AUTO'].','.$key['SALDO'].','.$ano.')"';?>									
												<tr <?=$onclick?>>
													<td><?=$key['VIGEN']?></td>
													<td>$<?=number_format($key['VALOR_PRE'], 2, ',', '.')?></td>
													<td>$<?=number_format($key['VALOR_AUTO'], 2, ',', '.')?></td>
													<td>$<?=number_format($key['SALDO'], 2, ',', '.')?></td>
												</tr>										
											<?php endforeach ?>																					
											<tr class="divider"></tr>
														
											<tr class="primary" onClick="primeraGrafica()">
												<td><?=$totalarr['VIGEN']?></td>
												<td>$<?=number_format($totalarr['VALOR_PRE'], 2, ',', '.')?></td>
												<td>$<?=number_format($totalarr['VALOR_AUTO'], 2, ',', '.')?></td>
												<td>$<?=number_format($totalarr['SALDO'], 2, ',', '.')?></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="panel panel-default">
					<div class="panel-body">
						<h4 class="fnt__Medium text-center">Presupuesto - <span id="numeroVigencia">Vigencia 2017</span></h4>
						<div id="chart"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$(primeraGrafica());

	function primeraGrafica(){
		var valorAutorizado = <?=$totalarr['VALOR_AUTO']?>;
		var valorSaldo = <?=$totalarr['SALDO']?>;
		var vigencia = 'Total'

		//valor del presupuesto
		var valorTotal;		
		valorTotal = valorAutorizado + valorSaldo;

		
		// porcentaje equivalente a cada valor  con el presupuesto 
		var porcentajeEquiv1;
		var porcentajeEquiv2;
		porcentajeEquiv1 = porcentaje(valorTotal, valorAutorizado);
		porcentajeEquiv2 = porcentaje(valorTotal, valorSaldo);

		var valorGrafico1 = valorGrafico(porcentajeEquiv1);
		var valorGrafico2 = valorGrafico(porcentajeEquiv2);

		vistaGrafica(porcentajeEquiv2, porcentajeEquiv1);

		document.getElementById("numeroVigencia").innerHTML = 'Vigencia '+vigencia;
	}

	function graficar(valorAutorizado, valorSaldo, vigencia){
		//valor del presupuesto
		var valorTotal;		
		valorTotal = valorAutorizado + valorSaldo;

		
		// porcentaje equivalente a cada valor  con el presupuesto 
		var porcentajeEquiv1;
		var porcentajeEquiv2;
		porcentajeEquiv1 = porcentaje(valorTotal, valorAutorizado);
		porcentajeEquiv2 = porcentaje(valorTotal, valorSaldo);

		var valorGrafico1 = valorGrafico(porcentajeEquiv1);
		var valorGrafico2 = valorGrafico(porcentajeEquiv2);

		vistaGrafica(porcentajeEquiv2, porcentajeEquiv1);

		document.getElementById("numeroVigencia").innerHTML = 'Vigencia '+vigencia;
	}

	function porcentaje(valorTotal, valorX){
		// porcentaje equivalente
		var porcentaje;
		porcentaje = (100*valorX)/(valorTotal);

		return porcentaje;
	}

	function valorGrafico(porcentaje){
		//valor que va en la grafica representando el porcentaje
		var valorGrafico;
		valorGrafico = (80.36*porcentaje)/100

		return valorGrafico;
	}
	
	function vistaGrafica(valor1, valor2){
		Highcharts.chart('chart', {
	    chart: {
	        plotBackgroundColor: null,
	        plotBorderWidth: null,
	        plotShadow: false,
	        type: 'pie'
	    },
		colors: ['#00b7a6', '#434348', '#90ed7d', '#f7a35c', '#8085e9', 
	   '#f15c80', '#e4d354', '#2b908f', '#f45b5b', '#91e8e1'],
	    title: {
	        text: ''
	    },
	    tooltip: {
	        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
	    },
		plotOptions: {
	        pie: {
	            allowPointSelect: true,
	            cursor: 'pointer',
	            dataLabels: {
	                enabled: false
	                },
					showInLegend: true
	        }
	    },
	    series: [{
	        name: 'Presupuesto',
	        colorByPoint: true,
	        data: [{
	            name: 'Saldo',
	            y: valor1
	        }, {
	            name: 'Autorizaciones de Pago',
	            y: valor2,
	            sliced: true,
	            selected: true
	        }]
	    }]
	});
	}
</script>