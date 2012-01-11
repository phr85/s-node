
{if sizeof($x240_tree.data) > 0}
<div class="menuholder">
<ul id="menu">
{* Ebene 1 *}
{foreach from=$x240_tree.metadata.nodearray[$x240_tree.metadata.firstNodeInNodearray] item=NL1 name=N1 key=NODEL1}
	<li {if $x240_tree.data[$NODEL1].itw} class="XT_fm_tree_itw"{/if}>
		1<a  {if $x240_tree.data[$NODEL1].target != ''}target="{$x240_tree.data[$NODEL1].target}"{/if} href="{if $x240_tree.data[$NODEL1].ext_link}{$x240_tree.data[$NODEL1].ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$x240_tree.data[$NODEL1].id}{/if}"> {$x240_tree.data[$NODEL1].title}      </a>
		{* Ebene 2 *}
        {if $x240_tree.data[$NODEL1].subs > 0}
            <ul>
            {foreach from=$x240_tree.metadata.nodearray[$NODEL1] item=NL2 name=N2 key=NODEL2}
                <li>
                <a {if $x240_tree.data[$NODEL2].target != ''}target="{$x240_tree.data[$NODEL2].target}"{/if} href="{if $x240_tree.data[$NODEL2].ext_link}{$x240_tree.data[$NODEL2].ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$x240_tree.data[$NODEL2].id}{/if}"> {$x240_tree.data[$NODEL2].title}</a>
                    {* Ebene 3 *}
                    {if $x240_tree.data[$NODEL2].subs > 0}
                        <ul>
                        {foreach from=$x240_tree.metadata.nodearray[$NODEL2] item=NL3 name=N3 key=NODEL3}
                            <li>
                            <a  href="{if $x240_tree.data[$NODEL3].ext_link}{$x240_tree.data[$NODEL3].ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$x240_tree.data[$NODEL3].id}{/if}"> {$x240_tree.data[$NODEL3].title}</a>
                            </li>
                        {/foreach}
                        </ul>

                    {/if}
                </li>
            {/foreach}
            </ul>
        {/if}
    </li>
{/foreach}
</ul>
</div>
{/if}