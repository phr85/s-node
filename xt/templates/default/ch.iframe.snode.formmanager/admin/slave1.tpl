<form method="post" name="slave1" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div id="content">
<h1>{$TPL_REAL_TITLE}</h1>
<p id="introduction">{"intro_text"|translate}</p>
<div id="tipp"><img src="{$XT_IMAGES}admin/tipps/ch.iframe.snode.formmanager/tipp1.gif" alt="" class="tipp"/>{"tipp1"|translate}</div>
<input type="hidden" name="x{$BASEID}_action" />
<input type="hidden" name="x{$BASEID}_form_id" />
<input type="hidden" name="x{$BASEID}_script_id" />
<br clear="all" />
</div>
</form>