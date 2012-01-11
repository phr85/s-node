<form method="POST" name="overview">
 {include file="includes/buttons.tpl" data=$OVERVIEW_BUTTONS}
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Statistics"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr><td class="stats_link">
 &raquo; <a href="#years">{"Summary"|translate}</a><br />
 &raquo; <a href="#monthly_history">{"Monthly history"|translate}</a><br />
 &raquo; <a href="#days_in_month">{"Days in month"|translate}</a><br />
 &raquo; <a href="#hosts">Top 20 {"Hosts"|translate}</a><br />
 &raquo; <a href="#pages">Top 20 {"Pages"|translate}</a><br />
 &raquo; <a href="#referers">Top 20 {"Referers"|translate}</a><br />
 &raquo; <a href="#browsers">Top 20 {"Browsers"|translate}</a><br />
 </td></tr>
 </table>
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Summary"|translate}<a name="years">&nbsp;</a></span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {foreach from=$YEARS item=YEAR}
 <tr>
  <td class="view_right">{$YEAR.year} - {'Views'|translate}: <span class="stats_big" style="color: #979823;">{$YEAR.views}</span> -
  {'Visitors'|translate}: <span class="stats_big" style="color: #1BC006;">{$YEAR.visitors}</span> - {'Unique Visitors'|translate}:
  <span class="stats_big" style="color: #E0927D;">{$YEAR.unique_visitors}</span></td>
 </tr>
 {/foreach}
 </table>
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="4">
   <span class="title">{"Monthly history"|translate}<a name="monthly_history">&nbsp;</a></span><a href="#top">top</a>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
 <table cellspacing="0" cellpadding="0" style="margin: 15px;">
  <tr>
  {foreach from=$MONTHS item=MONTH}
  <td valign="bottom" style="padding-right: 2px;"><img src="{$XT_IMAGES}admin/stats/yellow.gif" alt="" height="{math equation='100/max*views+2' max=$MONTH_TOTAL.max views=$MONTH.views}" width="6" /></td>
  <td valign="bottom" style="padding-right: 2px;"><img src="{$XT_IMAGES}admin/stats/green.gif" alt="" height="{math equation='100/max*visitors+2' max=$MONTH_TOTAL.max visitors=$MONTH.visitors}" width="6" /></td>
  <td valign="bottom" style="padding-right: 10px;"><img src="{$XT_IMAGES}admin/stats/red.gif" alt="" height="{math equation='100/max*unique_visitors+2' max=$MONTH_TOTAL.max unique_visitors=$MONTH.unique_visitors}" width="6" /></td>
  {/foreach}
  </tr>
  <tr>
  {foreach from=$MONTHS item=MONTH}
  <td colspan="3" class="stats_small" {if $DATE.mon == $MONTH.month}style="font-weight: bold;"{/if}>{$MONTH_LABELS[$MONTH.month]|translate|truncate:4:'.':true}</td>
  {/foreach}
  </tr>
 </table>
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_stats_header" width="80">{"Month"|translate}</td>
  <td class="table_stats_header" width="150">{"Views"|translate}</td>
  <td class="table_stats_header" width="150">{"Visitors"|translate}</td>
  <td class="table_stats_header">{"Unique Visitors"|translate}</td>
 </tr>
 {foreach from=$MONTHS item=MONTH}
 <tr {if $DATE.mon == $MONTH.month}style="font-weight: bold;"{/if}>
  <td class="stats_light">{$MONTH_LABELS[$MONTH.month]|translate} {$MONTH.year}</td>
  <td class="stats_yellow">{$MONTH.views}</td>
  <td class="stats_green">{$MONTH.visitors}</td>
  <td class="stats_red">{$MONTH.unique_visitors}</td>
 </tr>
 {/foreach}
 <tr>
  <td class="stats_total">{"Total"|translate}</td>
  <td class="stats_total">{$MONTH_TOTAL.views}</td>
  <td class="stats_total">{$MONTH_TOTAL.visitors}</td>
  <td class="stats_total">{$MONTH_TOTAL.unique_visitors}</td>
 </tr>
 </table>
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="4">
   <span class="title">{"Days in month"|translate}<a name="days_in_month">&nbsp;</a></span><a href="#top">top</a>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
 <table cellspacing="0" cellpadding="0" style="margin: 15px;">
  <tr>
  {foreach from=$DAYS item=DAY}
  <td valign="bottom" style="padding-right: 1px;"><img src="{$XT_IMAGES}admin/stats/yellow.gif" alt="{'Views'|translate}" title="{$DAY.views} {'Views'|translate}" height="{math equation='100/max*views+2' max=$DAY_TOTAL.max views=$DAY.views}" width="4" /></td>
  <td valign="bottom" style="padding-right: 1px;"><img src="{$XT_IMAGES}admin/stats/green.gif" alt="{'Visitors'|translate}: {$DAY.visitors}" title="{'Visitors'|translate}: {$DAY.visitors}" height="{math equation='100/max*visitors+2' max=$DAY_TOTAL.max visitors=$DAY.visitors}" width="4" /></td>
  <td valign="bottom" style="padding-right: 5px;"><img src="{$XT_IMAGES}admin/stats/red.gif" alt="{'Unique Visitors'|translate}: {$DAY.unique_visitors}" title="{'Unique Visitors'|translate}: {$DAY.unique_visitors}" height="{math equation='100/max*unique_visitors+2' max=$DAY_TOTAL.max unique_visitors=$DAY.unique_visitors}" width="4" /></td>
  {/foreach}
  </tr>
  <tr>
  {foreach from=$DAYS item=DAY}
  <td colspan="3" class="stats_small" {if $DATE.mday == $DAY.day}style="font-weight: bold;"{/if}>{$DAY.day}<br />{$MONTH_LABELS[$DAY.month]|translate|truncate:4:'.':true}</td>
  {/foreach}
  </tr>
 </table>
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_stats_header" width="80">{"Day"|translate}</td>
  <td class="table_stats_header" width="150">{"Views"|translate}</td>
  <td class="table_stats_header" width="150">{"Visitors"|translate}</td>
  <td class="table_stats_header">{"Unique Visitors"|translate}</td>
 </tr>
 {foreach from=$DAYS item=DAY}
 <tr {if $DATE.mday == $DAY.day}style="font-weight: bold;"{/if}>
  <td class="stats_light">{$DAY.day}.{$DAY.month}.{$DAY.year}</td>
  <td class="stats_yellow">{$DAY.views}</td>
  <td class="stats_green">{$DAY.visitors}</td>
  <td class="stats_red">{$DAY.unique_visitors}</td>
 </tr>
 {/foreach}
 <tr>
  <td class="stats_total">{"Total"|translate}</td>
  <td class="stats_total">{$DAY_TOTAL.views}</td>
  <td class="stats_total">{$DAY_TOTAL.visitors}</td>
  <td class="stats_total">{$DAY_TOTAL.unique_visitors}</td>
 </tr>
 </table>
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="4">
   <span class="title">Top 20 {"Hosts"|translate}<a name="hosts">&nbsp;</a></span><a href="#top">top</a>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_stats_header" width="260">{"Host"|translate}</td>
  <td class="table_stats_header" width="150">{"Views"|translate}</td>
  <td class="table_stats_header">{"Last access"|translate}</td>
 </tr>
 {foreach from=$HOSTS item=HOST}
 <tr {if $DATE.mday == $DAY.day}style="font-weight: bold;"{/if}>
  <td class="stats_light">{$HOST.host}</td>
  <td class="stats_yellow">{$HOST.views}</td>
  <td class="stats_light">{$HOST.last_access|date_format:"%d.%m.%Y %H:%I:%S"}</td>
 </tr>
 {/foreach}
 <tr>
  <td class="stats_total">{"Total"|translate}</td>
  <td class="stats_total" colspan="2">{$HOST_TOTAL.views}</td>
 </tr>
 </table>
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="4">
   <span class="title">Top 20 {"Pages"|translate}<a name="pages">&nbsp;</a></span><a href="#top">top</a>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_stats_header" width="260">{"Page"|translate}</td>
  <td class="table_stats_header" width="150">{"Views"|translate}</td>
  <td class="table_stats_header" width="150">{"Visitors"|translate}</td>
  <td class="table_stats_header">{"Unique Visitors"|translate}</td>
 </tr>
 {foreach from=$PAGES item=PAGE}
 <tr {if $DATE.mday == $DAY.day}style="font-weight: bold;"{/if}>
  <td class="stats_light"><a href="{$smarty.server.PHP_SELF}?TPL={$PAGE.tpl}" target="_blank">{$PAGE.title}</a> ({$PAGE.tpl})</td>
  <td class="stats_yellow">{$PAGE.views}</td>
  <td class="stats_green">{$PAGE.visitors}</td>
  <td class="stats_red">{$PAGE.unique_visitors}</td>
 </tr>
 {/foreach}
 <tr>
  <td class="stats_total">{"Total"|translate}</td>
  <td class="stats_total">{$PAGE_TOTAL.views}</td>
  <td class="stats_total">{$PAGE_TOTAL.visitors}</td>
  <td class="stats_total">{$PAGE_TOTAL.unique_visitors}</td>
 </tr>
 </table>
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="4">
   <span class="title">Top 20 {"Referers"|translate}<a name="referers">&nbsp;</a></span><a href="#top">top</a>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>

 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_stats_header" width="260">{"Referer"|translate}</td>
  <td class="table_stats_header" width="150">{"Views"|translate}</td>
  <td class="table_stats_header" width="150">{"Visitors"|translate}</td>
  <td class="table_stats_header">{"Unique Visitors"|translate}</td>
 </tr>
 {foreach from=$REFERERS item=REFERER}
 <tr>
  <td class="stats_light"><a href="{$REFERER.referer}" target="_blank">{$REFERER.referer|truncate:47:"...":true}</a></td>
  <td class="stats_yellow">{$REFERER.views}</td>
  <td class="stats_green">{$REFERER.visitors}</td>
  <td class="stats_red">{$REFERER.unique_visitors}</td>
 </tr>
 {/foreach}
 <tr>
  <td class="stats_total">{"Total"|translate}</td>
  <td class="stats_total">{$REFERER_TOTAL.views}</td>
  <td class="stats_total">{$REFERER_TOTAL.visitors}</td>
  <td class="stats_total">{$REFERER_TOTAL.unique_visitors}</td>
 </tr>
 </table>

 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="4">
   <span class="title">Top 20 {"Browsers"|translate}<a name="browsers">&nbsp;</a></span><a href="#top">top</a>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 </table>
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_stats_header" style="padding-right: 0px;" width="20">&nbsp;</td>
  <td class="table_stats_header" style="padding-left: 0px;" width="200">{"Browser"|translate}</td>
  <td class="table_stats_header">{"Views"|translate}</td>
 </tr>
 {foreach from=$AGENTS item=AGENT}
 <tr>
  <td class="stats_light" style="padding-right: 0px;">{$AGENT.agent|browsericon}</td>
  <td class="stats_light" style="padding-left: 0px;{if $AGENT.agent == 'Firefox' || $AGENT.agent == 'Internet Explorer' || $AGENT.agent == 'Mozilla'}font-weight: bold;{/if}">{$AGENT.agent}</td>
  <td class="stats_yellow">{math equation="100/total_views*views" total_views=$AGENT_TOTAL.views views=$AGENT.views format="%.2f"}% ({$AGENT.views})</td>
 </tr>
 {/foreach}
 <tr>
  <td class="stats_total" colspan="2">{"Total"|translate}</td>
  <td class="stats_total">{$AGENT_TOTAL.views}</td>
 </tr>
 </table>
</form>