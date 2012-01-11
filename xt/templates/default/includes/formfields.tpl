{if $ROW.type == 'text'}
<td class="right">{$ROW.value}<input type="hidden" name="x{$BASEID}_{$FIELD}" value="{$ROW.value}" /></td>
{/if}
{if $ROW.type == 'inputpassword'}
<td class="right"><input type="password" name="x{$BASEID}_{$FIELD}" size="{$ROW.size}" /></b></td>
{/if}
{if $ROW.type == 'inputtext'}
<td class="right"><input type="text" name="x{$BASEID}_{$FIELD}" value="{$ROW.value}" size="{$ROW.size}" {if isset($ROW.params)}$ROW.params{/if} /></td>
{/if}
{if $ROW.type == 'inputcheckbox'}
<td class="right"><input type="checkbox" name="x{$BASEID}_{$FIELD}" value="1" {if isset($ROW.params)}$ROW.params{/if} /></td>
{/if}
{if $ROW.type == 'inputarea'}
<td class="right">
 <textarea name="x{$BASEID}_{$FIELD}" rows="{$ROW.rows}" cols="{$ROW.cols}" />{$ROW.value}</textarea>
</td>
{/if}
{if $ROW.type == 'select'}
<td class="right" valign="middle">
 <select name="x{$BASEID}_{$FIELD}">
  {html_options values=$ROW.value selected=$ROW.selected output=$ROW.value_labels}
 </select>
</td>
{/if}