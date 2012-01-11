{literal}
<style type="text/css">
@import url("{/literal}{$XT_STYLES}{literal}installer/default.css");
#introduction {
    width: 100%;
}
</style>
{/literal}
<form method="post" name="slave1">
{include file="ch.iframe.snode.installer/admin/hiddenValues.tpl"}
<div id="content">
<h1>{$TPL_REAL_TITLE}</h1>
<p id="introduction">{"intro_text"|translate}</p>
<ul id="packages">
 <li><input type="radio" name="x{$BASEID}_wizard" checked value="upload">&nbsp;{"<b>Upload</b> and install a package"|translate}</li>
 <li><input type="radio" name="x{$BASEID}_wizard" value="update">&nbsp;{"<b>Update</b> an existing package"|translate}</li>
 <!--<li><input type="radio" name="x{$BASEID}_wizard" value="install">&nbsp;{"<b>Reinstall</b> a package from repository"|translate}</li>-->
</ul>
</div>
<div id="control">
<input type="image" onclick="this.form.x{$BASEID}_action.value='goToNextStep';this.form.submit();" name="x{$BASEID}_wizard_submit" src="{$XT_IMAGES}installer/de/weiter.gif" />
</div>
</form>
