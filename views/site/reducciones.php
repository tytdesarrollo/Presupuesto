<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Reducciones';
					
					?>
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>

<script>

		function activav(){
			document.getElementById("vigencia").style.display = 'block';
		};

		function ocultv(){
			document.getElementById("vigencia").style.display = 'none';
		};
		
		function desbloqueov(){
			document.getElementById("dscfuerza").disabled = false;
		};
		
		function bloqueov(){
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
								bandera = 1;
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
						<input type="hidden" id="vigenciaIN" name="vigencia" value="1" class="form-control">
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
						<label for="adn" class="control-label">Valor de la reducción</label>
						<div class="input-group">
							<span class="input-group-addon">$</span>
							<input type="number" class="form-control" id="adn">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="panel-footer clearfix" id="divbotonagregar">
		<div class="form-group pull-right">
			<a class="btn btn-primary btn-raised" id="btnAddOptn" onclick="agregarItemLista()">Agregar</a>
		</div>
	</div>
		</div>
<div class="content-list-operations" id="listaItems">
	<div class="list-operations">
		<div class="title-list-op">
			<h3 class="fnt__Medium text-center">Listado de operaciones</h3>
		</div>
		<div id="divListas">
			
		</div>
	</div>
	<div class="cnt-btns-action-op">
		<div class="cnt-btn-clean">
			<a href="#" class="btn btn-clean" onclick="eliminarLista()">Limpiar listado</a>
		</div>
		<div class="cnt-btn-save">
			<a href="#" class="btn btn-save" onclick="guardarListado()">Guardar</a>
		</div>
	</div>
</div>

<?php ActiveForm::end(); ?>

<script type="text/javascript">
	var arrayNumDoc = new Array();
	var arrayFecMov = new Array();
	var arrayFecAut = new Array();
	var arrayModalidad = new Array();
	var arrayVigencia = new Array();
	var arrayCodigosFuerza = new Array();
	var arrayCodigosEsm = new Array();
	var arrayAutPagar = new Array();

	function agregarItemLista(){
		var codidoD = document.getElementById("numMov").value;
		var fechMov = document.getElementById("fMovinput").value;
		var fechAut = document.getElementById("finput").value;
		var codigoM = document.getElementById("modalidad").value;
		var codigoV = document.getElementById("vigenciaIN").value;
		var codigoF = document.getElementById("codFrz").value;
		var codigoE = document.getElementById("codESM").value;
		var pagoAut = document.getElementById("adn").value;

		arrayNumDoc.push(codidoD);
		arrayFecMov.push(fechMov);
		arrayFecAut.push(fechAut);
		arrayModalidad.push(codigoM);
		arrayVigencia.push(codigoV);
		arrayCodigosFuerza.push(codigoF);
		arrayCodigosEsm.push(codigoE);
		arrayAutPagar.push(pagoAut);

		mostrarListado();
	}

	function mostrarListado(){
		var listado = '';

		for(var i=0 ; i<arrayCodigosFuerza.length ; i++){
			listado = listado +					
				'<div class="list-item-op">'+
					'<div class="cnt-btn-op">'+
						'<a onclick="eliminarItemLista('+i+')" class="btn-remove-op">'+
							'<i class="material-icons">&#xE14C;</i>'+
						'</a>'+
					'</div>'+
					'<dl class="info-op">'+
						'<dt>ESM</dt>'+
						'<dd>'+arrayCodigosEsm[i]+'</dd>'+
					'</dl>'+
					'<dl class="info-op">'+
						'<dt>Fuerza</dt>'+
						'<dd>'+arrayCodigosFuerza[i]+'</dd>'+
					'</dl>'+
					'<div class="cnt-v-op">'+
						'<dl class="info-op">'+
							'<dt>Valor de reducción</dt>'+
							'<dd>$'+arrayAutPagar[i]+'</dd>'+
						'</dl>'+
					'</div>'+
				'</div>';
		}

		document.getElementById("divListas").innerHTML = listado;
	}

	function eliminarItemLista(posicionEliminar){
		var arrayTempNumDoc = new Array();
		var arrayTempFecMov = new Array();
		var arrayTempFecAut = new Array();
		var arrayTempModalidad = new Array();
		var arrayTempVigencia = new Array();
		var arrayTempCodigosFuerza = new Array();
		var arrayTempCodigosEsm = new Array();
		var arrayTempAutPagar = new Array();				

		for(var i=0 ; i<arrayCodigosFuerza.length ; i++){
			if(i != posicionEliminar){
				arrayTempNumDoc.push(arrayNumDoc);
				arrayTempFecMov.push(arrayFecMov);
				arrayTempFecAut.push(arrayFecAut);
				arrayTempModalidad.push(arrayModalidad);
				arrayTempVigencia.push(arrayVigencia);
				arrayTempCodigosFuerza.push(arrayCodigosFuerza[i]);
				arrayTempCodigosEsm.push(arrayCodigosEsm[i]);
				arrayTempAutPagar.push(arrayAutPagar[i]);
			}
		}

		arrayNumDoc = arrayTempNumDoc;
		arrayFecMov = arrayTempFecMov;
		arrayFecAut = arrayTempFecAut;
		arrayModalidad = arrayTempModalidad;
		arrayVigencia = arrayTempVigencia;
		arrayCodigosFuerza = arrayTempCodigosFuerza;
		arrayCodigosEsm = arrayTempCodigosEsm;
		arrayAutPagar = arrayTempAutPagar;

		if(arrayCodigosFuerza.length == 0){
			$("#listaItems").removeClass("list-operations-visible");		
			$("#contform").removeClass("list-operations-visible");	
		}

		mostrarListado();
	}

	function eliminarLista(){


	swal({
		title: '¿Esta seguro?',
		text: "¿Realmente desea eliminar la lista?",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#009688',
		cancelButtonColor: '#d33',
		cancelButtonText: 'No, cancelar!',
		confirmButtonText: 'Si, eliminar!'
	}).then(function () {
		arrayCodigosFuerza = new Array();
		arrayCodigosEsm = new Array();
		arrayAutPagar = new Array();
		arrayAutAntic = new Array(); 

		$("#listaItems").removeClass("list-operations-visible");		
		$("#contform").removeClass("list-operations-visible");		

		swal(
			'Eliminado!',
			'La lista ha sido eliminada correctamente.',
			'success'
		)
	})
				
	}

	function guardarListado(){

		$.ajax({
			url:'<?php echo Url::toRoute(['site/guardarareduccion']); ?>',
			method: "GET",
			data: {'numdoc':arraytoChar(arrayNumDoc),
				   'fecmov':arraytoChar(arrayFecMov),
				   'fecaut':arraytoChar(arrayFecAut),
				   'modalidad':arraytoChar(arrayModalidad),
				   'vigencia':arraytoChar(arrayVigencia),
				   'fuerza':arraytoChar(arrayCodigosFuerza),
				   'esm':arraytoChar(arrayCodigosEsm),
				   'autpag':arraytoChar(arrayAutPagar)},
			success: function (data) {						
				swal("Operacion completa", "Datos guardados correctamente", "success");				
			},
			error: function (error) {
			    swal("Error al guardar", "No se han podido almacenar los datos en la base de datos", "error");
			}
		});
		
	}

	function arraytoChar(array){
		var cadena = '';

		for(var i=0 ; i<array.length ; i++){
			cadena = cadena+array[i]+',';
		}

		cadena = cadena.substring(0,(cadena.length-1))

		return cadena;
	}

	$(botonAgregar());

	var bandera = 0;
	function botonAgregar(){		
		var codidoD = document.getElementById("numMov").value;	
		var pagoAut = document.getElementById("adn").value;
		

		if (pagoAut == "" || bandera == 0 || codidoD == "") {		
		console.log(bandera)	;
			document.getElementById("divbotonagregar").style.display = 'none';
		}else{			
			document.getElementById("divbotonagregar").style.display = 'block';
		}
	}setInterval(botonAgregar,1000);
	
	
</script>