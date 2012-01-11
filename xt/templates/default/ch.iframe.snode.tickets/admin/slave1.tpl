<form method="post" name="slave1" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div id="content">
<h1>{$TPL_REAL_TITLE}</h1>
<p class="introduction">{"intro_text"|translate}</p>
<p>RSS-Feed: http://{$smarty.server.SERVER_NAME}/index.php?TPL=8102&username=XYZ&password=XYZ</p>
</div>
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
</form>