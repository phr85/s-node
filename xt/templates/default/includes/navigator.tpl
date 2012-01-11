{if $PAGE_START <= $PAGE_END && $PAGE_START >= 0}
  <table cellspacing="0" cellpadding="0" width="100%">
   <tr>
    <td class="subhead_bottom" style="width: 90px;"><b>{$PAGE_START}</b> {"to"|translate} <b>{$PAGE_END}</b> {"from"|translate} <b>{$TOTAL_COUNT}</b></td>

    {foreach from=$PAGES name=NAVIGATOR item=PAGE}
    <td class="pages{if $ACTIVE_PAGE == $smarty.foreach.NAVIGATOR.iteration}_active{/if}" style="width: 9px;" 
        onclick="document.forms['{$form}'].x{$BASEID}_page.value='{$smarty.foreach.NAVIGATOR.iteration}';document.forms['{$form}'].submit();">{$smarty.foreach.NAVIGATOR.iteration}
    </td>
    {/foreach}
    <td class="subhead_bottom">&nbsp;</td>
   </tr>
  </table>
  {/if}
 {if !$withouthidden}
 <input type="hidden" name="x{$BASEID}_page" value="{$ACTIVE_PAGE}" />
 {/if}