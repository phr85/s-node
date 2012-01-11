<form method="post" name="overview">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header">{"Title"|translate}</td>
  <td class="table_header">{"Price"|translate}</td>
 </tr>
 {foreach from=$DATA item=ITEM}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button">{
  actionIcon
      action="activateLicense"
      form="overview"
      icon="inactive.png"
      perm="changestatus"
      title="Activate this entry"
  }</td>
  <td colspan="2">
   <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
      <td class="button" style="padding-right: 0px; padding-left: {$ITEM.level*20-32}px; width: 1px;">{if $ITEM.itw}<img src="{$XT_IMAGES}icons/minus.gif" alt="" />{else}<img src="{$XT_IMAGES}icons/plus.gif" alt="" />{/if}</td>
      <td class="button" style="padding-right: 0px;width: 16px">
       {if $ITEM.itw}<img src="{$XT_IMAGES}icons/box.png" alt="" />{else}<img src="{$XT_IMAGES}icons/box_closed.png" alt="" />{/if}<br />
      </td>
      <td class="row">{
      actionLink
          action=""
          product_id=$ITEM.product_id
          text=$ITEM.product_title
          form="overview"
      }</td>
     </tr>
    </table>
   </td>
 </tr>
 {if $ITEM.itw}
 {foreach from=$LICENSES item=LICENSE}
 <tr>
  <td class="button">{
  actionIcon
      action="activateLicense"
      form="overview"
      icon="inactive.png"
      perm="changestatus"
      title="Activate this entry"
  }</td>
  <td class="row" style="padding-left: 40px;">{$LICENSE.title}</td>
  <td class="row" align="right">{$LICENSE.price|round5}&nbsp;</td>
 </tr>
 {/foreach}
 {/if}
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_product_id" value="{$PRODUCT_ID}" />
</form>