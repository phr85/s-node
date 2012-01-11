<h1>Letzte Änderungen</h1>
{foreach from=$ENTRIES key=DATE item=ETS}
<h2>{$DATE}</h2>
{foreach from=$ETS item=ENTRY}
<a href="{$ENTRY.url}" style="color: #999999;">{$ENTRY.title}</a> <span style="color: #666666;">({$ENTRY.content_type_title})</span>, <span style="font-size: 11px; color: #9F1A09;">{$ENTRY.mod_date|date_format:"%H:%I"} Uhr{if $ENTRY.username != ''}, {$ENTRY.username}{/if}</span><br />
{/foreach}
<br />
{/foreach}