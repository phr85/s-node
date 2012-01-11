{if sizeof($DATA) > 0}
<div class="menuholder">
<ul id="menu">
{foreach from=$NODEARRAY.10000 item=NL1 name=N1 key=NODEL1}
	<li {if $DATA[$NODEL1].itw} style="background-color:#A6AFBF;"{/if}>
		<a  {if $DATA[$NODEL1].target != ''}target="{$DATA[$NODEL1].target}"{/if} href="{if $DATA[$NODEL1].ext_link}{$DATA[$NODEL1].ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$DATA[$NODEL1].id}{/if}">&nbsp;&nbsp;{$DATA[$NODEL1].title}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a>
        {if $DATA[$NODEL1].subs > 0}
            <ul>
            <li>&nbsp;<br />&nbsp;</li>
            {foreach from=$NODEARRAY[$NODEL1] item=NL2 name=N2 key=NODEL2}
                <li>
                <a {if $DATA[$NODEL2].target != ''}target="{$DATA[$NODEL2].target}"{/if} href="{if $DATA[$NODEL2].ext_link}{$DATA[$NODEL2].ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$DATA[$NODEL2].id}{/if}">&nbsp;&nbsp;{$DATA[$NODEL2].title}</a>
                    
                </li>
            {/foreach}
            </ul>
        {/if}
    </li>
{/foreach}
</ul>
</div>
<script type="text/javascript">
    initMenu();
</script>
{/if}