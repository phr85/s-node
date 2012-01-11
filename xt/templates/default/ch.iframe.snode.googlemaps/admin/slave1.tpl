<form method="post" name="slave1" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div id="content">
<h1>{$TPL_REAL_TITLE}</h1>
	<p class="introduction">{"intro_text_intro"|translate}</p>
	<div><img src="{$XT_IMAGES}admin/tipps/ch.iframe.snode.googlemaps/overview.png" alt="" class="tipp"/>{"intro_text_desc"|translate}<br clear="all" /><br />
	<div><img src="{$XT_IMAGES}admin/tipps/ch.iframe.snode.googlemaps/edit.png" alt="" width="337" class="tipp"/>{"intro_text_addr_desc"|translate}<br /><br /><br clear="all" />
</div>
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
</form>