/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';

	config.language = 'ru';
	config.bodyClass = 'content';
	//        config.skin = 'office2003',
	config.toolbar_Yii =
		[
			['Source', 'Maximize', '-', 'RemoveFormat', '-', 'Cut', 'Copy', 'Paste', 'PasteText', 'PasteFromWord',
				'-', 'Find', 'Replace', '-', 'Undo', 'Redo', '-', 'Link', 'Unlink', 'Anchor', '-',
				'Image', 'Table', 'HorizontalRule', 'SpecialChar', '-', 'SpellCheck', 'Abbr'
				/*'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'HiddenField'*/
			],
			['Styles', 'Format'/*,'Font','FontSize'*/],
			['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
			['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript', '-',
				'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', 'Blockquote', /*'CreateDiv', '-', 'TextColor', */'ShowBlocks'],

		];

	config.toolbar_Basic =
		[
			['Source', 'RemoveFormat', '-', 'PasteText', 'PasteFromWord',
				'-', 'Undo', 'Redo', '-', 'Link', 'Unlink', '-',
				'SpecialChar'/*, '-',
			 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'HiddenField'*/
			],
			['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock'],
			['Bold', 'Italic', 'Underline', 'Strike', '-', 'Subscript', 'Superscript', '-',
				'ShowBlocks', 'SpellCheck'],
		]

	config.contentsCss =
		[
			//			CKEDITOR.basePath.replace('vendors/ckeditor/', '') + 'themes/myriad/css/style.css',
			//			CKEDITOR.basePath.replace('vendors/ckeditor/', '') + 'themes/myriad/css/content.css',
//			CKEDITOR.basePath + 'content.css'
		];


	config.toolbarCanCollapse = false;
	config.toolbar = 'Yii';
	config.AutoParagraph = false;

	config.resize_minWidth = '100%';
	config.resize_maxWidth = '100%';

//	config.stylesSet =
//		[
//			//{ name : 'Красный заголовок', element : 'h2', styles : { 'color' : 'Red', 'font-size' : '1.3em' } },
//			//{ name : 'Заголовок страницы', element : 'h1', attributes : { 'class' : 'h' } },
//			//{ name : 'Синий текст', element: 'span',  styles : { 'color' : '#000080', 'font-weight' : 'bold'} },
//			//			{ name:'Текст 10px', element:'span', styles:{'font-size':'10px'} },
//			//			{ name:'Текст 12px', element:'span', styles:{'font-size':'12px'} },
//			//			{ name:'Текст 14px', element:'span', styles:{'font-size':'14px'} },
//			//			{ name:'Текст 16px', element:'p', styles:{'font-size':'16px'} },
//			//			{ name:'Текст 18px', element:'span', styles:{'font-size':'18px'} },
////			{ name: 'Изображение слева', element: 'img', attributes: {'class': 'img-left'}},
////			{ name: 'Изображение справа', element: 'img', attributes: {'class': 'img-right'}},
//
//
//			{ name: 'Стандартная таблица', element: 'table', attributes: {'class': 'table-style'} } ,
//			{ name: 'Альтернативный ряд', element: 'tr', attributes: {'class': 'table-style-row'} } ,
//			{ name: 'Заголовочный ряд', element: 'tr', attributes: {'class': 'table-style-header'} } ,
//			{ name: 'Обычный ряд', element: 'tr', attributes: {'class': ''} },
//		];
//
	var _FileBrowserLanguage = 'php';	// asp | aspx | cfm | lasso | perl | php | py
	var _QuickUploadLanguage = 'php';	// asp | aspx | cfm | lasso | php

	var _FileBrowserExtension = _FileBrowserLanguage == 'perl' ? 'cgi' : _FileBrowserLanguage;


	config.format_tags = 'p;h2;h3;h4;h5;h6;pre;address;div';

//	config.extraPlugins += (config.extraPlugins ? ',aspell' : 'aspell' );
	//	config.toolbar_Yii[2] = { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellCheck'] };
	config.disableNativeSpellChecker = false;

//	config.extraPlugins += (config.extraPlugins ? ',onchange' : 'onchange');

//	config.extraPlugins += (config.extraPlugins ? ',abbr' : 'abbr');

	//	config.extraPlugins = 'autogrow';
};
