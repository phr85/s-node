{if !$withouthidden}
<input type="hidden" name="showtabs" value="{$SHOWTABS}" />
<input type="hidden" name="x{$BASEID}_action" value="" />
{/if}
<div class="toolbar">
{if sizeof($data) > 0}
{foreach from=$data item=BUTTON}
<div class="ab"><div class="bbar">&nbsp;</div>
<div class="tbicon"><input type="image" src="{$XT_IMAGES}icons/{$BUTTON.icon}" {if $BUTTON.accesskey}accesskey="{$BUTTON.accesskey}"{/if} value="{$BUTTON.label}" name="submit_{$BUTTON.action}" class="{$BUTTON.class}" onclick="{$BUTTON.target}document.forms['{$BUTTON.form}'].x{$BASEID}_action.value='{$BUTTON.action}';{if $yoffset}{$BUTTON.target}document.forms['{$BUTTON.form}'].x{$BASEID}_yoffset.value=window.pageYOffset;{/if}{$BUTTON.target}document.forms['{$BUTTON.form}'].submit();{$BUTTON.script}" {$BUTTON.disabled} /></div>
<div class="tb"><a href="javascript:{$BUTTON.focus}{$BUTTON.target}document.forms['{$BUTTON.form}'].x{$BASEID}_action.value='{$BUTTON.action}';{if $yoffset}{$BUTTON.target}document.forms['{$BUTTON.form}'].x{$BASEID}_yoffset.value=window.pageYOffset;{/if}{$BUTTON.target}document.forms['{$BUTTON.form}'].submit();{$BUTTON.script}">{$BUTTON.label}</a></div>
</div>
{/foreach}
{/if}
</div> 
