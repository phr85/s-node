{if sizeof($ITEM_LANGS) > 1}
<table cellspacing="0" cellpadding="0">
 <tr>
 {foreach from=$ITEM_LANGS key=KEY item=LANG name=F_LANGS}
   {if $ACTIVE_LANG == $KEY}
    <td class="lang_tab_active"><a href="javascript:document.forms['{$form}'].x{$BASEID}_lang_filter.value='{$KEY}';document.forms['{$form}'].submit();"><img src="{$XT_IMAGES}lang/{$KEY}.png" alt="{$LANGS.$KEY.name}" title="{$LANGS.$KEY.name}" /></a></td>
    <td class="lang_tab_active">{$KEY}</td>
   {else}
    <td class="lang_tab"><a href="javascript:document.forms['{$form}'].x{$BASEID}_lang_filter.value='{$KEY}';document.forms['{$form}'].submit();"><img src="{$XT_IMAGES}lang/{$KEY}.png" alt="{$LANGS.$KEY.name}" title="{$LANGS.$KEY.name}" /></a></td>
    <td class="lang_tab">{$KEY}</td>
   {/if}
  {/foreach}
 </tr>
</table>
{/if}
<input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}" />