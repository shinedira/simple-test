/**
 * @license Copyright (c) 2003-2018, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function( config ) {
	// Define changes to default configuration here. For example:
	// config.language = 'fr';
	// config.uiColor = '#AADC6E';
	config.toolbar = [
		{ name: 'document', groups: [ 'mode', 'document', 'doctools' ], items: [ 'Source' ,'-'] },
		{ name: 'clipboard', groups: [ 'clipboard', 'undo' ], items: ['Cut', 'Copy', '-', 'Undo', 'Redo'] },
		{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ], items: [ 'Find', '-' ] },
		{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ], items: [ 'Bold', 'Italic', 'Underline', 'Strike', 'Subscript', 'Superscript', '-', 'CopyFormatting', 'RemoveFormat' ] },
		{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks'], items: [ 'NumberedList', 'BulletedList', '-', 'Outdent', 'Indent', '-', 'Blockquote' ]},
		{ name: 'links', items: [ 'Link', 'Unlink', 'Anchor' ] },
		
		'/',
		{ name: 'colors', items: [ 'TextColor', 'BGColor' ] },

		{ name: 'styles', items: [ 'Format', 'Styles', 'Font', 'FontSize' ] },
		{ name: 'paragraph', groups: [ 'align' ], items: ['JustifyLeft', 'JustifyCenter', 'JustifyRight', 'JustifyBlock']},
		{ name: 'insert', items: [ 'Image', 'Table', 'HorizontalRule', 'SpecialChar', 'PageBreak'] },

		{ name: 'tools', items: [ 'ShowBlocks', 'Maximize' ] },

		
		
	];
	
	// Toolbar groups configuration.
	// config.toolbarGroups = [
	// 	{ name: 'document', groups: [ 'mode', 'document', 'doctools' ] },
	// 	{ name: 'clipboard', groups: [ 'clipboard', 'undo' ] },
	// 	{ name: 'editing', groups: [ 'find', 'selection', 'spellchecker' ] },
	// 	{ name: 'forms' },
	// 	'/',
	// 	{ name: 'basicstyles', groups: [ 'basicstyles', 'cleanup' ] },
	// 	{ name: 'paragraph', groups: [ 'list', 'indent', 'blocks', 'align', 'bidi' ] },
	// 	{ name: 'links' },
	// 	{ name: 'insert' },
	// 	'/',
	// 	{ name: 'styles' },
	// 	{ name: 'colors' },
	// 	{ name: 'tools' },
	// 	{ name: 'others' },
	// 	{ name: 'about' }
	// ];
};
