{literal}
<style type="text/css">
@import url("{/literal}{$XT_STYLES}{literal}installer/default.css");
#introduction {
    width: 100%;
}
</style>
{/literal}
{if $FILES|count > 0}
<form method="post" name="remoteinstall">
<div id="content">
<h1>{"Developer mode"|translate}</h1><br/><br/>
<input type="checkbox" name="x{$BASEID}_overwrite_config" checked="checked"/> {"overwrite_config"|translate}<br />
<input type="checkbox" name="x{$BASEID}_overwrite_translations" checked="checked"/> {"overwrite_translations"|translate}
<br/><br/>
	<select name="x{$BASEID}_package">
	{foreach from=$FILES item=file}
		<option value="{$file.0}" class="stats_{if $file.installed}green{else}red{/if}">{$file.1} {$file.0}</option>
	{/foreach}
	</select>

	<br />
	<br />
	{"grün = installiert, rot = noch nicht installiert"}
</div>

<div id="control">
<input type="hidden" name="x{$BASEID}_wizard" value="overview" />
<input type="image" onclick="this.form.x{$BASEID}_action.value='goToNextStep';this.form.submit();" name="x{$BASEID}_wizard_submit" src="{$XT_IMAGES}installer/de/zurueck.gif" />
<input type="image" onclick="this.form.x{$BASEID}_action.value='developer_remoteinstall';this.form.submit();" name="x{$BASEID}_wizard_submit" src="{$XT_IMAGES}installer/de/weiter.gif" />
</div>

<input type="hidden" name="x{$BASEID}_action" value="" />

</form>
{/if}