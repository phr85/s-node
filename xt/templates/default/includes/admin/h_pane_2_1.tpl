{if $smarty.get.adminmode ==1}
    {include file="includes/header/header_admin.tpl"}
     <table cellspacing="0" cellpadding="0" width="100%" style="height: 100%;">
      <tr>
       <td valign="top" width="{if $lwidth > 1}{$lwidth}{else}50{/if}%">
        <table cellspacing="0" cellpadding="0" width="100%" style="height: 50%;">
         <tr>
          <td valign="top" style="background-color: #FFFFFF; border: 1px solid #002E95;">
          <iframe name="master" src="{$smarty.server.PHP_SELF}?TPL={$m_template}&amp;tabs=1" frameborder="0" style="height: 100%; width: 100%;"></iframe></td>
         </tr>
         <tr>
          <td><img src="/images/spacer.gif" alt="" height="2" /></td>
         </tr>
        </table>
        <table cellspacing="0" cellpadding="0" width="100%" style="height: 50%;">
         <tr>
          <td valign="top" style="background-color: #FFFFFF; border: 1px solid #002E95;">
           <iframe name="slave2" src="{$smarty.server.PHP_SELF}?TPL={$s2_template}&amp;tabs=0&amp;module={$s2_tab}" frameborder="0" style="height: 100%; width: 100%;"></iframe>
          </td>
         </tr>
        </table>
       </td>
       <td width="3"><img src="/images/spacer.gif" alt="" width="3" /></td>
       <td>
        {iframe_paper url="?TPL=%TPL%&amp;tabs=0&amp;module=%MODULE%" name="slave1" template=$s1_template s1_tab=$s1_tab}
       </td>
      </tr>
     </table>
{include file="includes/footer/footer_admin.tpl"}
{else}
    {include file="includes/header/header_admin_empty.tpl"}
        {if $smarty.get.tabs == 1}
        {plugin package=$package module=$module tabs=1}
        {else}
        {plugin package=$package module=$module tabs=0}
        {/if}
    {include file="includes/footer/footer_admin_empty.tpl"}
{/if}