<form method="post" action="{$smarty.server.PHP_SELF}?TPL={$TPL}" name="list" onSubmit="window.document.forms['list'].x{$BASEID}_yoffset.value=window.pageYOffset;">
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Profile"|translate}:</span><span class="title"> {$PACKAGE_TITLE}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
   <td class="table_header" colspan="2" onclick="document.forms['list'].x{$BASEID}_order_by_dir.value='{if $ORDER_BY_DIR == 'ASC'}DESC{else}ASC{/if}';document.forms['list'].submit();">{"Title"|translate} <img src="{$XT_IMAGES}admin/header_arrow_{if $ORDER_BY_DIR == 'DESC'}down{else}up{/if}.gif" alt=""/></td>
  </tr>
 {foreach from=$EXPRESSIONS item=EXP}
 <tr class="{cycle values=row_a,row_b}">
  <td class="row">{
  actionLink
      action="editTranslations"
      form="0"
      target="slave2"
      exp=$EXP
      text=$EXP
  }</td>
  <td class="button" width="20">{
  actionIcon
      action="deleteExpression"
      form="list"
      icon="delete.png"
      ask="Are you sure, you want to delete this expression?"
      title="Delete expression"
      yoffset=1
      exp=$EXP
  }</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_package_id" />
<input type="hidden" name="x{$BASEID}_package_title" />
<input type="hidden" name="x{$BASEID}_exp" />
<input type="hidden" name="module" value="list" />
<input type="hidden" name="x{$BASEID}_order_by_dir" />
{yoffset}
</form>