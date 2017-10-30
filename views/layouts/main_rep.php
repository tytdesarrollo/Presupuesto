<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
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
	<header id="header" class="clearfix">
		<nav class="navbar nav-pre">
			<div class="container-fluid">
				<div class="pull-left">
					<div class="content__icon-menu__aux">
						<?= Html::a('<i class="material-icons icon__24">&#xE88A;</i>', ['site/index'], ['class' => 'menu-trigger']) ?>
					</div>
					<div class="content__icon-menu__aux">
						<a href="#" class="menu-modal-trigger menu-trigger">
							<i class="material-icons icon__24">&#xE5C3;</i>
						</a>
						<div class="content-menu-ppto">
							<nav>
								<ul class="menu-ppto">
									<h2 data-content="¿Qué operación desea realizar?"><span>¿Qué operación desea realizar?</span></h2>
									<li>
										<a href="<?php echo Url::toRoute(['site/adiciones']); ?>">
											Adición
										</a>
									</li>
									<li>
										<a href="<?php echo Url::toRoute(['site/reducciones']); ?>">
											Reducción
										</a>
									</li>
									<li>
										<a href="<?php echo Url::toRoute(['site/autopago']); ?>">
											Autorización de pago
										</a>
									</li>
									<li>
										<a href="<?php echo Url::toRoute(['site/presupuesto']); ?>">
											Ejecuciones
										</a>
									</li>
								</ul>
							</nav>
							<a href="#" class="close-menu-ppto">
								<i class="material-icons">&#xE14C;</i>
							</a>
						</div>
					</div>
				</div>
			</div>
		</nav>
	</header>
    <div class="fluid-container main-content main-rep">
        <?= $content ?>
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>
<script>
	$(function () {
		$.material.init();
	});
</script>
<script>
$( function() {
    var dateFormat = "dd/mm/yy",
      from = $( "#from" )
        .datepicker({
          defaultDate: "+1w",
          changeMonth: true,
          changeYear: true,
          numberOfMonths: 1,
		  dateFormat: "dd/mm/yy"
        })
        .on( "change", function() {
          to.datepicker( "option", "minDate", getDate( this ) );
        }),
      to = $( "#to" ).datepicker({
        defaultDate: "+1w",
        changeMonth: true,
		changeYear: true,
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