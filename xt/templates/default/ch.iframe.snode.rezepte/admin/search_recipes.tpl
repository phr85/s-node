<form method="post" name="search">
 <h2>{"Search recipe"|translate}</h2>
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="left">{"Search term"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_term" size="42" value="{$SEARCHTERM}" />&nbsp;{
   actionIcon
       action="performSearchRecipe"
       icon="view.png"
       form="0"
       target="slave1"
       title="Start search"
   }</td>
  </tr>
  <tr>
   <td class="left">{"Language"|translate}</td>
   <td class="right">
    <select name="x{$BASEID}_lang_filter">
    {foreach from=$LANGS key=KEY item=LANG}
    <option value="{$KEY}" {if $ACTIVE_LANG == $KEY}selected{/if}>{$LANG.name|translate}</option>
    {/foreach}
    </select>
   </td>
  </tr>
 </table>
 {if sizeof($RECIPE) > 0}
 <h2>{"Search results"|translate}</h2>
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="45">&nbsp;</td>
   <td class="table_header" width="66">{"image"|translate}</td>
   <td class="table_header">{"Title"|translate}</td>
  </tr>
  {foreach from=$RECIPE item=RECIP}
  <tr class="{cycle values=row_a,row_b}">
   <td class="button">{
   actionIcon
       icon="pencil.png"
       action="editRecipe"
       form="0"
       id=$RECIP.id
       target="slave1"
       title="Edit this recipe entry"
   }</td>
   <td class="row">{if $RECIP.image_id > 0}{image id=$RECIP.image_id version=0"}{else}&nbsp;{/if}</td>
   <td class="row">
   {
   actionLink
       action="editRecipe"
       form="0"
       id=$RECIP.id
       target="slave1"
       text=$RECIP.title|truncate:70:"...":true
   }</td>
  </tr>
  {/foreach}
 </table>
 {else}
 {if $SEARCHTERM != ''}
 <div style="padding: 10px; color: red;">{"No results found"|translate}</div>
 {/if}
 {/if}
 <input type="hidden" name="x{$BASEID}_action" value="performSearchRecipe" />
 <input type="hidden" name="x{$BASEID}_id" />
 <input type="hidden" name="x{$BASEID}_recipe_id" value="" />
 <input type="hidden" name="x{$BASEID}_node_pid" value="" />
 <input type="hidden" name="x{$BASEID}_node_id" value="" />
 <input type="hidden" name="x{$BASEID}_position" value="" />
</form>