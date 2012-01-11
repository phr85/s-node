<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="editArticle" onSubmit="window.document.forms['editArticle'].x{$BASEID}_yoffset.value= window.pageYOffset;">
<a name="top" />
<input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}" />
<input type="hidden" name="x{$BASEID}_active" value="{$DATA.lang_active}" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
{include file="includes/lang_selector_submit.tpl" form="editArticle" action="saveArticle"}
<!-- {inline_navigator data=$INLINE_NAVIGATION} -->
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light"> {"Product"|translate}: </span><span class="title"> {$DATA.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$EDIT_ARTICLES_BUTTONS}

<table cellspacing="0" cellpadding="0" width="100%">
{include file="ch.iframe.snode.catalog/admin/edit_articles/basics.tpl"}
{include file="includes/widgets/relations.tpl" cid=$DATA.id ctitle=$DATA.title}
{if $DISPLAY.variables == 1}{include file="ch.iframe.snode.catalog/admin/edit_articles/variables.tpl"}{/if}
{if $DISPLAY.properties == 1}{include file="ch.iframe.snode.catalog/admin/edit_articles/properties.tpl"}{/if}
{include file="ch.iframe.snode.catalog/admin/edit_articles/images.tpl"}

</table>
{if $DISPLAY.shop == 1}
 {$EA_BASIC_DATAROWS}
{/if}

{if $DISPLAY.sets == 1}
{include file="ch.iframe.snode.catalog/admin/edit_articles/set.tpl"}
{/if}
{if $DISPLAY.relations == 1}
{include file="ch.iframe.snode.catalog/admin/edit_articles/related.tpl"}
{/if}
{if sizeof($LANGS) > 1}
<h2>{"Languages"|translate}</h2>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Copy into"|translate}</td>
  <td class="right">
   <select name="x{$BASEID}_copyToLang">
   {foreach from=$LANGS key=KEY item=LANG}
    {if $KEY != $ACTIVE_LANG}
    <option value="{$KEY}">{$LANG.name|translate}</option>
    {/if}
   {/foreach}
   </select>
   {actionIcon
       action="copyToLang"
       form="editArticle"
       icon="explorer/arrow_right_green.png"
       title="Copy to this language"
   }
  </td>
 </tr>
</table>
{/if}

{foreach from=$EDIT_ARTICLE_DATAROWS item=ENTRY}
  {if $ENTRY.label == "head"}
   <br />
   <table cellspacing="0" cellpadding="0" width="100%">
    <tr>
      <td class="table_header" colspan="2">{$ENTRY.input|translate}</td>
    </tr>
  {elseif $ENTRY.label == "end"}
   </table>
  {else}
    <tr>
      <td class="left">{$ENTRY.label|translate}</td>
      <td class="right">{$ENTRY.input}</td>
    </tr>
  {/if}
{/foreach}

<input type="hidden" name="x{$BASEID}_id" value="{$DATA.id}" />
{if $FOCUS.segment != ''}
<img src="{$XT_IMAGES}spacer.gif" onLoad="anchor('{$FOCUS.segment}');" width="1"" />
{/if}
{if $FOCUS.field != ''}
<img src="{$XT_IMAGES}spacer.gif" onLoad="document.forms['editArticle'].{$FOCUS.field}.focus();" width="1" />
{/if}
{if $PICKER > 0}
<img src="{$XT_IMAGES}spacer.gif" onLoad="popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_PICKER_TPL}&x{$IMAGE_PICKER_BASE_ID}_field=x{$BASEID}_image_{$PICKER}&x{$IMAGE_PICKER_BASE_ID}_form=editArticle',770,470,'picker');" width="1" />
{/if}
{yoffset}
</form>
{include file="includes/editor.tpl"}