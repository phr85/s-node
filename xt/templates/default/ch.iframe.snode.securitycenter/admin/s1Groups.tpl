<form method="POST" name="s1">
{include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{$GROUPS.title}</span>
  </td>
 </tr>
<tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {if $GROUPS.description != ''}
 <tr>
  <td class="view_header" colspan="2">
   <span class="subline">{$GROUPS.description}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {/if}
 </table>
</form>