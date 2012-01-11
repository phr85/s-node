{foreach from=$LANGS key=KEY item=LANG}
<td class="table_header" width="16" style="padding: 3px 3px 2px 8px;"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_lang_filter={$KEY}"><img src="images/lang/{$KEY}.png" alt="" /></a></td>
{/foreach}