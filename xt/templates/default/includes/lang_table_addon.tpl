{foreach from=$LANGS key=KEY item=LANG}
   {if isset($ITEM_LANGS[$KEY][$data.id]) && $ITEM_LANGS[$KEY][$data.id] == 1}
   <td class="row" style="padding: 5px 0px 0px 10px;"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=deactivateLang&x{$BASEID}_id={$data.id}&x{$BASEID}_lang_filter={$KEY}"><img src="images/icons/active_small.gif" alt="" /></a></td>
   {else}
    {if isset($ITEM_LANGS[$KEY][$data.id]) && $ITEM_LANGS[$KEY][$data.id] == 2}
    <td class="row" style="padding: 5px 0px 0px 10px;"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=activateLang&x{$BASEID}_id={$data.id}&x{$BASEID}_lang_filter={$KEY}"><img src="images/icons/inactive_small.gif" alt="" /></a></td>
    {else}
    <td class="row" style="padding: 3px 0px 0px 10px;"><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=addLang&x{$BASEID}_id={$data.id}&x{$BASEID}_lang_filter={$KEY}"><img src="images/icons/add.gif" alt="" /></a></td>
    {/if}
   {/if}
{/foreach}