if (!String.prototype.startsWith) {
	String.prototype.startsWith = function(searchString, position){
		position = position || 0;
		return this.substr(position, searchString.length) === searchString;
	};
}

if (!String.prototype.endsWith) {
	String.prototype.endsWith = function(searchString, position) {
		var subjectString = this.toString();
		if (typeof position !== 'number' || !isFinite(position) || Math.floor(position) !== position || position > subjectString.length) {
			position = subjectString.length;
		}
		position -= searchString.length;
		var lastIndex = subjectString.indexOf(searchString, position);
		return lastIndex !== -1 && lastIndex === position;
	};
}

if (!String.prototype.includes) {
	String.prototype.includes = function(search, start) {
		'use strict';
		if (typeof start !== 'number') {
			start = 0;
		}
		if (start + search.length > this.length) {
			return false;
		} else {
			return this.indexOf(search, start) !== -1;
		}
	};
}

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
			autofocus: true,
			flattenSpans: false,
			matchBrackets: true,
			viewportMargin: 5000,
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
		
		function openPageOnClick(cssClass, element) {
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

			if(cssClass == 'cm-mw-template-name') {
				if(pagename.startsWith(':')) {
					pagename = pagename.substr(1);
				} else if(!pagename.includes(':')) {
					pagename = 'Template:' + pagename;
				}
			}

			window.open(mw.config.get('wgScriptPath') + '/'+ pagename);
		}

		$('.CodeMirror').on('click', '.cm-mw-template-name', function(e) {
			if (e.altKey){
				openPageOnClick('cm-mw-template-name', $(this));
			}
		});

		$('.CodeMirror').on('click', '.cm-mw-link-pagename', function(e) {
			if (e.altKey){
				openPageOnClick('cm-mw-link-pagename', $(this));
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