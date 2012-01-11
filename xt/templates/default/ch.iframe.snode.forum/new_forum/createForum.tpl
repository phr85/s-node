<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="reply">
{"Title"|translate}<br />
<input type="text" name="x{$BASEID}_title" size="42" /><br /><br />
{"Description"|translate}<br />
<textarea name="x{$BASEID}_description"></textarea><br /><br />

<input type="submit" class="img_button" value="{'Create forum'|translate}" />
<input type="hidden" name="x{$BASEID}_category_id" value="{$CATEGORYID}" />
<input type="hidden" name="x{$BASEID}_action" value="createForumWriteDB" />
</form>
