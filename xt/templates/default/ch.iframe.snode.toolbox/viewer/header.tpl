{XT_load_css file="toolbox.css"}
{XT_load_css file="livetranslate.css"}
<!-- header toolbox-->
<div id="toolboxswitcher2">
	<img src="{$XT_IMAGES}spacer.gif" width="10" height="5" alt=""/><br />
	<div class="toolboxswitcherlogo2" onclick="javascript: location.href='http://www.s-node.com';">&nbsp;</div>
	<img src="{$XT_IMAGES}spacer.gif" width="10" height="10" alt=""/><br />
	<div class="toolboxswitcherbuttons2" onclick="location.href='{$smarty.server.PHP_SELF}?TPL=102&amp;adminmode=1';" onmouseover="this.style.backgroundImage='url(images/admin/button_over.gif);';" onmouseout="this.style.backgroundImage='url(images/admin/button.gif);';">{"Struktur"|translate}</div>
	<div class="toolboxswitcherbuttons2" onclick="location.href='{$smarty.server.PHP_SELF}?TPL=120&amp;adminmode=1';" onmouseover="this.style.backgroundImage='url(images/admin/button_over.gif);';" onmouseout="this.style.backgroundImage='url(images/admin/button.gif);';">{"Dateien"|translate}</div>
	<div class="toolboxswitcherbuttons2" onclick="location.href='{$smarty.server.PHP_SELF}?TPL=119&amp;adminmode=1';" onmouseover="this.style.backgroundImage='url(images/admin/button_over.gif);';" onmouseout="this.style.backgroundImage='url(images/admin/button.gif);';">{"Artikel"|translate}</div>
	<div class="toolboxswitcherbuttons2" onclick="location.href='{$smarty.server.PHP_SELF}?TPL=118&amp;adminmode=1';" onmouseover="this.style.backgroundImage='url(images/admin/button_over.gif);';" onmouseout="this.style.backgroundImage='url(images/admin/button.gif);';">{"Formulare"|translate}</div>
	{literal}
	<script type="text/javascript">
		// handler for the toolbar
		function toolbarhandler() {
			if(document.getElementById('toolbox2').style.display=='inline'){
				document.getElementById('toolbox2').style.display='none';
				eraseCookie('toolbox');
				createCookie('toolbox','closed');
			}else{
				document.getElementById('toolbox2').style.display='inline';
				eraseCookie('toolbox');
				createCookie('toolbox','open');
			}
		}
		function gettoolbarstate() {
			var status;
			status =  readCookie('toolbox');
			if (status == null || status == 'closed') {
				document.getElementById('toolbox2').style.display='none';
			} else {
				document.getElementById('toolbox2').style.display='inline';
			}
		}
		function livetranslatehandler() {
			if(readCookie('livetranslate') == 'active'){
				document.getElementById('lt').src='images/icons/text.png'
				eraseCookie('livetranslate');
				createCookie('livetranslate','inactive');

			}else{
				document.getElementById('lt').src='images/icons/text_marked.png'
				eraseCookie('livetranslate');
				createCookie('livetranslate','active');
			}
			document.toolbox.submit();
		}
		function getlivetranslatestate() {
			var status;
			status =  readCookie('livetranslate');
			if (status == null || status == 'inactive') {
				document.getElementById('lt').src='images/icons/text.png';
			} else {
				document.getElementById('lt').src='images/icons/text_marked.png';
			}
		}
	</script>
	{/literal}
	<div class="toolboxswitcherbuttons2_live" onclick="toolbarhandler();" onmouseover="this.style.backgroundImage='url(images/admin/live_edit_over.gif);';" onmouseout="this.style.backgroundImage='url(images/admin/live_edit.gif);';">{"Toolbox"|translate}</div>
	<img src="{$XT_IMAGES}spacer.gif" width="10" height="220" alt=""/><br />
	<div class="toolboxswitcherbuttons2" onclick="location.href='{$smarty.server.PHP_SELF}?TPL=126&amp;adminmode=1';" onmouseover="this.style.backgroundImage='url(images/admin/button_over.gif);';" onmouseout="this.style.backgroundImage='url(images/admin/button.gif);';">{"System"|translate}</div>
	<div class="toolboxswitcherbuttons2" onclick="location.href='{$smarty.server.PHP_SELF}?logout=1'" onmouseover="this.style.backgroundImage='url(images/admin/button_over.gif);';" onmouseout="this.style.backgroundImage='url(images/admin/button.gif);';" >{"Logout"|translate}</div>
</div>
<div id="toolboxswitcher2_end"><img src="images/admin/end.gif" alt="end"/></div>
<div id="toolbox2">
	<script type="text/javascript">gettoolbarstate();</script>
	<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="toolbox">
	<input type="hidden" name="x{$BASEID}_tab" value="" />
	<table cellspacing="0" cellpadding="0" width="100%" style="background-color: white;" summary="">
	 <tr>
	 <td class="top_head">{$TPL_REAL_TITLE}</td>
	 <td class="top_head" align="right" style="padding:0px;"><a href="javascript:toolbarhandler();"><img {"Close"|alttag} src="{$XT_IMAGES}admin/close.gif"/></a></td>
	 </tr>
	 <tr>
	  <td class="tab_container" style="padding: 0px; height: 22px;" valign="top" colspan="2">
	   <table cellspacing="0" cellpadding="0" align="left" summary="">
	    <tr>
	     {foreach from=$TABS key=KEY item=TAB name=TABLOOP}
	      {if $TAB.visible}
	       {if $KEY eq $ACTIVE_TAB}
	       <td class="tab_active" onclick=";document.forms['toolbox'].x{$BASEID}_tab.value='{$KEY}';document.forms['toolbox'].submit();">{$TAB}</td>
	       {else}
	        <td class="tab" onclick=";document.forms['toolbox'].x{$BASEID}_tab.value='{$KEY}';document.forms['toolbox'].submit();">{$TAB}</td>
	       {/if}
	      {/if}
	     {/foreach}
	    </tr>
	   </table>
	  </td>
	 </tr>
	</table>
	</form>
	<!-- /header toolbox-->