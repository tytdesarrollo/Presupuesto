<?php

/* @var $this yii\web\View */
use yii\helpers\Html;

$this->title = 'Resultados presupuesto consolidado';
?>
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
					<div class="cont-info dis-inline-block"><span>$100.000.000,00</span></div>
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
											<tr>
												<td>Vigencia 2015</td>
												<td>$xxx.xxx.xxx.xx</td>
												<td>$xxx.xxx.xxx.xx</td>
												<td>$xxx.xxx.xxx.xx</td>
											</tr>
											<tr>
												<td>Vigencia 2016</td>
												<td>$xxx.xxx.xxx.xx</td>
												<td>$xxx.xxx.xxx.xx</td>
												<td>$xxx.xxx.xxx.xx</td>
											</tr>
											<tr>
												<td>Vigencia 2017</td>
												<td>$xxx.xxx.xxx.xx</td>
												<td>$xxx.xxx.xxx.xx</td>
												<td>$xxx.xxx.xxx.xx</td>
											</tr>
											<tr>
												<td>Vigencia 2018</td>
												<td>$xxx.xxx.xxx.xx</td>
												<td>$xxx.xxx.xxx.xx</td>
												<td>$xxx.xxx.xxx.xx</td>
											</tr>
											<tr class="divider"></tr>
											<tr class="primary">
												<td>Presupuesto total</td>
												<td>$xxx.xxx.xxx.xx</td>
												<td>$xxx.xxx.xxx.xx</td>
												<td>$xxx.xxx.xxx.xx</td>
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
						<h4 class="fnt__Medium text-center">Presupuesto - Vigencia 2017</h4>
						<div id="chart"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
