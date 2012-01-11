// TinyMCE
$.fn.tinymce = function(options) {
	return this.each(function() {
		tinyMCE.execCommand("mceAddControl", true, this.id);
	});
}
// TinyMCE configuration
function initMCE() {
	tinyMCE.init( {
		mode : "textareas",
		theme : "advanced",
		relative_urls : false,
		language : "de",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_buttons1 : "bold,italic,underline,strikethrough,separator,table,bullist,numlist,undo,redo,link,unlink,image,fullscreen",
		theme_advanced_buttons2 : "pastetext,pasteword,selectall",
		theme_advanced_buttons3 : "",
		force_br_newlines : true,
		forced_root_block : '',
		force_p_newlines : false,
		cleanup : true,
		plugins : "fullscreen,table,autoresize,contextmenu,safari,paste",
		fullscreen_new_window : false,
		fullscreen_settings : {
			plugins : 'fullscreen, advhr, searchreplace, table, paste, safari',
			table_color_fields : 'true',
			theme_advanced_buttons1 : 'fullscreen,bold,italic,underline,strikethrough,separator,sub,sup,separator,justifyleft,justifyright,justifycenter,justifyfull,separator,bullist,numlist,separator,outdent,indent,separator,advhr,separator,undo,redo,separator,link,unlink,anchor,image,separator,code',
			theme_advanced_buttons2 : 'tablecontrols, separator,forecolor,backcolor,separator,fontsizeselect,separator,fontselect,styleselect',
			theme_advanced_buttons3 : 'selectall,cut,paste,pastetext,pasteword,separator,search,replace,separator,removeformat,visualaid,separator,charmap'
		},
		content_css : "/styles/live/foellmi/foellmi.css"
	});
}
initMCE();
// Add TinyMCE functionality to liveedit
$.editable.addInputType('mce',{
	element : function(settings, original) {
		var textarea = $('<textarea id="' + $(original).attr(
				"id") + '_mce"/>');
		if (settings.rows) {
			textarea.attr('rows', settings.rows);
		} else {
			textarea.height(settings.height);
		}
		if (settings.cols) {
			textarea.attr('cols', settings.cols);
		} else {
			textarea.width(settings.width);
		}
		$(this).append(textarea);
		return (textarea);
	},
	plugin : function(settings, original) {
		tinyMCE.execCommand("mceAddControl", true, $(original)
				.attr("id") + '_mce');
	},
	submit : function(settings, original) {
		tinyMCE.triggerSave();
		tinyMCE.execCommand("mceRemoveControl", true, $(
				original).attr("id") + '_mce');
	},
	reset : function(settings, original) {
		tinyMCE.execCommand("mceRemoveControl", true, $(
				original).attr("id") + '_mce');
		original.reset();
	}
});
// Liveedit configuration
$(function() {
	$('.xt_liveedit_articletitle').editable('/ajax.php?package=ch.iframe.snode.articles&module=dummy&x270_action=liveEditSave&x270_elementtype=articletitle',
		{
			type : 'text',
			event : 'dblclick',
			indicator : 'Wird gespeichert...',
			submit : 'Speichern',
			cancel : 'Abbrechen',
			onblur : 'ignore',
			tooltip : 'Zum editieren doppelklicken...',
			placeholder : 'Zum editieren doppelklicken...',
			id : 'x270_idstring',
			name : 'x270_articletitle'
		});
	$('.xt_liveedit_articlesubtitle').editable('/ajax.php?package=ch.iframe.snode.articles&module=dummy&x270_action=liveEditSave&x270_elementtype=articlesubtitle',
		{
			type : 'text',
			event : 'dblclick',
			indicator : 'Wird gespeichert...',
			submit : 'Speichern',
			cancel : 'Abbrechen',
			onblur : 'ignore',
			tooltip : 'Zum editieren doppelklicken...',
			placeholder : 'Zum editieren doppelklicken...',
			id : 'x270_idstring',
			name : 'x270_articlesubtitle'
		});
	$(".xt_liveedit_articleintroduction").editable("/ajax.php?package=ch.iframe.snode.articles&module=dummy&x270_action=liveEditSave&x270_elementtype=articleintroduction",
		{
			type : 'mce',
			event : 'dblclick',
			submit : 'Speichern',
			cancel : 'Abbrechen',
			onblur : 'ignore',
			tooltip : 'Zum editieren doppelklicken...',
			indicator : 'Wird gespeichert...',
			placeholder : 'Zum editieren doppelklicken...',
			id : 'x270_idstring',
			name : 'x270_articleintroduction'
		});
	$('.xt_liveedit_chaptertitle').editable('/ajax.php?package=ch.iframe.snode.articles&module=dummy&x270_action=liveEditSave&x270_elementtype=chaptertitle',
		{
			type : 'text',
			event : 'dblclick',
			indicator : 'Wird gespeichert...',
			submit : 'Speichern',
			cancel : 'Abbrechen',
			onblur : 'ignore',
			tooltip : 'Zum editieren doppelklicken...',
			placeholder : 'Zum editieren doppelklicken...',
			id : 'x270_idstring',
			name : 'x270_chaptertitle'
		});
	$('.xt_liveedit_chaptersubtitle').editable('/ajax.php?package=ch.iframe.snode.articles&module=dummy&x270_action=liveEditSave&x270_elementtype=chaptersubtitle',
		{
			type : 'text',
			event : 'dblclick',
			indicator : 'Wird gespeichert...',
			submit : 'Speichern',
			cancel : 'Abbrechen',
			onblur : 'ignore',
			tooltip : 'Zum editieren doppelklicken...',
			placeholder : 'Zum editieren doppelklicken...',
			id : 'x270_idstring',
			name : 'x270_chaptersubtitle'
		});
	$(".xt_liveedit_chaptermaintext").editable("/ajax.php?package=ch.iframe.snode.articles&module=dummy&x270_action=liveEditSave&x270_elementtype=chaptermaintext",
		{
			type : 'mce',
			event : 'dblclick',
			submit : 'Speichern',
			cancel : 'Abbrechen',
			onblur : 'ignore',
			tooltip : "Zum editieren doppelklicken...",
			placeholder : 'Zum editieren doppelklicken...',
			id : 'x270_idstring',
			name : 'x270_chaptermaintext'
		});
});

// Code für Image-Version
$(document).ready(function() {
	$(".versiontrigger").unbind().hover(function() {
		$(".versioninfo", this).stop().animate({opacity:"0.8"}, 1E3);
		$(this).css("float", $("img", this).css("float"));
        margin_left_info = parseInt($("img", this).css("margin-left")) + parseInt($("img", this).css("padding-left"));
		$(".versioninfo", this).css("margin-left", margin_left_info);
		$(".versioninfo", this).css("width", $("img", this).width() - 10);
	}, function() {
		$(".versioninfo", this).stop().animate({opacity:"0"})
	})
});