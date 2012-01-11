<form method="POST" name="uploadpic" enctype="multipart/form-data">
 {include file="includes/buttons.tpl" data=$BUTTONS}
 <table cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td class="table_header" colspan="2">{"Upload picture"|translate}</td>
  </tr>
  <tr>
   <td class="left">{"Target folder"|translate}</td>
   <td class="right"><input type="hidden" name="x{$BASEID}_folder" value="{$FOLDER_ID}">&raquo; {$FOLDER}</td>
  </tr>
  <tr>
   <td class="left">{"Choose picture"|translate}</td>
   <td class="right"><input type="file" name="picture" size="34"></td>
  </tr>
  <tr>
   <td class="left" style="padding-top: 3px; vertical-align: top;">{"Description"|translate}</td>
   <td class="right"><textarea name="x{$BASEID}_description" cols="50"></textarea></td>
  </tr>
  <tr>
   <td class="left" style="padding-top: 3px; vertical-align: top;">{"Keywords"|translate}</td>
   <td class="right"><textarea name="x{$BASEID}_keywords" cols="50"></textarea></td>
  </tr>
  <tr>
   <td class="left" style="padding-top: 3px; vertical-align: top;">{"Alternative Text"|translate}</td>
   <td class="right"><textarea name="x{$BASEID}_alt" cols="50"></textarea></td>
  </tr>
  <tr>
   <td class="left">{"Supported formats"|translate}</td>
   <td class="right">jpg, gif, png</td>
  </tr>
  <tr>
   <td class="left" style="padding-top: 3px; vertical-align: top;">{"Versions"|translate}</td>
   <td class="right" style="padding: 0px;">
    <table cellpadding="0" cellspacing="3">
    {foreach from=$VERSIONS item=VERSION}
     <tr><td><input type="checkbox" value="{$VERSION.id}" name="x{$BASEID}_version[{$VERSION.name}]" checked></td><td>{$VERSION.name}</td></tr>
    {/foreach}
    </table>
   </td>
  </tr>
 </table>
</form><br>
{if "$PIC" != ""}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header">{"Uploaded picture"|translate} ({"Default version"|translate})</td>
 </tr>
 <tr>
  <td class="row" style="padding: 5px;"><img src="/pictures/{$PIC}" alt="" class="browser"></td>
 </tr>
</table>
{/if}