{foreach from=$xt7500_viewer item=PROPERTY}
    {if $PROPERTY.type==3 ||$PROPERTY.type==4 ||$PROPERTY.type==9 ||$PROPERTY.type==10}
    <select name=x{$BASEID}_property[{$PROPERTY.id}]>
    <option value="" selected="selected">{"Select"|translate}</option>
    {foreach from=$PROPERTY.data item=OPTION}
    <option value="{$OPTION.value}"{if $xt7500_viewer.selected[$PROPERTY.id] ==  $OPTION.value ||  $OPTION.default} selected="selected"{/if}>{$OPTION.label}</option>
    {/foreach}
    </select>
    {/if}
{/foreach}