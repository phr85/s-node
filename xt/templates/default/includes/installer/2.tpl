{include file="header.tpl"}
<form method="post">
<div><img src="{$XT_IMAGES}installer/logo.gif" alt="" /></div>
<div id="content">
<h1>Datenbank wählen</h1>
<p id="subline">Wählen Sie eine Datenbank auf welcher S-Node XT installiert werden soll.</p>
<p id="introduction">{if $CONNECTED}Die in der Liste aufgeführten Datenbanken stehen auf dem Server zur Verfügung.
{else}
<span style="color: orange">Verbindung zum Datenbank Server fehlgeschlagen. Bitte Überprüfen Sie die Zugangsdaten.</span>
{/if}
</p>
</div>
{if $CONNECTED}
<div id="form">
<label for="db_database">Datenbank</label>
<select name="db_database">
{foreach from=$DATABASES item=DATABASE}
<option>{$DATABASE}</option>
{/foreach}
</select><br />
<label for="db_prefix">Datenbank Prefix</label>
<input type="text" name="db_prefix" value="xt_"><br />
</div>
{/if}
<div id="control">
 <input type="image" src="{$XT_IMAGES}installer/de/zurueck.gif" onclick="document.forms[0].step.value='1';" />
 {if $CONNECTED}<input type="image" src="{$XT_IMAGES}installer/de/weiter.gif" />{/if}
 <input type="hidden" name="step" value="3" />
</div>
</form>
{include file="footer.tpl"}