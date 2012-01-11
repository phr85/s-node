{XT_load_css file="jquery.droppy.css"}
{XT_load_js file="jquery-plugins/jquery.droppy.js"}
{XT_load_js file="ch.iframe.snode.navigation/call.jquery.droppy.js"}

{get_param param="node" assign="node"}

{if $NODEARRAY.$node|@count > 0}
    <ul id="nav">
        {foreach from=$NODEARRAY.$node item=NL1 name=N1 key=NODEL1}
            <li>
                <a class="{if $DATA[$NODEL1].itw}droppynavitw{/if} {if $smarty.foreach.N1.last}droppynavlast{/if}" {if $DATA[$NODEL1].target != ''}target="{$DATA[$NODEL1].target}"{/if} href="{if $DATA[$NODEL1].ext_link}{$DATA[$NODEL1].ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$DATA[$NODEL1].id}{/if}">
                    {$DATA[$NODEL1].title}
                </a>
                {if $NODEARRAY[$NODEL1]|@count > 0}
                    <ul>
                        {foreach from=$NODEARRAY[$NODEL1] item=NL2 name=N2 key=NODEL2}
                            <li>
                                <a class="{if $DATA[$NODEL2].itw}droppynavitw{/if}" {if $DATA[$NODEL2].target != ''}target="{$DATA[$NODEL2].target}"{/if} href="{if $DATA[$NODEL2].ext_link}{$DATA[$NODEL2].ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$DATA[$NODEL2].id}{/if}">
                                    {$DATA[$NODEL2].title}
                                </a>
                            </li>
                        {/foreach}
                    </ul>
                {/if}
            </li>
        {/foreach}
    </ul>
{/if}