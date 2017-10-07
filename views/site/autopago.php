<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Autorización de pago';
?>

	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script>

		function activav(){
			document.getElementById("vigencia").style.display = 'block';

		};

		function ocultv(){
			document.getElementById("vigencia").style.display = 'none';
			document.getElementById("mes").style.display = 'none';
		};
		
		function desbloqueov(){
			
			document.getElementById("mes").style.display = 'block';
		};
		
		function bloqueov(){
			document.getElementById("mes").style.display = 'none';
		};
		
		function desbloqueom(){
			document.getElementById("dscfuerza").disabled = false;
		};
		
		function bloqueom(){
			document.getElementById("dscfuerza").disabled = true;
		};

		
	var opcionesCodigo = new Array();
	var opcionesDescri = new Array();
	
  	$(function(){
		
		document.getElementById("dscESM2").disabled = true;
		document.getElementById("codESM2").disabled = true;
		document.getElementById("codFrz").disabled = true;
		document.getElementById("dscfuerza").disabled = true;
		document.getElementById("vigencia").style.display = 'none';
		document.getElementById("mes").style.display = 'none';
		
		var phpData = new Array();
		phpData = '<?php echo json_encode($FUERZA)?>';		

		var arrayPhp = JSON.parse(phpData);
		
		for (var i=0 ; i<arrayPhp.length ; i++){		
			opcionesCodigo.push(arrayPhp[i].COD_FUERZA);
			opcionesDescri.push(arrayPhp[i].NOM_FUERZA);
		}		
		
		var availableTags1 = opcionesCodigo;
    	$("#codFrz").autocomplete({
      		source: availableTags1,
      		select: function (e, ui) {		       
		        var value = ui.item.value;
		        for (var i=0 ; i<opcionesDescri.length ; i++){		
					if(value === opcionesCodigo[i]){
						$("#dscfuerza").focusin();
						$("#dscfuerza").val(opcionesDescri[i]);
						document.getElementById("codFrz").disabled = false;
						
				$.ajax({
					cache: false,					
					type: "POST",
					url: '<?php echo Url::toRoute(['site/esm']); ?>',
					data: $("#adi-form").serialize(), 
					success: function(data){
						
						//document.getElementById("dscESM").disabled = false;
						//document.getElementById("codESM").disabled = false;
						document.getElementById("inputViewer").innerHTML = '<div class="row"><div class="col-xs-3 col-sm-10"><div id="contenido"> </div>	<div class="form-group label-floating"><label for="dscESM" class="control-label">Escriba el nombre de la ESM</label><input type="text" class="form-control" id="dscESM"></div></div><div class="col-xs-9 col-sm-2"><div class="form-group label-floating"><label for="codESM" class="control-label"></label><input type="text" class="form-control" id="codESM" name="codesm" ></div></div></div>';
						
						//tuchocarepija();
						}
					});
						
					}
				}		
		    }
    	});
		
    	var availableTags2 = opcionesDescri;
    	$("#dscfuerza").autocomplete({
      		source: availableTags2,
      		select: function (e, ui) {		       
		        var value = ui.item.value;
		        for (var i=0 ; i<opcionesCodigo.length ; i++){		
					if(value === opcionesDescri[i]){
						
						$("#codFrz").focusin();
						$("#codFrz").val(opcionesCodigo[i]);
						document.getElementById("codFrz").disabled = false;
						
				$.ajax({
					cache: false,					
					type: "POST",
					url: '<?php echo Url::toRoute(['site/esm']); ?>',
					dataType: 'json',
					data: $("#adi-form").serialize(), 
					success: function(data){
						
						//document.getElementById("dscESM").disabled = false;
						//document.getElementById("codESM").disabled = false;
						
						var arrayDatos = $.map(data, function(value, index) {
		    			return [value];
						});
						
						document.getElementById("inputViewer").innerHTML = '<div class="row"><div class="col-xs-3 col-sm-10"><div id="contenido"> </div>	<div class="form-group label-floating"><label for="dscESM" class="control-label">Escriba el nombre de la ESM</label><input type="text" class="form-control" id="dscESM"></div></div><div class="col-xs-9 col-sm-2"><div class="form-group label-floating"><label for="codESM" class="control-label"></label><input type="text" class="form-control" id="codESM" name="codesm" ></div></div></div>';
						
						  tucho1 = arrayDatos[0];
						  tucho2 = arrayDatos[1];
						  
						  tuchocarepija(tucho1,tucho2);
						  
							console.log(tucho1);
							console.log(tucho2);
						}
					});
						
					}
				}		
		    }
    	});
		
  	});
	
	//////////////////////////////ESM///////////////////////////////////////
	
		var opcionesCodigoEsm = new Array();
		var opcionesDescriEsm = new Array();
		
		/*var tucho1;
		var tucho2;*/
	
	
		function tuchocarepija(tucho1,tucho2){		

				console.log(tucho1);
				console.log(tucho2);
				
				var phpDataEsm = new Array();
						
				var phpdata1  = tucho1;
				var phpdata2  = tucho2;
				
				/*var arrayPhpEsm = JSON.parse(phpDataEsm);
				
				console.log(arrayPhpEsm);
				
				for (var i=0 ; i<arrayPhpEsm.length ; i++){		
					opcionesCodigoEsm.push(arrayPhpEsm[i].CODI_ESM);
					opcionesDescriEsm.push(arrayPhpEsm[i].NOM_ESM);
				}		*/
				
				opcionesCodigoEsm = phpdata1.split('_*');
				opcionesDescriEsm = phpdata2.split('_*');
				
				
				var availableTags1Esm = opcionesCodigoEsm;
				$("#codESM").autocomplete({
					source: availableTags1Esm,
					select: function (ei, uii) {		       
						var value = uii.item.value;
						for (var i=0 ; i<opcionesDescriEsm.length ; i++){		
							if(value === opcionesCodigoEsm[i]){
								$("#dscESM").focusin();
								$("#dscESM").val(opcionesDescriEsm[i]);				
								
							}
						}		
					}
				});
				
				
				var availableTags2Esm = opcionesDescriEsm;
				$("#dscESM").autocomplete({
					source: availableTags2Esm,
					select: function (ei, uii) {		       
						var value = uii.item.value;
						for (var i=0 ; i<opcionesCodigoEsm.length ; i++){		
							if(value === opcionesDescriEsm[i]){
								$("#codESM").focusin();
								$("#codESM").val(opcionesCodigoEsm[i]);				
								
							}
						}		
					}
				});
				
			}
	</script>					
					
<?php
					$form = ActiveForm::begin([
					"method" => "POST",
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
						<li class="selected" data-value="#" OnClick='ocultv()'>Seleccione</li>
						<?php
						
						for($i=0;$i<count($MODALIDAD);$i++) {

										echo "<li data-value=".$MODALIDAD[$i]['COD_MODALIDAD']." OnClick='activav()'>".$MODALIDAD[$i]['NOM_MODALIDAD']."</li>";
										
									}
						?>
						</ul>
						<input type="hidden" id="modalidad" name="modalidad" value="1" class="form-control">
					</div>
				</div>		
			</div>
			<div class="col-xs-12 col-sm-4" name="vigencia" id="vigencia">
				<div class="form-group select-m">
					<label class="control-label" for="vigencia">
						Vigencia
					</label>

					<div class="mad-select" id="vigenciaSelect" >
						<ul>
						<li class="selected" data-value="#" OnClick='bloqueov()'>Seleccione</li>
						<?php
						
						for($i=0;$i<count($VIGENCIA);$i++) {

										echo "<li data-value=".$VIGENCIA[$i]['ANIO_VIGENCIA']." OnClick='desbloqueov()'>".$VIGENCIA[$i]['ANIO_VIGENCIA']."</li>";
										
									}
						?>
						</ul>
						<input type="hidden" id="vigencia" name="vigencia" value="1" class="form-control">
					</div>
				</div>		
			</div>
			<div class="col-xs-12 col-sm-4" name="mes" id="mes">
				<div class="form-group select-m">
					<label class="control-label" for="mesFact">
						Mes de facturación
					</label>

					<div class="mad-select" id="mesFactSelect">
						<ul>
							<li data-value="0" OnClick='bloqueom()'>Seleccionar</li>
							<li data-value="1" OnClick='desbloqueom()'>Enero</li>
							<li data-value="2" OnClick='desbloqueom()'>Febrero</li>
							<li data-value="3" OnClick='desbloqueom()'>Marzo</li>
							<li data-value="4" OnClick='desbloqueom()'>Abril</li>
							<li data-value="5" OnClick='desbloqueom()'>Mayo</li>
							<li data-value="6" OnClick='desbloqueom()'>Junio</li>
							<li data-value="7" OnClick='desbloqueom()'>Julio</li>
							<li data-value="8" OnClick='desbloqueom()'>Agosto</li>
							<li data-value="9" OnClick='desbloqueom()'>Septiembre</li>
							<li data-value="10" OnClick='desbloqueom()'>Octubre</li>
							<li data-value="11" OnClick='desbloqueom()'>Noviembre</li>
							<li data-value="12" OnClick='desbloqueom()'>Diciembre</li>
						</ul>
						<input type="hidden" id="mesFact" name="myOptions" value="0" class="form-control">
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
					<div class="form-group label-floating" id="log"><label for="codFrz" class="control-label"></label><input type="text" class="form-control" id="codFrz" name="codFrz"></div>
				</div>
			</div>
			<div name="inputViewer" id="inputViewer"><div class="row"><div class="col-xs-3 col-sm-10"><div id="contenido2"> </div>	<div class="form-group label-floating"><label for="dscESM2" class="control-label">Escriba el nombre de la ESM</label><input type="text" class="form-control" id="dscESM2"></div></div><div class="col-xs-9 col-sm-2"><div class="form-group label-floating"><label for="codESM2" class="control-label"></label><input type="text" class="form-control" id="codESM2" name="codesm2"></div></div></div></div>
			<div class="row">
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label for="rdn" class="control-label">Valor autorizado a pagar</label>
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="number" class="form-control" id="rdn">
						</div>
					</div>
				</div>
				<div class="col-xs-12 col-sm-6">
					<div class="form-group">
						<label for="rdn" class="control-label">Amortización anticipo</label>
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="number" class="form-control" id="amant">
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