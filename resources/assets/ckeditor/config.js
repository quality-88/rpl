CKEDITOR.editorConfig = function (config) {
	config.toolbarGroups = [{
			name: 'styles'
		},
		{
			name: 'colors'
		},
		{
			name: 'basicstyles',
			groups: ['basicstyles']
		},
		{
			name: 'paragraph',
			groups: ['list']
		},
		{
			name: 'links'
		},
		{
			name: 'insert'
		},
		{
			name: 'sourcearea',
			groups: ['mode', 'resize']
		}

	];
	config.removeButtons = 'Underline,Subscript,Superscript';

	// Set the most common block elements.
	config.format_tags = 'p;h1;h2;h3;pre';

	// Simplify the dialog windows.
	config.removeDialogTabs = 'image:advanced;link:advanced';
};