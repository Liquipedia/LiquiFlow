$(document).ready(function() {
	function invoke_codemirror(codemirror_id) {
		var editmode;
		var locationStr = window.location.href;
		if((locationStr.endsWith('.js')) || (locationStr.includes('.js&'))) {
			editmode = 'text/javascript';
		} else if((locationStr.endsWith('.css')) || (locationStr.includes('.css&'))) {
			editmode = 'text/css';
		} else if(locationStr.includes('/index.php?title=Module:')) {
			editmode = 'text/x-lua';
		} else {
			editmode = 'text/mediawiki';
		}
		var editor = CodeMirror.fromTextArea(document.getElementById(codemirror_id), {
			mwextFunctionSynonyms: mw.config.get( 'liquiflowCodemirrorFunctionSynonyms' ),
			mwextTags: mw.config.get( 'liquiflowCodemirrorTags' ),
			mwextDoubleUnderscore: mw.config.get( 'liquiflowCodemirrorDoubleUnderscore' ),
			mwextUrlProtocols: mw.config.get( 'liquiflowCodemirrorUrlProtocols' ),
			mwextModes: mw.config.get( 'liquiflowCodemirrorExtModes' ),
			lineNumbers: true,
			mode: editmode,
			lineWrapping: true,
			autofocus: true,
			flattenSpans: false,
			matchBrackets: true,
			extraKeys: {
				"F11": function(cm) {
					cm.setOption("fullScreen", !cm.getOption("fullScreen"));
				},
				"Esc": function(cm) {
					if (cm.getOption("fullScreen")) cm.setOption("fullScreen", false);
				}
			},
			readOnly: document.getElementById(codemirror_id).readOnly
		});
		$(codemirror_id).change(function() {
			editor.setCode($(this).val());
		});
		
		function openPageOnClick( cssClass, namespace, element){
			var pagename = element.text();
			var index = element.index();
			var counter;

			counter = index - 1;
			while(element.parent().children().eq(counter).hasClass(cssClass)) {
				pagename = element.parent().children().eq(counter).text() + pagename;
				counter--;
			}

			counter = index + 1;
			while(element.parent().children().eq(counter).hasClass(cssClass)) {
				pagename = pagename + element.parent().children().eq(counter).text();
				counter++;
			}

			pagename = pagename.substr(0, 1).toUpperCase() + pagename.substr(1);

			window.open(mw.config.get('wgScriptPath') + '/'+ namespace + pagename);
		}
		
		$('.CodeMirror').on('click', '.cm-mw-template-name', function(e) {
			if (e.altKey){
				openPageOnClick('cm-mw-template-name', 'Template:', $(this));
			}
		});
		
		$('.CodeMirror').on('click', '.cm-mw-link-pagename', function(e) {
			if (e.altKey){
				openPageOnClick('cm-mw-link-pagename', '', $(this));
			}
		});
	}
	if($('#wpTextbox1').length) {
		invoke_codemirror('wpTextbox1');
	}
	if($('#wpTextbox2').length) {
		invoke_codemirror('wpTextbox2');
	}
});