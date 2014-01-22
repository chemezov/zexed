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
		'/portfolio'                  => '/portfolio/portfolio/index',
		'/portfolio/tag/<tag:.*?>' => array(
			'/portfolio/portfolio/tag',
			'type'   => 'db',
			'fields' => array(
				'tag' => array(
					'table' => '{{portfolio_tag}}',
					'field' => 'name',
				)
			)
		),
		'/portfolio/<slug:[\w-]+>'    => array(
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