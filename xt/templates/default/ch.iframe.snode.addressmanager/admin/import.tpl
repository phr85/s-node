<form method="post" name="upload" enctype="multipart/form-data">
{include file="includes/buttons.tpl" data=$BUTTONS}
<div id="content">
<h2>{"Address importer"|translate}</h2>
<p id="introduction">{"select File"|translate}</p>
<br />

<input type="file" size="25" name="x{$BASEID}_file" value=""/>
<input type="hidden" name="module" value="{$ADMINMODULE}" />

</div>
</form>