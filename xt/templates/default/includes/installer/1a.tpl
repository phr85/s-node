{include file="header.tpl"}
<form method="post">
<div><img src="{$XT_IMAGES}installer/logo.gif" alt="" /></div>
<div id="content">
<h1>Systemvoraussetzungen prüfen</h1>
<p id="subline">S-Node XT Systemprüfung</p>
<p id="introduction">S-Node XT hat Ihr System geprüft und folgende Ergebnisse festgestellt.</p>
{if $ERROR}<span style="color: darkorange">Ihr System erfüllt die Systemvoraussetzungen nicht, bitte setzen Sie sich mit dem S-Node Support in Verbindung (http://www.s-node.com)</span>{/if}
</div>
<div id="form">
<label>PHP</label>
<span class="plain{if $PHP}_ok{else}_failed{/if}">{if $PHP}OK{else}FAILED{/if} ({$PHP_VERSION})</span>
<label>MySQL Unterstützung</label>
<span class="plain{if $MYSQL}_ok{else}_failed{/if}"><br />{if $MYSQL}OK{else}FAILED{/if}</span><br /><br />
<label>GD Bibliothek</label>
<span class="plain{if $GD}_ok{else}_failed{/if}">{if $GD}OK{else}FAILED{/if} ({$GD_VERSION})</span><br />
<label>Zend Optimizer</label>
<span class="plain{if $OPTIMIZER}_ok{else}_failed{/if}">{if $OPTIMIZER}OK{else}FAILED{/if}</span><br />
<label>Berechtigungen (chmod)</label>
<span class="plain{if $CHMOD}_ok{else}_failed{/if}">{if $CHMOD}OK{else}FAILED{/if}</span><br />
</div>
<div id="control">
 <input type="image" src="{$XT_IMAGES}installer/de/zurueck.gif" onclick="document.forms[0].step.value='0';" />
 {if !$ERROR}<input type="image" src="{$XT_IMAGES}installer/de/weiter.gif" />{/if}
 <input type="hidden" name="step" value="1" />
</div>
</form>
{include file="footer.tpl"}