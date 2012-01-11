<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}&module={$ADMINMODULE}" method="POST" name="discounts_edit" onSubmit="window.document.forms['editArticle'].x{$BASEID}_yoffset.value=window.pageYOffset;">
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
{include file="includes/lang_selector_submit.tpl" form="discounts_edit" action="saveDiscounts"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Discount"|translate}:</span><span class="title"> {$DATA.name}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" size="45" name="x{$BASEID}_name" value="{$DATA.name}"></td>
 </tr>

 <tr>
  <td class="left">{"Discount"|translate}</td>
  <td class="right"><input type="text" size="10" name="x{$BASEID}_value" value="{$DATA.value}">
  {if $DATA.in_percent ==1}
  {"in %"|translate}<input type="radio" name="x{$BASEID}_in_percent" value="1" checked>
  {"in"|translate} {$BASECURENCY}<input type="radio" name="x{$BASEID}_in_percent" value="0">
  {else}
  {"in %"|translate}<input type="radio" name="x{$BASEID}_in_percent" value="1">
  {"in"|translate} {$BASECURENCY}<input type="radio" name="x{$BASEID}_in_percent" value="0" checked>
  {/if}

  </td>
 </tr>
 <tr>
  <td class="left">{"give discount at x articles"|translate}</td>
  <td class="right"><input type="text" size="6" name="x{$BASEID}_give_discount_at" value="{$DATA.give_discount_at}"></td>
 </tr>

 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea rows="4" cols="65" id="x{$BASEID}_description" name="x{$BASEID}_description">{$DATA.description}</textarea></td>
 </tr>
 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Articles"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
 {include file="includes/buttons.tpl" data=$EDIT_ADD_ARTICLES_BUTTONS withouthidden="1"}
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="70">{"Image"|translate}</td>
   <td class="table_header" width="60">{"Art_nr"|translate}</td>
   <td class="table_header">{"Title"|translate}</td>
  </tr>
  {foreach from=$ARTICLES item=ENTRY}
  <tr class="{cycle values="row_a,row_b"}">
   <td class="button">
   {actionIcon
     action  = "removeArticleFromDiscount"
     ask     = "Are you sure to remove this article from this discount?"
     icon    = "delete.png"
     form    = "discounts_edit"
     title   = "remove Article from this discount"
     yoffset = 1
     id=$ENTRY.discount_id
     article_id = $ENTRY.article_id
   }

   </td>
   <td class="row">{if $ENTRY.image_id != ''}{image
       id = $ENTRY.image_id
       version = 0
       }{else}&nbsp;{/if}</td>
   <td class="row">{$ENTRY.art_nr|default:"<br />"}</td>
   <td class="row"><b>{$ENTRY.title|default:"?"}</b><br />
   {$ENTRY.lead|default:"?"}
   </td>
  </tr>
 {/foreach}
</table>

 <input type="hidden" name="x{$BASEID}_id" value="{$DATA.id}">
 <input type="hidden" name="x{$BASEID}_article_id" value="">
 <input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}">
{yoffset}
</form>
{include file="includes/editor.tpl"}