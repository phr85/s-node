<h1>{'Search'|translate}</h1>
<br />

<!-- Search -->
<form method="post" name="searchengine" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<input class="field" type="text" name="x{$BASEID}_term" value="{if $USEDTERM != ''}{$USEDTERM}{else}{$SEARCHTERM}{/if}" />
{* <!--
<select name="x{$BASEID}_content_type">
<option value="">{"All content types"|translate}</option>
{foreach from=$CONTENT_TYPES item=CONTENT_TYPE}
<option value="{$CONTENT_TYPE.id}">{$CONTENT_TYPE.title}</option>
{/foreach}
</select>
--> *}
<input type="hidden" name="x{$BASEID}_page" value="1" />
<input type="submit" value="{'Start search'|translate}" name="x{$BASEID}_submit_search" />&nbsp;
<br />

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

<!-- Results -->
<table width="100%" cellspacing="0" cellpadding="0" summary="searchresults">
  {foreach from=$RESULTS item=ENTRY}
     <tr>
      <td colspan="2" style="padding-top: 10px; padding-bottom: 10px;">
       {if $ENTRY.image > 0}
       <table cellpadding="0" cellspacing="0" align="left" style="margin: 0px 10px 5px 0px;">
        <tr>
         <td><a href="{$ENTRY.url}">
          {image
               id=$ENTRY.image
               version=1
               title=$ENTRY.description
               alt=$ENTRY.title
               class="left_show"
          }
         </a></td>
        </tr>
       </table>
       {/if}

       <h3><a href="{$ENTRY.url}">{if !$ENTRY.public}<img src="{$XT_IMAGES}/icons/lock.png" alt="" /> {/if}{$ENTRY.title}</a></h3>
       <span style="color: #666666">{"Content type"|translate}: </span>{$CONTENT_TYPES[$ENTRY.content_type].title}<br />
       {if $ENTRY.description != ''}{$ENTRY.description|truncate:230:"...":true}<br />{/if}
       <span style="color: #0B8310;">
       {$ENTRY.url} - {$ENTRY.mod_date|date_format:"%a, %d. %b. %Y - %H:%M:%S"}<br />
       </span>
      </td>
     </tr>
  {/foreach}
 </table>
 {foreach from=$PAGES item=PAGE}
    <a href="javascript:document.forms['searchengine'].x{$BASEID}_page.value={$PAGE};document.forms['searchengine'].submit();">[{if $AKTUALPAGE == $PAGE}<b>{$PAGE}</b>{else}{$PAGE}{/if}]</a>
 {/foreach}
</form>
<br />
{if $smarty.post}
<b>{$ELAPSED_TIME}</b> {"Seconds"|translate}
{/if}