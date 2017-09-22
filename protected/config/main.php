<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Test Web Application',

	'sourceLanguage' => 'en',

	// preloading 'log' component
	'preload'=>array('log', 'input'),

	// set theme
	'theme'=>'mcowkin',

	'defaultController' => 'page',

	// autoloading classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.helpers.*',
	),

	'modules'=>array(
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'gii123',
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		'skyscanner',
	),

	// application components
	'components'=>array(
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName'=>false,
			'rules'=>array(
				'gii'=>'gii',
				'skyscanner'=>array('skyscanner', 'urlSuffix' => ''), // this is rule for getting acces to skyscanner module
				'submit'=>array('skyscanner/skyscanner/submit', 'urlSuffix' => ''), // this is rule for getting acces to skyscanner module
				''=>array('skyscanner', 'urlSuffix' => ''), // this is rule for HOME PAGE
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'input'=>array(
			'class'		=>	'CmsInput',
			'cleanPost'	=>	false,
			'cleanGet'	=>	false,
		),

		'db'=>require(dirname(__FILE__).'/database.php'),

		'errorHandler'=>array(
			'errorAction'=>YII_DEBUG ? null : 'errors/pagenotfound',
		),

		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
                array(
                    'class'=>'CEmailLogRoute',
                    'levels'=>'error, warning, mailerror',
					'emails' => array('scorpiolaboratory@gmail.com'),
					'sentFrom' => 'scorpiolaboratory@gmail.com',
					'subject' => 'Error at McOwkin'
                ),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error',
					'logFile'=>'errorLog',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'warning',
					'logFile'=>'warningLog',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'info',
					'logFile'=>'infoLog',
				),
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'mailerror',
					'categories'=>"system.*",
					'logFile'=>'mailError.log',
				),
			),
		),
	    'clientScript' => array(
	        // disable default yii scripts
	        'scriptMap' => array(
	            'jquery.js'     => false,
	            'jquery.min.js' => false,
	            'core.css'      => false,
	            'styles.css'    => false,
	            'pager.css'     => false,
	            'default.css'   => false,
	            'jquery-ui.min.js' => false,
	            'jquery-ui.css' => false,
	        ),
	        'coreScriptPosition'=>CClientScript::POS_END,
            'defaultScriptPosition'=>CClientScript::POS_END,
            'defaultScriptFilePosition'=>CClientScript::POS_END
	    ),
        'Smtpmail'=>array(
            'class'=>'application.extensions.smtpmail.PHPMailer',
            'Host'=>"smtp.gmail.com",
            'Username'=>'scorpiolaboratory@gmail.com',
            'Password'=>'XXX-XXX-XXX-XXX',
            'Mailer'=>'smtp',
            'Port'=>587,
            'SMTPAuth'=>true,
            'SMTPSecure' => 'tls',
        ),
	),

	// using Yii::app()->params['paramName']
	'params'=>array(
		'skyscannerApiKey'=>'we362092799388808932220568263975',
		'emailTo' => 'pomidor@mynewtrip.com',
		'emailFrom' => 'scorpiolaboratory@gmail.com',
		'emailFromName' => 'Alex McOwkin',
	),
);
