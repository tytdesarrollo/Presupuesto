<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use app\assets\AppAsset;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;
use yii\helpers\Url;

$this->title = 'Prueba';
?>
<div class="site-about">

<br><br><br><br><br>

		<div class="panel panel-default">
		  <!-- Default panel contents -->
		  <div class="panel-heading">En qué formato?</div>
		  <div class="panel-body">
			<!-- List group -->
			<div class="radio radio-primary">
			  <label>
				<input type="radio" name="rutinario" id="optionsRadios1" value="option1">
					EXCEL
			  </label>
			</div>
			<div class="radio radio-primary">
			  <label>
				<input type="radio" name="rutinario" id="optionsRadios2" value="option2">
					PDF
			  </label>
			</div>
		  </div>
		</div>

<button onclick="Alerta()" class="btn btn-actions btn-raised">Exportar</button>

</div>

<script>

function Alerta(){
swal({
  title: "Está seguro?",
  input: 'select',
  /*type: "warning",*/
  html: true,
  showCancelButton: true,
  cancelButtonColor: "#DD6B55",
  cancelButtonText: "Cancelar",
  confirmButtonColor: "#09CC4E",
  confirmButtonText: "Aceptar",
  closeOnConfirm: false,
  closeOnCancel: false
},
function(isConfirm){
if (isConfirm) {
  swal("Exportado!", "Su reporte ha sido exportado!", "success");
  } else {
  swal("Cancelado", "Su reporte ha sido cancelado!", "error");
  }
});
}
</script>
