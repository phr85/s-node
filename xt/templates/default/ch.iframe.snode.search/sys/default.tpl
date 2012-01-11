<form method="POST" name="search">
<input type="text" name="x{$BASEID}_term" value="{$SEARCHTERM}" />
<input type="hidden" name="x{$BASEID}_page" value="1" />
<input type="submit" value="submit" name="x{$BASEID}_submit_search">&nbsp;
</form>
<br />
{foreach from=$SIMILAR name=outer item=ENTRY}
<hr style="background-color: #CCCCCC;height: 2px;">
{"You have searched for"|translate}: <b>{$ENTRY.original}</b><br />
used:<b>{$ENTRY.replacement} </b><br />
<b>Alternatives:</b><br />
{foreach from=$ENTRY.alternatives name=inner item=ALT}
- Word: {$ALT.word} ;Distance:{$ALT.distance}<br />
{/foreach}
{/foreach}
<br />
{if $TOTAL > 0}
  {"Total result count"|translate}: <b>{$TOTAL}</b><br />
{else}
  {if $smarty.post}
   <span style="color: red;">{"No results found"|translate}</span>
  {else}
   {"Please input a search query"|translate}...
  {/if}
{/if}
<hr style="background-color: #CCCCCC;height: 2px;">
<table width="100%" cellspacing="0" cellpadding="0">
  {foreach from=$RESULTS item=ENTRY}
     <tr>
      <td><span style="color: #999999;">{$ENTRY.mod_date|date_format:"%d.%m.%Y %H:%M:%S"}</span><br /><b>{$ENTRY.title}</b></td>
      <td nowrap>gewicht: <b>{$ENTRY.weight}</b> treffer: <b>{$ENTRY.count}</b> {$ENTRY.ext_link}</td>
     </tr>
     <tr>
      <td colspan="2">{if $ENTRY.image > 0}{image
               id=$ENTRY.image
               version=0
               title=$ENTRY.description
               alt=$ENTRY.title
               align = left}{/if}
      {$ENTRY.description}</td>
     </tr>
     <tr>
      <td colspan="2">&nbsp;</td>
     </tr>
  {/foreach}
 </table>
 {foreach from=$PAGES item=PAGE}
    <a href="javascript:document.forms['search'].x{$BASEID}_page.value={$PAGE};document.forms['search'].submit();">[{if $AKTUALPAGE == $PAGE}<b>{$PAGE}</b>{else}{$PAGE}{/if}]</a>
  {/foreach}
