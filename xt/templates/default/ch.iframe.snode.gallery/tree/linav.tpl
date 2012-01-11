{if sizeof($x4100_tree.data) > 0}
<div class="menuholder">
<ul id="menu">
{* Ebene 1 *}
{foreach from=$x4100_tree.metadata.nodearray[$x4100_tree.metadata.firstNodeInNodearray] item=NL1 name=N1 key=NODEL1}
	<li {if $x4100_tree.data[$NODEL1].itw} class="itw"{/if}>
		<a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_node={$x4100_tree.data[$NODEL1].id}"> {$x4100_tree.data[$NODEL1].title}</a>
		{* Ebene 2 *}
        {if $x4100_tree.data[$NODEL1].subs > 0}
            <ul>
            {foreach from=$x4100_tree.metadata.nodearray[$NODEL1] item=NL2 name=N2 key=NODEL2}
                <li>
                <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_node={$x4100_tree.data[$NODEL2].id}"> {$x4100_tree.data[$NODEL2].title}</a>
                    {* Ebene 3 *}
                    {if $x4100_tree.data[$NODEL2].subs > 0}
                        <ul>
                        {foreach from=$x4100_tree.metadata.nodearray[$NODEL2] item=NL3 name=N3 key=NODEL3}
                            <li>
                            <a  href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_node={$x4100_tree.data[$NODEL3].id}"> {$x4100_tree.data[$NODEL3].title}</a>
                                {* Ebene 4 *}
                                {if $x4100_tree.data[$NODEL3].subs > 0}
                                    <ul>
                                    {foreach from=$x4100_tree.metadata.nodearray[$NODEL3] item=NL4 name=N4 key=NODEL4}
                                        <li>
                                         <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_node={$x4100_tree.data[$NODEL4].id}"> {$x4100_tree.data[$NODEL4].title}</a>
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
        {/if}
    </li>
{/foreach}
</ul>
</div>
{/if}