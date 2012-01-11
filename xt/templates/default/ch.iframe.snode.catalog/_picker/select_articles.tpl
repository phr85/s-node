<form method="POST" name="article" onSubmit="window.document.forms['editArticle'].x{$BASEID}_yoffset.value= window.pageYOffset;">
<h2>{"Last 5 Entries"|translate}:</h2>
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
    <td colspan="4">{include file="includes/lang_selector_simple.tpl" form="article"}</td>
  </tr>
  <tr>
   <td class="table_header" width="30">&nbsp;</td>
   <td class="table_header" width="40">ID</td>
   <td class="table_header" width="80">{"art_nr"|translate}</td>
   <td class="table_header">{"title"|translate}</td>
  </tr>
  {foreach from=$DATA_LAST item=LASTENTRY}
  <tr class="{cycle values="row_a,row_b"}">
   <td class="button">
   <a href="javascript:window.opener.document.forms['{$FORM}'].{$FIELD}.value={$LASTENTRY.id};window.opener.document.forms['{$FORM}'].{$FIELD}_title.value='{$LASTENTRY.title}';
  window.close();"><img src="images/icons/check.png" {"select this article"|alttag}></a>
   </td>
   <td class="row">
   {$LASTENTRY.id}
   </td>
   <td class="row">
   {$LASTENTRY.art_nr|default:"&nbsp;"}
   </td>
   <td class="row">
   {$LASTENTRY.title|default:"?"}
   </td>
  </tr>
 {/foreach}
</table>

<h2>{"Search"|translate}</h2>
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="search_box">
   {"Search for"|translate}&nbsp;
   <input type="text" id="x{$BASEID}_search" name="x{$BASEID}_search" value="{$SEARCH_TERM}" />&nbsp;
   {"in"|translate}&nbsp;
   <select name="x{$BASEID}_search_field">
    <option value="d.title" {if $SEARCH_BY == "d.title"}selected{/if}>{"Title"|translate}</option>
    <option value="a.id" {if $SEARCH_BY == "a.id"}selected{/if}>{"ID"|translate}</option>
    <option value="a.art_nr" {if $SEARCH_BY == "a.art_nr"}selected{/if}>{"Article nr."|translate}</option>
   </select>
   <input type="submit" value="{'Search'|translate}" />
   <img src="{$XT_IMAGES}spacer.gif" onload="document.getElementById('x{$BASEID}_search').focus();" />
  </td>
 </tr>
</table>

<h2>{"List"|translate}</h2>
{include file="includes/charfilter.tpl" form="article"}
<input type="hidden" name="x{$BASEID}_article_id" value="" />
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="30">&nbsp;</td>
  <td class="table_header" width="40">ID</td>
  <td class="table_header" width="80">{"art_nr"|translate}</td>
  <td class="table_header">{"title"|translate}</td>
 </tr>

 {foreach from=$DATA item=ENTRY}
 <tr class="{cycle values="row_a,row_b"}">
  <td class="button"><a href="javascript:window.opener.document.forms['{$FORM}'].{$FIELD}.value={$ENTRY.id};window.opener.document.forms['{$FORM}'].{$FIELD}_title.value='{$ENTRY.title}';
  window.close();"><img src="images/icons/check.png" {"select this article"|alttag}></a>
  </td>
  <td class="row">{$ENTRY.id}</td>
  <td class="row">{$ENTRY.art_nr}</td>
  <td class="row">{$ENTRY.title|default:"?"}</td>
 </tr>
 {/foreach}

</table>
{include file="includes/navigator.tpl" form="article"}
{yoffset}
</form>