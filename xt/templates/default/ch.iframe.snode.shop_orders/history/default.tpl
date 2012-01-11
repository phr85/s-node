<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="table_header" width="70">{"Order No."|translate}</td>
  <td class="table_header" width="120">{"When?"|translate}</td>
  <td class="table_header" width="30">{"Stueckzahl"|translate}</td>
  <td class="table_header" width="30">{"Artikel"|translate}</td>
  <td class="table_header" width="80" align="right">{"Total"|translate}</td>
  <td class="table_header" width="80" align="right">{"Transport"|translate}</td>
  <td class="table_header" width="80" align="right">{"Endprice"|translate}</td>
  <td class="table_header" width="80" align="right">&nbsp;</td>
 </tr>
 {foreach from=$DATA item=ORDER}
 <tr class="{if $ORDER.status == 0}row_yellow{else}{if $ORDER.status == 2}row_red{else}{if $ORDER.status == 1}row_green{else}{if $ORDER.status == 3}row_blue{else}{cycle values=row_a,row_b}{/if}{/if}{/if}{/if}">
  <td class="row">{$ORDER.id}</td>
  <td class="row"><a href="/index.php?TPL=10094&amp;x{$BASEID}_ordrnr={$ORDER.id}">{$ORDER.creation_date|date_format:"%d.%m.%Y %H:%I:%S"}</a></td>
  <td class="row">{$ORDER.products_count}&nbsp;</td>
  <td class="row">{$ORDER.products}&nbsp;</td>
  <td class="row" width="80" align="right">{$ORDER.totalprice|round5} {$BASECURRENCY}</td>
  <td class="row" width="80" align="right">{$ORDER.transport|round5} {$BASECURRENCY}</td>
  <td class="row" width="80" align="right"><b>{$ORDER.endprice|round5}</b> {$BASECURRENCY}</td>
  <td class="row" width="80" align="right"> <a href="/index.php?TPL=10094&amp;x{$BASEID}_ordrnr={$ORDER.id}">{"details"|translate}</a></td>

 </tr>
 {/foreach}
</table>