<form method="post" enctype="multipart/form-data" name="fileupload" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
 <input type="file" size="36" name="file">
 <input type="button" value="{'Upload'|translate}" onclick="document.forms[0].x{$BASEID}_action.value='upload';document.forms[0].submit();">
 <input type="hidden" name="x{$BASEID}_action">
</form>