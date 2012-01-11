{if $PAGE_START <= $PAGE_END && $PAGE_START >= 0}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="listnavigator_table_header" colspan="{$PAGE_COUNT+1}">{"Showing entries"|translate} <b>{$PAGE_START}</b> {"to"|translate} <b>{$PAGE_END}</b> {"from"|translate} <b>{$TOTAL_COUNT}</b></td>
 </tr>
 <tr>
  {foreach from=$PAGES name=NAVIGATOR item=PAGE}
  <td class="listnavigator_char{if $ACTIVE_PAGE == $smarty.foreach.NAVIGATOR.iteration}_active{/if}" onclick="window.location.href='{$smarty.server.PHP_SELF}?{foreach from=$smarty.get key=GETKEY item=GETVAR}{if substr($GETKEY,-4) != 'page'}{$GETKEY}={$GETVAR}&{/if}{/foreach}&x{$BASEID}_page={$smarty.foreach.NAVIGATOR.iteration}'">{$smarty.foreach.NAVIGATOR.iteration}</td>
  {/foreach}
  <td>&nbsp;</td>
 </tr>
</table>
<br />
{/if}
