<form method="POST" name="overview">
{include file="ch.iframe.snode.installer/admin/hiddenValues.tpl"}

<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{"Installed Packages"|translate}</span>
  </td>
 </tr>
<tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="50">{"ID"|translate}</td>
   <td class="table_header" colspan="2">{"Name"|translate}</td>
   <td class="table_header" width="40">{"version"|translate}</td>
   <td class="table_header" width="100">{"Provider"|translate}</td>
  </tr>
  {foreach from=$INSTALLED item=PACKAGE}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="row">{$PACKAGE.id}</td>
       <td class="button" width="20"><img src="{$XT_IMAGES}icons/box_software.png" alt="" /></td>
       <td class="row" style="padding-left: 0px;"><span title="{$PACKAGE.package}">{$PACKAGE.title}&nbsp;</span></td>
       <td class="row">{$PACKAGE.version}&nbsp;</td>
       <td class="row">{$PACKAGE.provider}&nbsp;</td>
      </tr>
  {/foreach}
 </table>
 <br />

</form>