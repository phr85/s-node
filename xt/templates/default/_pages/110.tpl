{if $smarty.get.adminmode == 1}
{include file="includes/header/header_admin_empty.tpl"}
{plugin package="ch.iframe.snode.nodepermissions" module="setvalues"}
    <table cellspacing="0" cellpadding="0" width="100%" style="height: 100%;">
      <tr>
       <td style="background-color: #FFFFFF; border: 1px solid #002E95;" valign="top" width="45%">
        <iframe name="master" src="{$smarty.server.PHP_SELF}?TPL=110&module=mRole" frameborder="0" style="height: 440px; width: 100%;"></iframe>
       </td>
       <td width="3">
       .<br />.<br />.
       </td>
       <td style="background-color: #FFFFFF; border: 1px solid #002E95;" valign="top" width="55%">
        <iframe name="slave1" src="{$smarty.server.PHP_SELF}?TPL=110&tabs=0&module=slave1" frameborder="0" style="height: 440px; width: 100%;"></iframe>
       </td>
      </tr>
     </table>
{include file="includes/footer/footer_admin_empty.tpl"}
{else}

{include file="includes/header/header_admin_empty.tpl"}
    {if $smarty.get.tabs == 1}
    {plugin package="ch.iframe.snode.nodepermissions" module="admin" tabs=1}
    {else}
    {plugin package="ch.iframe.snode.nodepermissions" module="admin" tabs=0}
    {/if}
{include file="includes/footer/footer_admin_empty.tpl"}
{/if}