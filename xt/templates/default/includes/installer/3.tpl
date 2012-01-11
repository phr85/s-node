{include file="header.tpl"}
<form method="post">
<div><img src="{$XT_IMAGES}installer/logo.gif" alt="" /></div>
<div id="content">
<h1>Systemeinstellungen</h1>
<p id="subline">Eingabe der Grunddaten für Ihr S-Node XT System</p>
<p id="introduction">Legen Sie fest, welcher Systemname und welcher Standard-Kontakt verwendet werden soll.</p>
</div>
<div id="form">
<label for="system_name" style="color: orange; font-weight: bold;">Lizenznummer</label>
<input type="text" name="system_order_nr" value="{$LICENSENUMBER}" size="5"><br />
<label for="webroot_dir">Installationsordner</label>
<input type="text" name="webroot_dir" value="{$WEBROOT_DIR|default:'/'}" size="46"><br />
<label for="system_name">Name des Systems</label>
<input type="text" name="system_name" value="S-Node XT" size="46"><br />
<label for="system_email">E-Mail Adresse</label>
<input type="text" name="system_email" value="info@yourdomain.com" size="46"><br />
<label for="system_meta_title">Seitentitel (Basis)</label>
<input type="text" name="system_meta_title" value="S-Node XT - " size="46"><br />
<label for="system_meta_description">Beschreibung (Standartwert)</label>
<textarea name="system_meta_description" cols="70" rows="4">Beschreibung Ihrer Seite</textarea><br />
<label for="system_meta_keywords">Schlüsselwörter (Standartwert)</label>
<textarea name="system_meta_keywords" cols="70" rows="4">Schlüsselwörter, für, Ihre, Seite</textarea><br />
<label for="system_meta_copyright">Copyright (Standartwert)</label>
<input type="text" name="system_meta_copyright" value="iframe AG, Widnau, Switzerland" size="46"><br />
<label for="system_meta_author">Autor (Standartwert)</label>
<input type="text" name="system_meta_author" value="Hans Mustermann, h.mustermann@iframe.ch" size="46"><br />
<label for="system_meta_revisit_after">Die Seite soll von den Suchmaschinen nach x tagen wieder indexiert werden. (Standartwert)</label>
<input type="text" name="system_meta_revisit_after" value="10 days" size="46"><br />
<br />
<br />
<label for="piwik_id">Piwik ID</label>
<input type="text" name="system_piwik_id" value="" size="46"><br />
<label for="google_analytics_key">Google Analytics Key</label>
<input type="text" name="system_google_analytics_key" value="" size="46"><br />
<label for="google_maps_key">Google Maps Key</label>
<input type="text" name="system_google_maps_key" value="" size="120"><br />
<label for="smtp_Host">Mail Server (Standartwert)</label>
<input type="text" name="smtp_Host" value="localhost" size="46"><br />
</div>
<div id="control">
 <input type="image" src="{$XT_IMAGES}installer/de/zurueck.gif" onclick="document.forms[0].step.value='2';" />
 <input type="image" src="{$XT_IMAGES}installer/de/weiter.gif" />
 <input type="hidden" name="step" value="4" />
</div>
</form>
{include file="footer.tpl"}
