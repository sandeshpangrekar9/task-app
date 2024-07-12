@push('js_pre_content')

<style>
	.trumbowyg-box {
		border: 1px solid #D1D5DB;
		
	}

	.trumbowyg-editor {
		height: 160px;
	}

	:root {
		--tbw-cell-vertical-padding: 4px !important;
		--tbw-cell-horizontal-padding: 8px !important;
		--tbw-cell-line-height: 1.5em !important;
	}

	.trumbowyg-editor table {
		margin-bottom: var(--tbw-cell-line-height) !important;
	}

	.trumbowyg-editor th, .trumbowyg-editor td {
		height: calc(var(--tbw-cell-vertical-padding) * 2 + var(--tbw-cell-line-height)) !important;
		min-width: calc(var(--tbw-cell-horizontal-padding) * 2) !important;
		padding: var(--tbw-cell-vertical-padding) var(--tbw-cell-horizontal-padding) !important;
		border: 1px solid #e7eaec;
	}
</style>

<link rel="stylesheet" href="{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/ui/trumbowyg.min.css') }}">
<link rel="stylesheet" href="{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/plugins/table/ui/trumbowyg.table.min.css') }}">
<script src="{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/trumbowyg.min.js') }}"></script>
<script src="{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/plugins/base64/trumbowyg.base64.min.js') }}"></script>
<script src="{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/plugins/cleanpaste/trumbowyg.cleanpaste.min.js') }}"></script>
<script src="{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/plugins/colors/trumbowyg.colors.min.js') }}"></script>
<script src="{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/plugins/insertaudio/trumbowyg.insertaudio.min.js') }}"></script>
<script src="{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/plugins/noembed/trumbowyg.noembed.min.js') }}"></script>
<script src="{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/plugins/preformatted/trumbowyg.preformatted.min.js') }}"></script>
<script src="{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/plugins/template/trumbowyg.template.min.js') }}"></script>
<script src="{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/plugins/upload/trumbowyg.upload.min.js') }}"></script>
<script src="{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/plugins/pasteimage/trumbowyg.pasteimage.min.js') }}"></script>
<script src="{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/plugins/table/trumbowyg.table.min.js') }}"></script>
<script src="//rawcdn.githack.com/RickStrahl/jquery-resizable/0.35/dist/jquery-resizable.min.js"></script>
<script src="{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/plugins/resizimg/trumbowyg.resizimg.min.js') }}"></script>

@endpush

@push('js_post_content')

<script>

const Trumbowyg = function() {

// Trumbowyg editor
const _componentTrumbowyg = function() {
	if (!$().trumbowyg) {
		console.warn('Warning - trumbowyg.min.js is not loaded.');
		return;
	}

	// Set custom icons path
	$.trumbowyg.svgPath = "{{ asset('assets/base/js/vendor/editors/trumbowyg/dist/ui/icons.svg') }}";

	// Custom toolbar
	$('.fce_description').trumbowyg({
		lang: 'en',
		mobile: true,
		fixedBtnPane: false,
		fixedFullWidth: false,
		autogrow: false,
		autogrowOnEnter: false,
		imageWidth: true,
		prefix: 'trumbowyg-',
		tagClasses: {},
		semantic: true,
		semanticKeepAttributes: false,
		resetCss: false,
		removeformatPasted: false,
		tabToIndent: false,
		tagsToRemove: [],
		tagsToKeep: ['hr', 'img', 'embed', 'iframe', 'input'],
		btns: [
			['viewHTML'],
			['undo', 'redo'], // Only supported in Blink browsers
			['formatting'],
			['strong', 'em', 'del', 'underline'],
			['foreColor', 'backColor'],
			['superscript', 'subscript'],
			['link'],
			['insertImage', 'upload', 'base64', 'noembed'],
			['table', 'tableCellBackgroundColor', 'tableBorderColor'],
			['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
			['unorderedList', 'orderedList'],
			['horizontalRule'],
			['preformatted'],
			['removeformat'],
			['fullscreen']
		],
		// For custom button definitions
		btnsDef: {
			// Define your custom button
		},
		changeActiveDropdownIcon: false,
		inlineElementsSelector: 'a,abbr,acronym,b,caption,cite,code,col,dfn,dir,dt,dd,em,font,hr,i,kbd,li,q,span,strikeout,strong,sub,sup,u',
		pasteHandlers: [],
		plugins: {
			upload: {
				serverPath: '',
				fileFieldName: 'image',
				headers: {
					'': ''
				},
				urlPropertyName: ''
			},
			table: {
				rows: 8,
				columns: 8,
				allowHorizontalResize: true,
				colorList: [
					'ffffff', '000000', 'eeece1', '1f497d', '4f81bd', 'c0504d', '9bbb59', '8064a2', '4bacc6', 'f79646', 'ffff00',
					'f2f2f2', '7f7f7f', 'ddd9c3', 'c6d9f0', 'dbe5f1', 'f2dcdb', 'ebf1dd', 'e5e0ec', 'dbeef3', 'fdeada', 'fff2ca',
					'd8d8d8', '595959', 'c4bd97', '8db3e2', 'b8cce4', 'e5b9b7', 'd7e3bc', 'ccc1d9', 'b7dde8', 'fbd5b5', 'ffe694',
					'bfbfbf', '3f3f3f', '938953', '548dd4', '95b3d7', 'd99694', 'c3d69b', 'b2a2c7', 'b7dde8', 'fac08f', 'f2c314',
					'a5a5a5', '262626', '494429', '17365d', '366092', '953734', '76923c', '5f497a', '92cddc', 'e36c09', 'c09100',
					'7f7f7f', '0c0c0c', '1d1b10', '0f243e', '244061', '632423', '4f6128', '3f3151', '31859b', '974806', '7f6000'
				],
				backgroundColorList: null, // fallbacks on colorList
				allowCustomBackgroundColor: true,
				displayBackgroundColorsAsList: false,
				borderColorList: null, // fallbacks on colorList
				allowCustomBorderColor: true,
				displayBorderColorsAsList: false,
				dropdown: [
					{
						title: 'tableRows',
						buttons: [
							'tableAddHeaderRow',
							'tableAddRowAbove',
							'tableAddRow',
							'tableDeleteRow',
						],
					},
					{
						title: 'tableColumns',
						buttons: [
							'tableAddColumnLeft',
							'tableAddColumn',
							'tableDeleteColumn',
						],
					},
					{
						title: 'tableVerticalAlign',
						buttons: [
							'tableVerticalAlignTop',
							'tableVerticalAlignMiddle',
							'tableVerticalAlignBottom',
					],
					},
					{
						title: 'tableOthers',
						buttons: [
							//'Cell merge/split',
							'tableMergeCells',
							'tableUnmergeCells',
							'tableDestroy',
						]
					}
				],
			},
			resizimg: {
				minSize: 64,
				step: 16,
			}
		}, 
		urlProtocol: false,
		minimalLinks: true,
		defaultLinkTarget: undefined
	});
};

return {
	init: function() {
		_componentTrumbowyg();
	}
}
}();

document.addEventListener('DOMContentLoaded', function() {
Trumbowyg.init();
});
</script>

@endpush