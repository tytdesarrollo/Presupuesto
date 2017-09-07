<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = '¿Qué operación desea realizar?';
?>

<div id="loader">
<br><br><br><br><br><br><br><br><br><br><br><br>
	<div class="sk-circle">
	  <div class="sk-circle1 sk-child"></div>
	  <div class="sk-circle2 sk-child"></div>
	  <div class="sk-circle3 sk-child"></div>
	  <div class="sk-circle4 sk-child"></div>
	  <div class="sk-circle5 sk-child"></div>
	  <div class="sk-circle6 sk-child"></div>
	  <div class="sk-circle7 sk-child"></div>
	  <div class="sk-circle8 sk-child"></div>
	  <div class="sk-circle9 sk-child"></div>
	  <div class="sk-circle10 sk-child"></div>
	  <div class="sk-circle11 sk-child"></div>
	  <div class="sk-circle12 sk-child"></div>
	</div>
</div>

<div class="mod-docs">

	<div style="display:none;" id="myDiv" class="animate-bottom">
	<div class="Hom_pea">
	</div>

	<div class="mod-docs-body container">
		<div class="row">
			<!--<div class="box-circle">
				<svg version="1.1" id="circle" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="400px" height="400px" viewBox="0 0 400 400" enable-background="new 0 0 400 400" xml:space="preserve">
					<path fill="#FFFFFF" d="M400,201H0C0,90,89.543,1,200,1S400,90,400,201z"/>
				</svg>
			</div>-->
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class="box-certingreso-drw">
							<!--<img src="img/certingreso_drw.svg" alt="Ejecución Presupuestal">-->
						</div>
						<h2 class="fnt__Medium text-center mrg__bottom-20"><?= Html::encode($this->title) ?></h2>
						<hr>
						<div class="row">
							<div class="col-sm-12">
								<div class="form-group">
									<div class="list-group">
									  <a href="#" class="list-group-item">Adición</a>
									  <a href="#" class="list-group-item">Reducción</a>
									  <a href="<?php echo Url::toRoute(['site/presupuesto']); ?>" class="list-group-item">Aprobación de pago</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

</div>

<script>
var myVar;

function myFunction() {
    myVar = setTimeout(showPage, 1500);
}

function showPage() {
  document.getElementById("loader").style.display = "none";
  document.getElementById("myDiv").style.display = "block";
}
</script>