{include file="includes/header/header_admin_empty.tpl"}

<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="toolbar" style="padding: 5px; height: 1px;">
  {plugin package="ch.iframe.snode.filemanager" module="upload"}
  </td>
 </tr>
</table>

{plugin package="ch.iframe.snode.filemanager" module="setvalues"}
    <table cellspacing="0" cellpadding="0" width="100%" style="height: 100%;">
      <tr>
       <td style="background-color: #DDDDDD; border: 1px solid #002E95;" valign="top" width="280">
        <iframe name="master" src="{$smarty.server.PHP_SELF}?TPL=136" frameborder="0" style="height: 465px; width: 100%;"></iframe>
       </td>
       <td width="3">
       .<br />.<br />.
       </td>
       <td style="background-color: #FFFFFF; border: 1px solid #002E95;" valign="top">
        <iframe name="slave1" src="{$smarty.server.PHP_SELF}?TPL=137" frameborder="0" style="height: 465px; width: 100%;"></iframe>
       </td>
      </tr>
     </table>
{include file="includes/footer/footer_admin_empty.tpl"}
