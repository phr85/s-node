{strip}
<dl>
    {if $xt1400_tree.nodearray.$node|@count > 0}
        {foreach from=$xt1400_tree.nodearray[$node] item=something key=subnode}
            <dt class="node {if $xt1400_tree.nodearray.$subnode|@count == 0 && $xt1400_tree.questions.$subnode|@count == 0}nosubelement{/if}">
                {$xt1400_tree.data.$subnode.title}
            </dt>
            <dd>
                {if $xt1400_tree.nodearray.$subnode|@count > 0 || $xt1400_tree.questions.$subnode|@count > 0}
                    {include file="ch.iframe.snode.faq/tree/recursion.tpl" node=$subnode}
                {/if}
            </dd>
        {/foreach}
    {/if}
    {if $xt1400_tree.questions.$node|count > 0}
        {foreach from=$xt1400_tree.questions.$node item=QUESTION}
            <dt>
                {if $QUESTION.title != ""}{$QUESTION.title}<br />{/if}
                {if $QUESTION.description != ""}{$QUESTION.description}<br />{/if}
            </dt>
            <dd class="question">
                {if $QUESTION.answer_title != ""}{$QUESTION.answer_title}<br />{/if}
                {if $QUESTION.answer != ""}{$QUESTION.answer}<br />{/if}
            </dd>
        {/foreach}
    {/if}
</dl>
{/strip}