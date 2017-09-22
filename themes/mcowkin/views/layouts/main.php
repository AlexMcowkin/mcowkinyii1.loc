<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
	<meta name="description" content="<?php echo CHtml::encode($this->metaDescription); ?>">
	<meta name="keywords" content="<?php echo CHtml::encode($this->metaKeywords); ?>">
	<base href="<?=Yii::app()->request->getBaseUrl(true); ?>">
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<!-- Fonts and icons -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons" />
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
	<!-- CSS Files -->
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/bootstrap.min.css" rel="stylesheet" />
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/material-kit.css" rel="stylesheet"/>
    <link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/mcowkin.css" rel="stylesheet"/>
    <!-- favicon -->
	<link rel="icon" type="image/x-icon" href="<?=Yii::app()->request->getBaseUrl(true);?>/favicon.ico">
</head>
<body class="signup-page">
	
	<noscript><p>Для полной функциональности сайта вам необходимо включить JavaScript в вашем браузере.<br />Здесь вы можете найти <a href="http://www.enable-javascript.com/ru/" target="_blank" rel="nofollow">инструкции, как включить JavaScript в вашем браузере</a>.</p></noscript>
	<!--[if lt IE 8]>
	<p class="oldbrowser">Похоже, что версия вашего браузера <strong>очень старая</strong>. Пожалуйста, <a href="http://browsehappy.com/">обновите ваш браузер</a>, чтобы воспользоваться всеми возможностями сайта.</p>
	<![endif]-->

	<nav class="navbar navbar-transparent navbar-absolute">
    	<div class="container">
        	<!-- Brand and toggle get grouped for better mobile display -->
        	<div class="navbar-header">
        		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navigation-example">
            		<span class="sr-only">Toggle navigation</span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
		            <span class="icon-bar"></span>
        		</button>
        		<a class="navbar-brand" href="<?=Yii::app()->homeUrl;?>">McOwkin <i class="material-icons">airplanemode_active</i> AirLines</a>
        	</div>

        	<div class="collapse navbar-collapse" id="navigation-example">
        		<ul class="nav navbar-nav navbar-right">
		            <li>
		                <a href="https://github.com/AlexMcowkin" target="_blank" class="btn btn-simple btn-white btn-just-icon">
							<i class="fa fa-git-square"></i>
						</a>
		            </li>
		            <li>
		                <a href="https://www.facebook.com/makovkinAlex" target="_blank" class="btn btn-simple btn-white btn-just-icon">
							<i class="fa fa-facebook-square"></i>
						</a>
		            </li>
        		</ul>
        	</div>
    	</div>
    </nav>

    <div class="wrapper">
		<div class="header header-filter" style="background-image: url('<?=Yii::app()->theme->baseUrl;?>/img/city.jpg'); background-size: cover; background-position: top center;">
			<div class="container">
				<div class="row">
					<?php echo $content; ?>
				</div>
			</div>
		</div>
    </div>

	<!--   Core JS Files   -->
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.min.js" type="text/javascript"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap.min.js" type="text/javascript"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/material.min.js"></script>
	<!--  Plugin for the Datepicker, full documentation here: http://www.eyecon.ro/bootstrap-datepicker/ -->
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/bootstrap-datepicker.js" type="text/javascript"></script>
	<!-- Control Center for Material Kit: activating the ripples, parallax effects, scripts from the example pages etc -->
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/material-kit.js" type="text/javascript"></script>
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.autocomplete.min.js" type="text/javascript"></script>
	<!-- custom my js -->
	<script src="<?php echo Yii::app()->theme->baseUrl; ?>/js/mcowkin.js" type="text/javascript"></script>
</body>
</html>