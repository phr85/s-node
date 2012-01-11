$(document).ready(function() {
	bindNav();
	bindBody();
	bindButtons();
	bindPaginator();
});

// navigation binden
function bindNav(){
	$('.XTMSGnavigator > li > a').bind("click",function(){
		// body laden
		$('#XTMSGbody').html('<img src="/images/ajax-loader.gif" alt="" />');
		$('#XTMSGbody').load('/ajax.php?package=ch.iframe.snode.messages&module=comp_messages&param_style=sections/body.tpl&x50_mode=' + $(this).attr('rel'),function(){
			bindBody();
			bindPaginator();
		});
		return false;
	});
}
// modes binden
function bindBody(){
	$('#XTMSGbody a.maillist').bind("click",function(){
		$('#XTMSGbody').load('/ajax.php?package=ch.iframe.snode.messages&module=comp_messages&param_style=sections/body.tpl&x50_mode=read&x50_message_id=' + $(this).attr('rel'),function(){
			// buttons laden und binden
			loadButtons();
		});

		return false;
	});
}

// buttons binden
function loadButtons(){
	$('#XTMSGbuttons').load('/ajax.php?package=ch.iframe.snode.messages&module=comp_messages&param_style=sections/buttons.tpl&param_is_controller=true&x50_message_id=' + $(this).attr('rel'),function(){
		bindButtons();
	});
}

function bindButtons(){
	$('#XTMSGbuttons a').bind("click",function(){
		 
		return false;
	});
} 

// paginator binden
function bindPaginator(){
	$('.XTMSGpaginator a').bind("click",function(){
		$('#XTMSGbody').html('<img src="/images/ajax-loader.gif" alt="" />');
		$('#XTMSGbody').load('/ajax.php?package=ch.iframe.snode.messages&module=comp_messages&param_style=sections/body.tpl' + $(this).attr('rel'),function(){
			bindBody();
			bindPaginator();
		});
		return false;
	});
}