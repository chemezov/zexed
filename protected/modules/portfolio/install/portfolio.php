<?php
return array(
	'module'    => array(
		'class'  => 'application.modules.portfolio.PortfolioModule',
		'layout' => '//layouts/column1',
	),
	'import'    => array(
		'application.modules.portfolio.models.Portfolio',
		'application.modules.gallery.models.*',
	),
	'component' => array(),
	'rules'     => array(
		'/portfolio'               => '/portfolio/portfolio/index',
		'/portfolio/<slug:[\w-]+>' => array(
			'/portfolio/portfolio/view',
			'type'   => 'db',
			'fields' => array(
				'slug' => array(
					'table' => '{{portfolio}}',
					'field' => 'slug',
				)
			)
		),
	),
);