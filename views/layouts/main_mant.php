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
					</div>
				</div>
			</div>
		</nav>
	</header>
	<div class="content-menu-ppto">
		<nav>
			<ul class="menu-ppto">
				<h2 class="txt__light-100"><span>¿Qué operación desea realizar?</span></h2>
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
    <div id="mainOptn" class="fluid-container main-content main-operations">
		<div class="mod-docs">
			<div class="mod-docs-header bg-teal-std"></div>
			<div class="mod-docs-body container">
				<div class="row">
					<div id="contform" class="content-form-operations col-md-8">
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
													<li data-value="1">Seleccionar</li>
													<li data-value="2">Modalidad 1</li>
													<li data-value="3">Modalidad 2</li>
													<li data-value="4">modalidad 3</li>
													<li data-value="5">Modalidad 4</li>
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
													<li data-value="1">Seleccionar</li>
													<li data-value="2">2015</li>
													<li data-value="3">2016</li>
													<li data-value="4">2017</li>
													<li data-value="5">2018</li>
												</ul>
												<input type="hidden" id="vigencia" name="myOptions" value="1" class="form-control">
											</div>
										</div>		
									</div>
									<div class="col-xs-12 col-sm-4">
										<div class="form-group select-m">
											<label class="control-label" for="mesFact">
												Mes de facturación
											</label>

											<div class="mad-select" id="mesFactSelect">
												<ul>
													<li data-value="1">Seleccionar</li>
													<li data-value="2">Enero</li>
													<li data-value="3">Febrero</li>
													<li data-value="4">Marzo</li>
													<li data-value="5">Abril</li>
													<li data-value="6">Mayo</li>
													<li data-value="7">Junio</li>
													<li data-value="8">Julio</li>
													<li data-value="9">Agosto</li>
													<li data-value="10">Septiembre</li>
													<li data-value="11">Octubre</li>
													<li data-value="12">Noviembre</li>
													<li data-value="13">Diciembre</li>
												</ul>
												<input type="hidden" id="mesFact" name="myOptions" value="1" class="form-control">
											</div>
										</div>		
									</div>
								</div>
								<hr class="div-op">
								<div id="cntOptn" class="content-operations">
									<?= $content ?>
								</div>
							</div>
							<div class="panel-footer clearfix">
								<div class="form-group pull-right">
									<?= Html::a('Agregar', '#cntOptn', ['id' => 'btnAddOptn', 'class'=>'btn btn-primary btn-raised']) ?>
								</div>
							</div>
						</div>
					</div>
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
    </div>
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.6.10/sweetalert2.min.js"></script>
<script>
	$(function () {
		$.material.init();
	});
</script>
<!--<script>
	$(function () {
		$("#btnAddOptn").click(function(){
			$('html,body').animate({
				scrollTop: 0
			}, 800);
		});
	});
</script>-->
<!--<script>
$(function(){
  // Add scrollspy to <body>
  $('body').scrollspy({target: ".main-operations", offset: 50});   

  // Add smooth scrolling on all links inside the navbar
  $("#btnAddOptn").on('click', function(event) {
    // Make sure this.hash has a value before overriding default behavior
    if (this.hash !== "") {
      // Prevent default anchor click behavior
      event.preventDefault();

      // Store hash
      var hash = this.hash;

      // Using jQuery's animate() method to add smooth page scroll
      // The optional number (800) specifies the number of milliseconds it takes to scroll to the specified area
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 500, function(){
   
        // Add hash (#) to URL when done scrolling (default click behavior)
        window.location.hash = hash;
      });
    }  // End if
  });
});
</script>-->
<script>
	$("#btnAddOptn").click(function(){
		$(".content-form-operations").addClass("list-operations-visible");
		$(".content-list-operations").addClass("list-operations-visible");
	});
</script>
<script>
  $( function() {
    $( "#finput" ).datepicker({
		gotoCurrent: true,
		dateFormat: "dd/mm/y",
		changeMonth: true,
		changeYear: true
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