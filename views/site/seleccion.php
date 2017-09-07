<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Qué operación desea realizar?';
?>

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
						<hr>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="list-group">
									  <a href="#" class="list-group-item">Adición</a>
									  <a href="#" class="list-group-item">Reducción</a>
									  <a href="#" class="list-group-item">Aprobación de pago</a>
									</div>
									<!--<div class="radio radio-primary">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked="">
											Adición
										</label>
									</div>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios2" value="option2">
											Reducción
										</label>
									</div>
									<div class="radio radio-primary">
										<label>
											<input type="radio" name="optionsRadios" id="optionsRadios3" value="contact">
											Aprobación de pago
										</label>
									</div>-->
								</div>
							</div>
						</div>
						<!--<div class="row">
							<div class="col-sm-12">
								<div class="form-group text-center"><button onclick="cambiaPagina()" class="btn btn-primary btn-raised">Continuar</button></div>
							</div>
						</div>-->
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script> 
function cambiaPagina(){ 
   	var i 
   	for (i=0;i<document.optionsRadios.length;i++){ 
      	if (document.optionsRadios[i].checked) 
         	break; 
   	} 
   	window.open = document.optionsRadios[i].value 
} 
</script> 