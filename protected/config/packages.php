<?php

return array(
	'fancybox' => array(
		'basePath' => 'webroot.web.vendor.fancybox',
		'baseUrl'  => 'web/vendor/fancybox',
		'js'       => array(
			'jquery.fancybox.pack.js',
			'helpers/jquery.fancybox-buttons.js',
			'helpers/jquery.fancybox-thumbs.js',
		),
		'css'      => array(
			'jquery.fancybox.css',
			'helpers/jquery.fancybox-buttons.css',
			'helpers/jquery.fancybox-thumbs.css',
		),
		'depends'  => array('jquery'),
	),
);