<?php
return array(
	'module'    => array(
		'class'  => 'application.modules.page.PageModule',
		// Указание здесь layout'a портит отображение на фронтенде:
		'layout' => '//layouts/column1',
	),
	'import'    => array(
		'application.modules.page.models.*',
	),
	'component' => array(),
	'rules'     => array(
		/* use advanced slug rules */
//		'<ppslug:[\w-]+>/<pslug:[\w-]+>/<slug:[\w-]+>' => array(
//			'page/page/show',
//			'type'   => 'db',
//			'fields' => array(
//				'ppslug' => array(
//					'table' => '{{page_page}}',
//					'field' => 'slug',
//				),
//				'pslug'  => array(
//					'table' => '{{page_page}}',
//					'field' => 'slug',
//				),
//				'slug'   => array(
//					'table' => '{{page_page}}',
//					'field' => 'slug',
//				),
//			)
//		),
//		'<pslug:[\w-]+>/<slug:[\w-]+>'                 => array(
//			'page/page/show',
//			'type'   => 'db',
//			'fields' => array(
//				'pslug' => array(
//					'table' => '{{page_page}}',
//					'field' => 'slug',
//				),
//				'slug'  => array(
//					'table' => '{{page_page}}',
//					'field' => 'slug',
//				),
//			)
//		),
		'<slug:[\w-]+>' => array(
			'/page/page/show/',
			'type'   => 'db',
			'fields' => array(
				'slug' => array(
					'table' => '{{page_page}}',
					'field' => 'slug',
				)
			)
		),
	),
);