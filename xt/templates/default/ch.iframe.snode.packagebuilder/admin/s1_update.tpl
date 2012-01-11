{literal}
<style type="text/css">
@import url("{/literal}{$XT_STYLES}{literal}installer/default.css");
#introduction {
    width: 100%;
}
</style>
{/literal}
<form method="POST" name="update" enctype="multipart/form-data">
{include file="ch.iframe.snode.installer/admin/hiddenValues.tpl"}
<div id="content">
<h1>{"Update Package"|translate}</h1>
<p id="introduction">{"Upload update from local source"|translate}</p>
<br />
<input type="file" size="50" name="x{$BASEID}_file" />
</div>
<div id="control">
<input type="hidden" name="x{$BASEID}_wizard" value="overview" />
<input type="image" onclick="this.form.x{$BASEID}_action.value='goToNextStep';this.form.submit();" name="x{$BASEID}_wizard_submit" src="{$XT_IMAGES}installer/de/zurueck.gif" />
<input type="image" onclick="this.form.x{$BASEID}_action.value='uploadUpdateToRepository';this.form.submit();" name="x{$BASEID}_wizard_submit" src="{$XT_IMAGES}installer/de/weiter.gif" />
</div>
</form>
