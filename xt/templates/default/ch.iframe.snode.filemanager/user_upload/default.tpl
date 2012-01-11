<fieldset class="full"><legend>{"upload file"|translate}</legend>
<form method="post" enctype="multipart/form-data" name="fileupload" action="index.php?TPL={$TPL}">
 <input type="file" size="36" name="file" class="portionsubmit" />
 <input type="button" class="portionsubmit" value="{'Upload'|translate}" onclick="document.forms['fileupload'].x{$BASEID}_action.value='user_uploadFile';document.forms['fileupload'].submit();" />
 <input type="hidden" name="x{$BASEID}_action" />
</form>
</fieldset>