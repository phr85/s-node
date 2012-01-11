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
<h1>{"Create your own theme"|translate}</h1>
<p id="introduction">{"Please type in a title for the new theme"|translate}</p>
<br />
<div id="form" style="margin-bottom: 0px;">
<label for="x{$BASEID}_theme_title" style="padding-left: 0px;">{"Theme title"|translate}</label>
<input type="text" name="x{$BASEID}_theme_title" value="Yourtheme" onkeyup="document.getElementById('css').value=this.value.toLowerCase() + '.css'"><br />
<label for="x{$BASEID}_switch" style="padding-left: 0px;">{"Activate?"|translate}</label>
<input type="checkbox" name="x{$BASEID}_switch" value="1" checked>
<p id="introduction">{"Site settings (Default)"|translate}</p><br />
<label for="x{$BASEID}_doctype" style="padding-left: 0px;">{"Doctype"|translate}</label>
<select name="x{$BASEID}_doctype">
{foreach from=$DOCTYPES key=KEY item=DOCTYPE}
<option>{$KEY}</option>
{/foreach}
</select>
<p id="introduction">{"Style settings (Default)"|translate}</p><br />
<label for="x{$BASEID}_create_css" style="padding-left: 0px;">{"Create new CSS?"|translate}</label>
<input type="checkbox" name="x{$BASEID}_create_css" value="1" checked><br />
<label for="x{$BASEID}_css" style="padding-left: 0px;">{"CSS Name"|translate}</label>
<input type="text" id="css" name="x{$BASEID}_css" value="yourtheme.css"><br />
</div>
</div>
<div id="control">
<input type="image" onclick="this.form.x{$BASEID}_action.value='createTheme';this.form.submit();" name="x{$BASEID}_wizard_submit" src="{$XT_IMAGES}installer/de/weiter.gif" />
</div>
</form>
