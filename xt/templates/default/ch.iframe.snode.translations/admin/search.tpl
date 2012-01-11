{include file="includes/buttons.tpl" data=$BUTTONS}
<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="search">
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="row" colspan="2">
   <span class="title_light">{"Expression"|translate}:</span><span class="title"> <input type="text" name="x{$BASEID}_q" value="{$Q}"/></span>
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_action" value="searchTranslation"/>
<input type="hidden" name="showtabs" value="1" />

</form>

<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
   <td class="table_header" width="150">{"Expression"|translate}</td>
   <td class="table_header" colspan="2" >{"Package"|translate}</td>
  </tr>
  {foreach from=$MATCHES item=MATCH}
      <tr class="row_b">
       <td style="padding-left: 5px;">
       {actionLink
      action="editTranslations"
      form="0"
      target="slave2"
      exp=$MATCH.key
      text=$MATCH.key|replace:$Q:"<b style=\"color:red;\">$Q</b>"
      package_id=$MATCH.package
      package_title=$MATCH.packagename
  }
       </td>
       <td  width="20"><img src="{$XT_IMAGES}icons/box_software.png" alt="" /></td>
       <td  style="padding-left: 0px;"><span title="{$MATCH.packagename}">{
       actionLink
           action="openPackage"
           target="slave1"
           form="0"
           package_id=$MATCH.package
           package_title=$MATCH.packagename
           text=$MATCH.packagename
       }&nbsp;</span></td>
      </tr>
      <tr>
      	<td colspan="3" class="row">[{$MATCH.lang}] {$MATCH.value|replace:$Q:"<b style=\"color:red;\">$Q</b>"}</td>
      </tr>
      <tr>
      	<td colspan="3">&nbsp;</td>
      </tr>
  {/foreach}
 </table>
</table>