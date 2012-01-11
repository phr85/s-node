{include file="includes/header/header_admin_empty.tpl"}
{get_getvalue param="mod" assign="mod"}
{get_getvalue param="cid" assign="cid"}

{if $mod=="tree" OR $mod==""}
{plugin package="ch.iframe.snode.faq" cid=$cid module="categorypicker"}
{/if}
{if $mod=="list"}
{plugin package="ch.iframe.snode.faq" module="list"}
{/if}

{include file="includes/footer/footer_admin_empty.tpl"}