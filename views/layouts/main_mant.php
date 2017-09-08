<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
    <?php $this->head() ?>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.min.css">
    
</head>
<body>
<?php $this->beginBody() ?>
    <div class="fluid-container main-content">
		<div class="mod-docs">
			<div class="mod-docs-header bg-teal-std"></div>
			<div class="mod-docs-body container">
				<div class="row">
					<div class="col-md-8 col-md-offset-2">
						<div class="panel panel-default panel-operations">
							<div class="panel-body">
								<div class="content__f-input pull-right">
									<div class="form-group">
										<input class="form-control" id="finput" name="finput" type="text" data-type="date" required="true" value="<?= date("d/m/y")?>">
									</div>
								</div>
								<p>Seleccione un ESM para continuar con la operación.
									<div class="row">
										<div class="col-xs-3 col-sm-3">
											<div class="form-group label-floating"><label for="codESM" class="control-label">ESM</label><input type="text" class="form-control" id="codESM"></div>
										</div>
										<div class="col-xs-9 col sm-9">
											<div class="form-group label-floating"><label for="dscESM" class="control-label">Descripción</label><input type="text" class="form-control" id="dscESM"></div>
										</div>
									</div>
									<hr>
									<div class="content-operations">
										<?= $content ?>
									</div>
								</p>
							</div>
							<div class="panel-footer clearfix">
								<div class="form-group pull-right"><button class="btn btn-primary btn-raised">Guardar</button></div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.min.js"></script>
<script src="http://code.jquery.com/ui/1.12.1/jquery-ui.min.js"></script>
<script>
	$(function () {
		$.material.init();
	});
</script>
<script>
  $( function() {
    $( "#finput" ).datepicker({
		gotoCurrent: true,
		dateFormat: "dd/mm/y"
	})
  } );
  </script>
<script>
$( function() {
    var dateFormat = "dd/mm/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          numberOfMonths: 1,
		  dateFormat: "dd/mm/yy"
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
        numberOfMonths: 1,
		dateFormat: "dd/mm/yy"
      })
      .on( "change", function() {
        from.datepicker( "option", "maxDate", getDate( this ) );
      });
 
    function getDate( element ) {
      var date;
      try {
        date = $.datepicker.parseDate( dateFormat, element.value );
      } catch( error ) {
        date = null;
      }
 
      return date;
    }
 });
</script>