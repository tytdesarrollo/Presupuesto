<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Ejecución Presupuestal';
?>
<?php 	
	/*$form = ActiveForm::begin([
		"method" => "get",
		'action' => ['site/excel'],
		"id" => "compro-form",
		"enableClientValidation" => false,
		"enableAjaxValidation" => false,]); */
?>
<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>	


<div class="mod-docs">
	<div class="mod-docs-header bg-teal-std">
	</div>
	<div class="mod-docs-body container">
		<div class="row">
			<div class="box-circle">
				<svg version="1.1" id="circle" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="400px" height="400px" viewBox="0 0 400 400" enable-background="new 0 0 400 400" xml:space="preserve">
					<path fill="#FFFFFF" d="M400,201H0C0,90,89.543,1,200,1S400,90,400,201z"/>
				</svg>
			</div>
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="box-certingreso-drw">
							<img src="img/certingreso_drw.svg" alt="Ejecución Presupuestal">
						</div>
						<h2 class="fnt__Medium text-center mrg__bottom-20"><?= Html::encode($this->title) ?></h2>
						<div class="row">
							<div class="col-xs-12 col-sm-6 pull-right">
								<div class="row">
									<div class="col-xs-6 col-sm-12">
										<div class="content-ppto__f-hoy">
											<span class="ppto__f-hoy fnt__Medium"><?= date("d/m/y")?></span>
										</div>
									</div>
									<div class="col-xs-6 col-sm-12">
										<div class="pull-right">
											<span class="fnt__Medium txt__dark-54"></span>
											<span class="ppto__vig fnt__Medium"></span>
										</div>
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<p class="ppto__r-social"><?= $nombre?></p>
								<p class="ppto__nit fnt__Medium">Nit <?= $nit?></p>
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-xs-9 col-sm-10">
								<div class="form-group label-floating"><label for="dscFrz" class="control-label">Escriba el nombre de la Fuerza</label><input type="text" class="form-control" id="dscFrz" value=""></div>
							</div>
							<div class="col-xs-3 col-sm-2">
								<div class="form-group label-floating"><label for="codFrz" class="control-label"></label><input type="text" class="form-control" id="codFrz" name="codFrz" required="true" value=""></div>
							</div>
						</div>
						<div class="row">
							<div class="col-xs-12 col-sm-6">
								<div class="form-group select-m">
									<label class="control-label" for="modalidad">
										Modalidad
									</label>
									<div class="mad-select" id="modalidadSelect">
										<ul>
											<li data-value="1">Seleccionar</li>

											<?php foreach ($modalidad as $key): ?>
												<li data-value="<?=$key['COD_MODALIDAD']?>"><?=$key['NOM_MODALIDAD']?></li>
											<?php endforeach ?>											

										</ul>
										<input type="hidden" id="modalidad" name="modalidad" value="1" class="form-control" required="true">
									</div>
								</div>
							</div>
							<div class="col-xs-12 col-sm-6">
								<div class="form-group select-m">
									<label class="control-label" for="vigencia">
										Vigencia
									</label>
									<div class="mad-select" id="vigenciaSelect" >
										<ul>
											<li data-value="1">Seleccionar</li>
											<?php foreach ($vigencia as $key): ?>
												<li onclick="startFecha(<?=$key['ANIO_VIGENCIA']?>)" data-value="<?=$key['ANIO_VIGENCIA']?>"><?=$key['ANIO_VIGENCIA']?></li>
											<?php endforeach ?>													
										</ul>
										<input  type="hidden" id="vigencia" name="vigencia" value="1" class="form-control" required="true">
									</div>
								</div>		
							</div>
						</div>
						<hr>
						<div class="row">
							<div class="col-sm-12">
								<h3 class="text-center">Selecciona el periodo a consultar</h3>
									<div class="row">
										<div class="col-xs-12 col-sm-10 col-sm-offset-1">
											<div class="content-ppto__rango mrg__top-30 text-center">
												<div class="row">
													<div class="col-xs-6">
														<div class="form-group">
															<div id="fechaDesde"></div>
														</div>
													</div>
													<div class="col-xs-6">
														<div class="form-group">
															<div id="fechaHasta"></div>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>
						</div>
						<hr>
						<div class="row">
							<h3 class="text-center">Tipos de reporte</h3>
							<div class="col-sm-12">
								<div class="form-group">
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
											Opción #1 Recomposicion de presupuesto
										</label>
									</div>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
											Opción #2 Reporte consolidado vigencia
										</label>
									</div>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios3" value="option3">
											Opción #3 Reporte presupuesto anticipo
										</label>
									</div>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios4" value="option4">
											Opción #4 Reporte presupuesto filtro mes
										</label>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group text-center">
									<?= Html::a('Cancelar', ['site/index'], ['class'=>'btn btn-danger btn-raised']) ?>
									<button onclick="generarReporte()" class="btn btn-primary btn-raised">Generar</button></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?php /*ActiveForm::end();*/ ?>

<script type="text/javascript">


	function generarReporte(){
		var vigencia = document.getElementById("vigencia").value;
		var desde = document.getElementById("from").value;
		var hasta = document.getElementById("to").value;
		var fuerza = document.getElementById("codFrz").value;					
		var modalidad = document.getElementById("modalidad").value;
		
		
		if(vigencia != 1 && hasta != "" && desde != ""){

			var route = "<?php echo Url::toRoute(['site/excel'])?>";
			var opcion = $('input[name="optionsRadios"]:checked').val();			

			switch(opcion){
				case 'option1':
					if(fuerzaModalidad(fuerza,modalidad)){
						location.href = route+"&from="+desde+"&to="+hasta+"&vigencia="+vigencia+"&modalidad="+modalidad+"&codFrz="+fuerza+"&optionsRadios="+opcion;
					}
					break;
				case 'option2':
					if(fuerzaModalidad(fuerza,modalidad)){
						location.href = route+"&from="+desde+"&to="+hasta+"&vigencia="+vigencia+"&modalidad="+modalidad+"&codFrz="+fuerza+"&optionsRadios="+opcion;
					}
					break;
				case 'option3':					
					location.href = route+"&from="+desde+"&to="+hasta+"&vigencia="+vigencia+"&modalidad="+modalidad+"&codFrz="+fuerza+"&optionsRadios="+opcion;
					break;
				case 'option4':
					if(fuerzaModalidad(fuerza,modalidad)){
						location.href = route+"&from="+desde+"&to="+hasta+"&vigencia="+vigencia+"&modalidad="+modalidad+"&codFrz="+fuerza+"&optionsRadios="+opcion;
					}
					break;
			}

			console.log(codFrz.value+" - "+modalidad+" - "+vigencia+" - "+desde+" - "+hasta+" - "+opcion);

		}else{
			swal("Campos vacios", "Llene los campos correspondientes para generar el reporte", "info");
		}	
		
	}

	function fuerzaModalidad(fuerza, modalidad){
		var cont = 0;

		if(fuerza != "" && modalidad != 1){
			for (var i=0 ; i<opcionesCodigo.length ; i++){		
				if(fuerza === opcionesCodigo[i]){
					cont++;
				}
			}	

			if(cont > 0){
				return true;
			}else{
				swal("Valores erroneos", "Seleccione las opciones validas dadas", "info");
			}
			
		}else{
			swal("Campos vacios", "Llene los campos correspondientes para generar el reporte", "info");
		}
	}


	var opcionesCodigo = new Array();
	var opcionesDescri = new Array();

	$(function(){

		var phpData = new Array();
		phpData = '<?php echo json_encode($fuerza)?>';		

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
						$("#dscFrz").focusin();
						$("#dscFrz").val(opcionesDescri[i]);
					}
				}		
		    }
    	});

    	var availableTags2 = opcionesDescri;
    	$("#dscFrz").autocomplete({
      		source: availableTags2,
      		select: function (e, ui) {		       
		        var value = ui.item.value;
		        for (var i=0 ; i<opcionesCodigo.length ; i++){		
					if(value === opcionesDescri[i]){
						$("#codFrz").focusin();
						$("#codFrz").val(opcionesCodigo[i]);
					}
				}		
		    }
    	});
  	});
  	


  	/*$(document).ready(function () {
	    $("#codFrz").keyup(function () {
	        var value = $(this).val();
	        for (var i=0 ; i<opcionesCodigo.length ; i++){		
				if(value === opcionesDescri[i]){
					$("#codFrz").focusin();
					$("#codFrz").val(opcionesCodigo[i]);
				}
			}		        
	    });
	});

	$(document).ready(function () {
		//////////////////////////////////////////////////
	    $("#dscFrz").keyup(function () {
	        var value = $(this).val();
	        for (var i=0 ; i<opcionesCodigo.length ; i++){		
				if(value === opcionesDescri[i]){					
					$("#codFrz").focusin();
					$("#codFrz").val(opcionesCodigo[i]);
				}
			}		        
	    });
	   
	});*/

	
	$(startFecha(1));

	function startFecha(vigencia){
		var desde = '<label for="from">Desde</label>'+
					'<input type="text" data-type="date" id="from" name="from" class="form-control" required="true">';

		var hasta = '<label for="to">Hasta</label>'+
					'<input type="text" data-type="date" id="to" name="to" class="form-control" required="true">'

		document.getElementById("fechaDesde").innerHTML = desde;
		document.getElementById("fechaHasta").innerHTML = hasta; 


		$(function(){			
		    var datemin = vigencia+'/01/01';
		    var datemax = vigencia+'/12/31';	  

		    $("#from").datepicker({
		    	minDate: new Date(datemin),
		  		maxDate: new Date(datemax),
		  		defaultDate:new Date(datemin)
		    });

		    $("#to").datepicker({
		    	minDate: new Date(datemin),
		  		maxDate: new Date(datemax),
		  		defaultDate:new Date(datemax)
		    });

		});    
	}    	

    /*$(function(){
		var value = $("#vigencia").val();
	    var datemin = value+'/01/01';
	    var datemax = value+'/12/31';	  

	    $("#from").datepicker({
	    	minDate: new Date(datemin),
	  		maxDate: new Date(datemax),
	  		defaultDate:new Date(datemin)
	    });

	});      

	$(function(){
		var value = $("#vigencia").val();
	    var datemin = '2015/01/01';
	    var datemax = '2015/12/31';	  

	    $("#to").datepicker({
	    	minDate: new Date(datemin),
	  		maxDate: new Date(datemax),
	  		defaultDate:new Date(datemax)
	    });
	});*/

	$(document).ready(function () {		
		var mensaje = '<?=Yii::$app->request->get('mensaje')?>';
		if(mensaje == '1'){
			swal("Reporte vacio", "No se encontraron datos para generar el reporte, intente con otros valores", "info");
		}
		
	});
</script>





  
  
