{if sizeof($x240_tree.data) > 0}
{get_param param="follow" assign="follow"}
{if $follow==1 && $x240_tree.data.0.level > 0}
<div style="padding-left:10px;">
<a {if $NAV.target != ''}target="{$NAV.target}"{/if}
href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_node={$x240_tree.data.0.pid}">..</a>
</div>
{/if}
{foreach from=$x240_tree.data item=NAV name=N}
<div style="padding-left:{$NAV.level*10}px; {if $NAV.itw}font-weight: bold;{/if}">
<a {if $NAV.target != ''}target="{$NAV.target}"{/if}
href="{if $NAV.ext_link}{$NAV.ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_node={$NAV.id}{/if}">{$NAV.title}</a>
</div>
{/foreach}
{/if}