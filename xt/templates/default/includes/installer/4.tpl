{include file="header.tpl"}
<form method="post">
<div><img src="{$XT_IMAGES}installer/logo.gif" alt="" /></div>
<div id="content">
<h1>Paketinstallationen</h1>
<p id="subline">Wählen Sie hier die zu installierenden Pakete aus.</p>
<p id="introduction">Die untenstehenden Erweiterungen stehen für Ihr S-Node System zur Verfügung und können 30 Tage lang kostenlos und unverbindlich genutzt werden. Nach Ablauf dieser Frist können Sie auf www.s-node.com einen Lizenzschlüssel pro Paket erwerben, falls Sie dieses einsetzen wollen. Über die Konditionen können Sie sich auf unserer Webseite informieren.</p>
<ul id="packages">
{foreach from=$PACKAGES item=PACKAGE}
<li><input type="checkbox" name="package[{$PACKAGE}]" value="1" checked {if
$PACKAGE == 'ch.iframe.snode.core.xtp' ||
$PACKAGE == 'ch.iframe.snode.core_install.xtp' ||
$PACKAGE == 'ch.iframe.snode.navigation.xtp' ||
$PACKAGE == 'ch.iframe.snode.installer.xtp' ||
$PACKAGE == 'ch.iframe.snode.usermanager.xtp' ||
$PACKAGE == 'ch.iframe.snode.search.xtp'
}disabled{/if}>&nbsp;{$PACKAGE}</li>
{/foreach}
</ul>
{if sizeof($3RD_PACKAGES) > 0}
<span style="color: orange;">Die Installation folgender Drittanbieterpakete erfolgt auf eigene Verantwortung.</span>
<ul id="packages">
{foreach from=$3RD_PACKAGES item=PACKAGE}
<li><input type="checkbox" name="package[{$PACKAGE}]" value="1">&nbsp;{$PACKAGE}</li>
{/foreach}
</ul>
{/if}
</div>
<div id="control">
 <input type="image" src="{$XT_IMAGES}installer/de/zurueck.gif" onclick="document.forms[0].step.value='3';" />
 <input type="image" src="{$XT_IMAGES}installer/de/weiter.gif" />
 <input type="hidden" name="step" value="5" />
</div>
</form>
{include file="footer.tpl"}