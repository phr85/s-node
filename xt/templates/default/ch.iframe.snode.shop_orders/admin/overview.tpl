<form method="POST" name="overview">
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" width="70">{"Order No."|translate}</td>
  <td class="table_header" width="120">{"When?"|translate}</td>
  <td class="table_header">{"Who?"|translate}</td>
  <td class="table_header" width="30">P</td>
  <td class="table_header" width="30">DP</td>
  <td class="table_header" width="30">G</td>
  <td class="table_header" width="80" align="right">{"Total"|translate}</td>
  <td class="table_header" width="80" align="right">{"Discount"|translate}</td>
  <td class="table_header" width="80" align="right">{"Transport"|translate}</td>
  <td class="table_header" width="80" align="right">{"Endprice"|translate}</td>
 </tr>
 {foreach from=$DATA item=ORDER}
 <tr class="{if $ORDER.status == 0}row_yellow{else}{if $ORDER.status == 2}row_red{else}{if $ORDER.status == 1}row_green{else}{if $ORDER.status == 3}row_blue{else}{cycle values=row_a,row_b}{/if}{/if}{/if}{/if}">
  <td class="row">{$ORDER.id}{actionIcon
  icon="book_blue_next.png"
  form=0
  action="show_details"
  target="slave1"
  title="show details"
  id=$ORDER.id}</td>
  <td class="row">{$ORDER.creation_date|date_format:"%d.%m.%Y %H:%I:%S"}</td>
  <td class="row">{$ORDER.lastName} {$ORDER.firstName} ({$ORDER.user_id})</td>
  <td class="row">{$ORDER.products_count}&nbsp;</td>
  <td class="row">{$ORDER.products}&nbsp;</td>
  <td class="row">{if $ORDER.gifts > 0}{$ORDER.gifts}{else}<span style="color: #BBBBBB;">0</span>{/if}&nbsp;</td>
  <td class="row" width="80" align="right">{$ORDER.totalprice|round5} {$BASECURRENCY}</td>
  <td class="row" width="80" align="right">{if $ORDER.discount > 0}{$ORDER.discount|round5} {$BASECURRENCY}{else}<span style="color: #BBBBBB;">{"No discount"|translate}</span>{/if}</td>
  <td class="row" width="80" align="right">{$ORDER.transport|round5} {$BASECURRENCY}</td>
  <td class="row" width="80" align="right"><b>{$ORDER.endprice|round5}</b> {$BASECURRENCY}</td>
 </tr>
 {/foreach}
</table>
{include file="includes/navigator.tpl" form="overview"}
</form>