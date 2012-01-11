{literal}
<style type="text/css">
@import url("{/literal}{$XT_STYLES}{literal}installer/default.css");
#introduction {
    width: 100%;
}
</style>
<script type="text/javascript">
var dm = false;
	function switchDeveloperMode() {
		if (dm==false) {
			document.getElementById('dm').style.display='inline';
			dm=true;
		} else {
			document.getElementById('dm').style.display='none';
			dm=false;
		}
	}
</script>
{/literal}
<form method="post" name="slave1">
{include file="ch.iframe.snode.installer/admin/hiddenValues.tpl"}
<div id="content">
<h1>{$TPL_REAL_TITLE}</h1>
<p id="introduction">{"intro_text"|translate}</p>
<ul id="packages">
 <li><input type="radio" name="x{$BASEID}_wizard" checked value="upload">&nbsp;{"<b>Upload</b> and install a package"|translate}</li>
 {if $fsockopen == "enabled"}<li><input type="radio" name="x{$BASEID}_wizard" value="online_update" checked="checked">&nbsp;{"Online installation / update"|translate}</li>{/if}
 <li><input type="radio" name="x{$BASEID}_wizard" value="update">&nbsp;{"<b>Update</b> an existing package"|translate}</li>
 <li><input type="radio" name="x{$BASEID}_wizard" value="upload_sampledata">&nbsp;{"<b>Upload</b> and install a sample data package"|translate}</li>
 <li><input type="radio" name="x{$BASEID}_wizard" value="upload_theme">&nbsp;{"<b>Upload</b> and install a new theme"|translate}</li>
{if $fsockopen == "enabled" && $DEVELOPER_MODE==1}<li><input type="radio" name="x{$BASEID}_wizard" value="developer_mode" onclick="switchDeveloperMode();">&nbsp;<span style="color:#FF3F59;">{"Developer mode"|translate}</span></li>{/if}

 <!--<li><input type="radio" name="x{$BASEID}_wizard" value="install">&nbsp;{"<b>Reinstall</b> a package from repository"|translate}</li>-->
</ul>
 <br />
<div id="dm" style="display:none;">
{"Developer password"|translate} <input type="password" name="x{$BASEID}_developer_password" />
</div>
</div>
<div id="control">
<input type="image" onclick="this.form.x{$BASEID}_action.value='goToNextStep';this.form.submit();" name="x{$BASEID}_wizard_submit" src="{$XT_IMAGES}installer/de/weiter.gif" />
</div>
</form>