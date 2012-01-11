<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Statistics"|translate}</td>
 </tr>
 <tr>
  <td class="left">{"Day count"|translate}</td>
  <td class="right">{$DAYCOUNT}</td>
 </tr>
 <tr>
  <td class="left">{"Total unique visitors count"|translate}</td>
  <td class="right">{$VISITORCOUNT}</td>
 </tr>
 <tr>
  <td class="left">{"Total view count"|translate}</td>
  <td class="right">{$VIEWSCOUNT}</td>
 </tr>
 <tr>
  <td class="left">{"Different pages"|translate}</td>
  <td class="right">{$PAGESCOUNT}</td>
 </tr>
 <tr>
  <td class="left">{"Different browsers"|translate}</td>
  <td class="right">{$AGENTSCOUNT}</td>
 </tr>
 <tr>
  <td class="left">{"Different hosts"|translate}</td>
  <td class="right">{$HOSTSCOUNT}</td>
 </tr>
 <tr>
  <td class="left">{"Different known users"|translate}</td>
  <td class="right">{$USERSCOUNT}</td>
 </tr>
 <tr>
  <td class="left">{"Avg. visitors count per day"|translate}</td>
  <td class="right">{$AVGVISITORSPERDAY}</td>
 </tr>
 <tr>
  <td class="left">{"Avg. views count per day"|translate}</td>
  <td class="right">{$AVGVIEWSPERDAY}</td>
 </tr>
</table>
<br />
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Page views"|translate}</td>
 </tr>
 {foreach from=$PAGES key=TPL item=PAGECOUNT}
  <tr>
   <td class="left">{$PAGEDATA[$TPL].title} ({$TPL})</td>
   <td class="right"><img src="{$XT_IMAGES}admin/stats/orange.gif" alt="" width="{$PAGECOUNT*$PERUNIT|ceil}" height="8" />&nbsp;&nbsp;{$PAGECOUNT}</td>
  </tr>
 {/foreach}
</table>
<br />
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Visitors (per Day)"|translate}</td>
 </tr>
 {foreach from=$DAYVISITORS key=DAY item=DAYVISITORCOUNT}
  <tr>
   <td class="left">{$DAY}</td>
   <td class="right"><img src="{$XT_IMAGES}admin/stats/green.gif" alt="" width="{$DAYVISITORCOUNT*$PERDAYUNIT|ceil}" height="8" />&nbsp;&nbsp;{$DAYVISITORCOUNT}</td>
  </tr>
 {/foreach}
</table>
<br />
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Views (per Day)"|translate}</td>
 </tr>
 {foreach from=$DAYVIEWS key=DAY item=DAYVIEWSCOUNT}
  <tr>
   <td class="left">{$DAY}</td>
   <td class="right"><img src="{$XT_IMAGES}admin/stats/orange.gif" alt="" width="{$DAYVIEWSCOUNT*$PERDAYVIEWSUNIT|ceil}" height="8" />&nbsp;&nbsp;{$DAYVIEWSCOUNT}</td>
  </tr>
 {/foreach}
</table>
