<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Adiciones';
					
					?>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script>
	var opcionesCodigo = new Array();
	var opcionesDescri = new Array();
	
  	$(function(){

		var phpData = new Array();
		phpData = '<?php echo json_encode($FUERZA)?>';		

		var arrayPhp = JSON.parse(phpData);
		

		for (var i=0 ; i<arrayPhp.length ; i++){		
			opcionesCodigo.push(arrayPhp[i].COD_FUERZA);
			opcionesDescri.push(arrayPhp[i].NOM_FUERZA);
		}		

    	var availableTags1 = opcionesCodigo;
    	$("#codfuerza").autocomplete({
      		source: availableTags1
    	});

    	var availableTags2 = opcionesDescri;
    	$("#dscfuerza").autocomplete({
      		source: availableTags2
    	});
  	});

	$(document).ready(function () {
		/////////////////////////////////////////////
	    $("#dscfuerza").keyup(function () {
	        var value = $(this).val();
	        for (var i=0 ; i<opcionesCodigo.length ; i++){		
				if(value === opcionesDescri[i]){					
					$("#codfuerza").focusin();
					$("#codfuerza").val(opcionesCodigo[i]);
				}
			}		        
	    });
	   
	});
	</script>					
					
				<?php
					$form = ActiveForm::begin([
					"method" => "post",
					"id" => "adi-form",
					"enableClientValidation" => false,
					"enableAjaxValidation" => true,
					]); 
				?>	
					
			<div class="panel panel-default panel-operations">
	<div class="panel-body">
		<div class="row">
			<div class="col-xs-12 col-sm-2">
				<div class="content__num-mov input-group">
					<label for="numMov" class="num-mov-label input-group-addon fnt__Medium">#</label>
					<input class="form-control" id="numMov" name="finput" type="text">
				</div>
			</div>
			<div class="col-xs-12 col-sm-5">
				<div class="row">
					<div class="col-xs-6 col-sm-7">
						<div class="content__label-fauto">
							<label for="" class="control-label">Fecha movimiento:</label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-5">
						<div class="content__f-input pull-right">
							<div class="form-group">
								<input class="form-control" id="fMovinput" name="finput" type="text" data-type="date" required="true" value="<?= date("d/m/y")?>" disabled>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xs-12 col-sm-5 pull-right">
				<div class="row">
					<div class="col-xs-6 col-sm-7">
						<div class="content__label-fauto">
							<label for="" class="control-label">Fecha autorización:</label>
						</div>
					</div>
					<div class="col-xs-6 col-sm-5">
						<div class="content__f-input pull-right">
							<div class="form-group">
								<input class="form-control" id="finput" name="finput" type="text" data-type="date" required="true" value="<?= date("d/m/y")?>">
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-12 col-sm-4">
				<div class="form-group select-m">
					<label class="control-label" for="modalidad">
						Modalidad
					</label>

					<div class="mad-select" id="modalidadSelect">
						<ul>
						<li class="selected" data-value="#">Seleccione</li>
						<?php
						
						for($i=0;$i<count($MODALIDAD);$i++) {

										echo "<li data-value=".$MODALIDAD[$i]['COD_MODALIDAD'].">".$MODALIDAD[$i]['NOM_MODALIDAD']."</li>";
										
									}
						?>
						</ul>
						<input type="hidden" id="modalidad" name="myOptions" value="1" class="form-control">
					</div>
				</div>		
			</div>
			<div class="col-xs-12 col-sm-4">
				<div class="form-group select-m">
					<label class="control-label" for="vigencia">
						Vigencia
					</label>

					<div class="mad-select" id="vigenciaSelect">
						<ul>
						<li class="selected" data-value="#">Seleccione</li>
						<?php
						
						for($i=0;$i<count($VIGENCIA);$i++) {

										echo "<li data-value=".$VIGENCIA[$i]['ANIO_VIGENCIA'].">".$VIGENCIA[$i]['ANIO_VIGENCIA']."</li>";
										
									}
						?>
						</ul>
						<input type="hidden" id="vigencia" name="myOptions" value="1" class="form-control">
					</div>
				</div>		
			</div>
		</div>
		<hr class="div-op">
		<div id="cntOptn" class="content-operations">
			<div class="content__title-opration">
				<h2 class="fnt__Medium text-center"><?= Html::encode($this->title) ?></h2>
			</div>
			<div class="row">
				<div class="col-xs-3 col-sm-10">
					
					<div class="form-group label-floating"><label for="dscfuerza" class="control-label">Escriba el nombre de la Fuerza</label><input type="text" class="form-control" id="dscfuerza"></div>
				</div>
				<div class="col-xs-9 col-sm-2">
					<div class="form-group label-floating" id="log"><label for="codfuerza" class="control-label"></label><input type="text" class="form-control" id="codfuerza" disabled></div>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-3 col-sm-10">
					<div class="form-group label-floating"><label for="dscESM" class="control-label">Escriba el nombre de la ESM</label><input type="text" class="form-control" id="dscESM"></div>
				</div>
				<div class="col-xs-9 col-sm-2">
				<div class="form-group label-floating"><label for="codESM" class="control-label"></label><input type="text" class="form-control" id="codESM" disabled></div>
					
				</div>
			</div>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label for="adn" class="control-label">Valor de la adición</label>
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="text" class="form-control" id="adn">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-footer clearfix">
		<div class="form-group pull-right">
			<?= Html::a('Agregar', '#cntOptn', ['id' => 'btnAddOptn', 'class'=>'btn btn-primary btn-raised']) ?>
		</div>
	</div>
		</div>
		<div class="content-list-operations">
	<div class="list-operations">
		<div class="title-list-op">
			<h3 class="fnt__Medium text-center">Listado de operaciones</h3>
		</div>
		<div class="list-item-op">
			<div class="cnt-btn-op">
				<a href="#" class="btn-remove-op">
					<i class="material-icons">&#xE14C;</i>
				</a>
			</div>
			<dl class="info-op">
				<dt>ESM</dt>
				<dd>123456789</dd>
			</dl>
			<dl class="info-op">
				<dt>Fuerza</dt>
				<dd>70000</dd>
			</dl>
			<div class="cnt-v-op">
				<dl class="info-op">
					<dt>Valor autorizado</dt>
					<dd>$100.000.000</dd>
				</dl>
				<dl class="info-op">
					<dt>Amortización</dt>
					<dd>$100.000.000</dd>
				</dl>
			</div>
		</div>
	</div>
	<div class="cnt-btns-action-op">
		<div class="cnt-btn-clean">
			<a href="#" class="btn btn-clean">Limpiar listado</a>
		</div>
		<div class="cnt-btn-save">
			<a href="#" class="btn btn-save">Guardar</a>
		</div>
	</div>
	</div>
	<?php ActiveForm::end(); ?>
	
	
	
