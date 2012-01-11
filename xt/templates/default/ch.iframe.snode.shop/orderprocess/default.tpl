<div class="catopwrapper">
{foreach from=$PROCESS item=STEP key=PSTEP}
    {if $PSTEP <= $OPSTEP}
        {if $STEP.tpl == $TPL}
            <div class="catopselected"><a href="{$smarty.server.PHP_SELF}?TPL={$STEP.tpl}">{$STEP.label}</a></div>
        {else}
            <div class="catop"><a href="{$smarty.server.PHP_SELF}?TPL={$STEP.tpl}">{$STEP.label}</a></div>
        {/if}
    {else}
        <div class="catop"> {$STEP.label}</div>
    {/if}
{/foreach}
<br clear="all" />
</div>