{if sizeof($LANGS) > 1}
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td class="lang_tab" style="padding: 0px;">
<table cellspacing="0" cellpadding="0">
 <tr style="cursor: hand; cursor: pointer;">
 {foreach from=$LANGS key=KEY item=LANG name=F_LANGS}
   {if $ACTIVE_LANG == $KEY}
    <td onclick="document.forms['{$form}'].x{$BASEID}_lang_filter.value='{$KEY}'; document.forms['{$form}'].x{$BASEID}_action.value='{$action}';document.forms['{$form}'].submit();" class="lang_tab_active"><img src="{$XT_IMAGES}lang/{$KEY}.png" alt="{$LANGS.$KEY.name}" title="{$LANGS.$KEY.name}" /></td>
    {if sizeof($LANGS) < 5}
    <td onclick="document.forms['{$form}'].x{$BASEID}_lang_filter.value='{$KEY}'; document.forms['{$form}'].x{$BASEID}_action.value='{$action}';document.forms['{$form}'].submit();" class="lang_tab_active" style="padding-right: 10px;">{$KEY}</td>
    {/if}
   {else}
    <td onclick="document.forms['{$form}'].x{$BASEID}_lang_filter.value='{$KEY}'; document.forms['{$form}'].x{$BASEID}_action.value='{$action}';document.forms['{$form}'].submit();" class="lang_tab"><img src="{$XT_IMAGES}lang/{$KEY}.png" alt="{$LANGS.$KEY.name}" title="{$LANGS.$KEY.name}" /></td>
    {if sizeof($LANGS) < 5}
    <td onclick="document.forms['{$form}'].x{$BASEID}_lang_filter.value='{$KEY}'; document.forms['{$form}'].x{$BASEID}_action.value='{$action}';document.forms['{$form}'].submit();" class="lang_tab" style="padding-right: 10px;">{$KEY}</td>
    {/if}
   {/if}
  {/foreach}
 </tr>
</table>
</td>
</tr>
</table>
{/if}
<input type="hidden" name="x{$BASEID}_lang_filter" value="{$ACTIVE_LANG}" />
<input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}" />
