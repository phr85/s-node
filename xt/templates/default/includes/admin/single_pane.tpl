{if $smarty.get.adminmode ==1}
{include file="includes/header/header_admin.tpl"}
 <table cellspacing="0" cellpadding="0" width="100%" style="height: 100%; border: 1px solid #002E95;">
  <tr>
   <td style="background-color: #FFFFFF;" valign="top">
    <iframe name="master" src="{$smarty.server.PHP_SELF}?TPL={$template}" frameborder="0" style="height: 100%; width: 100%;"></iframe>
   </td>
  </tr>
 </table>
{include file="includes/footer/footer_admin.tpl"}
{else}
    {include file="includes/header/header_admin_empty.tpl"}
        {plugin package=$package module=$module tabs=$tabs}
    {include file="includes/footer/footer_admin_empty.tpl"}
{/if}