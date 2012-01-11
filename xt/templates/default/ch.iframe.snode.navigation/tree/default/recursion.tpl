{if $xt60_tree.metadata.nodearray.$node|@count > 0}
    {* variables *}
    {assign var="ELEMENTS" value=$xt60_tree.metadata.nodearray.$node|@count}
    {assign var="COUNTER" value=1}
    {foreach from=$xt60_tree.metadata.nodearray.$node item=ITEM name=NAME key=KEY}
        {if $COUNTER == 1}
            {assign var=LEVEL value=$xt60_tree.data.$KEY.level}
        {/if}
    {/foreach}
    {* html *}
    <ul class="level_{$LEVEL}">
        {foreach from=$xt60_tree.metadata.nodearray.$node item=ITEM name=NAME key=KEY}
            <li class="node_{$KEY} level_{$LEVEL} element_{$COUNTER}{if $xt60_tree.metadata.nodearray.$KEY|@count > 0} submenu{/if}{if $xt60_tree.data.$KEY.selected} active{/if}{if $xt60_tree.data.$KEY.itw && !$xt60_tree.data.$KEY.selected} trail{/if}{if $COUNTER == 1} first{/if}{if $COUNTER == $ELEMENTS} last{/if}">
                <a class="node_{$KEY} level_{$LEVEL} element_{$COUNTER}{if $xt60_tree.metadata.nodearray.$KEY|@count > 0} submenu{/if}{if $xt60_tree.data.$KEY.selected} active{/if}{if $xt60_tree.data.$KEY.itw && !$xt60_tree.data.$KEY.selected} trail{/if}{if $COUNTER == 1} first{/if}{if $COUNTER == $ELEMENTS} last{/if}" {if $xt60_tree.data[$KEY].target != ''}target="{$xt60_tree.data[$KEY].target}"{/if} href="{if $xt60_tree.data.$KEY.ext_link}{$xt60_tree.data.$KEY.ext_link}{else}/{$SYSTEM_LANG}/{$xt60_tree.data.$KEY.id}/{$xt60_tree.data.$KEY.title|cleanlink}.html{/if}">
                    {$xt60_tree.data.$KEY.title}
                </a>
                {if $xt60_tree.metadata.nodearray.$KEY|@count > 0}
                    {include file="ch.iframe.snode.navigation/tree/default/recursion.tpl" node=$KEY}
                {/if}
                {assign var="COUNTER" value=$COUNTER+1}
            </li>
        {/foreach}
    </ul>
{/if}