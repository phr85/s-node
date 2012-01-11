{get_param param=SOURCEBASEID assign=SBASEID}
{foreach from=$xt7500_viewer item=PROPERTY}
    {if $PROPERTY.type==3 ||$PROPERTY.type==4 ||$PROPERTY.type==9 ||$PROPERTY.type==10}
    <select name=x{$SBASEID}_property[{$PROPERTY.id}] onchange="submit();">
    {foreach from=$PROPERTY.data item=OPTION}
    {if $xt7400_filtered_list.filter.value}
    <option value="{$OPTION.value}"{if $xt7400_filtered_list.filter.value == $OPTION.value} selected="selected"{/if}>{$OPTION.label}</option>
    {else}
    <option value="{$OPTION.value}"{if $OPTION.default} selected="selected"{/if}>{$OPTION.label}</option>
    {/if}
    {/foreach}
    </select>
    {/if}
{/foreach}