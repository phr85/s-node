{include file="header.tpl"}
<form method="post">
<div><img src="{$XT_IMAGES}installer/logo.gif" alt="" /></div>
<div id="content">
<h1>Datenbankverbindung</h1>
<p id="subline">Eingabe der Zugangsdaten zum Datenbank Server</p>
<p id="introduction">Der Installations-Assistent wird nun Überprüfen, ob eine Datenbank zur Installation zur Verfügung steht.</p>
</div>
<div id="form">
<label for="db_host">Host (Server)</label>
<input type="text" name="db_host" value="localhost"><br />
<label for="db_username">Username</label>
<input type="text" name="db_username" value="root"><br />
<label for="db_password">Password</label>
<input type="password" name="db_password"><br />
</div>
<div id="control">
 <input type="image" src="{$XT_IMAGES}installer/de/zurueck.gif" onclick="document.forms[0].step.value='1a';" />
 <input type="image" src="{$XT_IMAGES}installer/de/weiter.gif" />
 <input type="hidden" name="step" value="2" />
</div>
</form>
{include file="footer.tpl"}