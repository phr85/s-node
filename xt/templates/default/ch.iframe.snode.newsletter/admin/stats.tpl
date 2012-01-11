<h2>{"General statistics"|translate}</h2>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
 	 <td class="row" >{"Amount of newsletters"|translate}</td>
 	 <td class="row" width="80">{$xt5300_stats.newsletters}</td>
 </tr>
  <tr>
  	<td class="row" >{"Amount of mails waiting"|translate}</td>
  	<td class="row" width="80">{$xt5300_stats.waiting}</td>
 </tr>
   <tr>
  	<td class="row" >{"Amount of mails sent"|translate}</td>
  	<td class="row" width="80">{$xt5300_stats.sent}</td>
 </tr>
 {foreach item=cat from=$xt5300_stats.categories}
  </tr>
   <tr>
  	<td class="row" >{"Amount of subscribers in"|translate} {$cat.name} ({$cat.id})</td>
  	<td class="row" width="80">{$cat.count}</td>
 </tr>
 {/foreach}
  </tr>
   <tr>
  	<td class="row" >{"Amount of unsubscriptions"|translate}</td>
  	<td class="row" width="80">{$xt5300_stats.unsubscribed}</td>
 </tr>
 </table>
 <h2>{"Newsletter statistics"|translate}</h2>
 <table cellspacing="0" cellpadding="0" width="100%">
	{foreach item=nl from=$xt5300_stats.newsletter}
	<tr>
  		<td class="row" width="180">{$nl.sent_date|date_format:"%A, %B %e, %Y"}<br/>{$nl.title|truncate:20:"...":true}</td>
  		<td class="row">
  		{if $nl.unsubscribed24 != "" OR $nl.sent !=""}{"Amount of unsubscriptions in the last 24 hours"|translate}: {$nl.unsubscribed24|default:"0"}  ({math equation="(x / y)*100" x=$nl.unsubscribed24 y=$nl.sent format="%.2f"} %)<hr/>{/if}
  		{if $nl.waiting != "" OR $nl.sent !=""}{"Amount waiting mails"|translate}: {$nl.waiting|default:"0"} ({math equation="(x / (y + x) )*100" x=$nl.waiting y=$nl.sent format="%.2f"} %)<br/>{/if}
  		{if $nl.waiting != "" OR $nl.sent !=""}{"Amount sent mails"|translate}: {$nl.sent|default:"0"} ({math equation="(y / (y + x))*100" x=$nl.waiting y=$nl.sent format="%.2f"} %)<br/>{/if}
  		{if $nl.views != "" OR $nl.sent !=""}{"Amount views"|translate}: {$nl.views|default:"0"} ({math equation="(x / y)*100" x=$nl.views y=$nl.sent format="%.2f"} %)<hr/>{/if}
  		</td>
 	</tr>
 	{/foreach}
  </table>