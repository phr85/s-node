<form method="post" name="searchengine" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div class="forum">
<table cellpadding="0" cellspacing="0" width="100%">
<tr>
 <td colspan="2" class="header"><b>Suche</b><br />{"Search & find categories, forums, topics and entries"|translate}:</td>
</tr>
</table>

<!-- Similar words -->
{foreach from=$SIMILAR name=outer item=ENTRY}
<br />
{translate_replace string="There were no results found for <b>%1</b>." t1=$ENTRY.original} {translate_replace string="The best possible alternative term <b>%1</b> was used for the following search results." t1=$ENTRY.replacement}<br /><br />
<b>{"Alternatives"|translate}:</b><br /><br />
{foreach from=$ENTRY.alternatives name=inner item=ALT}
- <a href="javascript:document.forms['searchengine'].x{$BASEID}_term.value='{$ALT.word}';document.forms['searchengine'].submit();">{$ALT.word}</a> <span style="color: #999999;">({$ALT.distance})</span><br />
{/foreach}
{/foreach}
<br />

<!-- Search info -->
{if $TOTAL > 0}
  <h2><span style="color: black;">{$TOTAL}</span> {if $TOTAL == 1}{"result found for word"|translate}{else}{"results found for word"|translate}{/if} <span style="color: black;">{if $ENTRY.replacement != ''}{$ENTRY.replacement}{else}{$SEARCHTERM}{/if}</span></h2>
{else}
  {if $smarty.post}
   <span style="color: red;">{"No results found"|translate}</span>
  {else}
   {"Please input a search query"|translate}...
  {/if}
{/if}

<table cellpadding="0" cellspacing="0" width="100%" class="categorylist">
<tr>
 <td class="entry">
  <input type="text" name="x{$BASEID}_term" style="width: 380px;" value="{$SEARCHTERM}" />
  
  <select name="x{$BASEID}_content_type">
   <option value="">{"Search all"|translate}</option>
   <option value="3602" {if $CONTENT_TYPE == "3602"}selected{/if}>{"Search only topics"|translate}</option>
   <option value="3601" {if $CONTENT_TYPE == "3601"}selected{/if}>{"Search only entries"|translate}</option>
  </select>
  <input type="submit" value="{"Search"|translate}"/>
 </td>
</tr>
</table>
</div>
{if sizeof($RESULTS) > 0}

{foreach from=$RESULTS item=RESULT}
<div><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_{if $RESULT.content_type == 3601}entry{/if}{if $RESULT.content_type == 3602}topic{/if}_id={$RESULT.content_id}"><b>{$RESULT.title}</b></a>
<div>{$RESULT.description}
 <span style="color: #666666;">( {$RESULT.mod_date|date_format}
 {"Type"|translate}: {if $RESULT.content_type == 3602}{"Topic"|translate}{/if}
 {if $RESULT.content_type == 3601}{"Entry"|translate}{/if} )</span>
 </div>
</div>
{/foreach}
{/if}
{$ELAPSED_TIME}
</form>
<br />