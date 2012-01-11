<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="catalog">
{include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}


  <table cellspacing="0" cellpadding="0" width="100%">
       <tr>
        <td class="table_header"><b>{"statistics"|translate}</b></td>
        <td class="table_header" width="80">{"value"|translate}</td>
       </tr>
       <tr>
        <td class="left">{"categories"|translate}</td>
        <td class="right">{$STATS.categories}</td>
       </tr>
       <tr>
        <td class="left">{"products"|translate}</td>
        <td class="right">{$STATS.products}</td>
       </tr>

       {foreach from=$LANGS key=LANG item=LANGNAME}
       <tr>
        <td class="left">{"products_in"|translate} {$LANG}</td>
        <td class="right">{$STATS.$LANG.products}</td>
       </tr>
       {/foreach}

   </table>
{yoffset}
</form>

