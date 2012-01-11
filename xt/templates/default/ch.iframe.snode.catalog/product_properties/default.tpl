<!-- {$ARTICLE_TITLE} -->
{$GROUP_TITLE}
<table width="100%" border="0" cellpadding="0" cellspacing="0">
{foreach from=$PROPS item=PROP}
<tr>
      <td style="padding-right: 10px;">{$PROP.title}</td>
        <td>
        {if $PROP.type == 4}
            
            {if $PROP.data != ""}
            <ul>
                {foreach from=$PROP.data item=ITEM}
                <li>{$ITEM.label}></li> 
                {/foreach}
            </ul>
            {/if}
        {else}       
            {$PROP.display}
        {/if}
        </td>
    </tr>
{/foreach}
</table>