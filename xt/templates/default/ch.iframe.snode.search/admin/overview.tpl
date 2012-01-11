<form method="POST" name="searchadmin">
{include file="ch.iframe.snode.search/admin/hiddenValues.tpl"}
{include file="includes/lang_selector_simple.tpl" form="searchadmin"}
 <table cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td class="view_header">
    <span class="title">{"Not found keywords"|translate}</span>
   </td>
  </tr>
  <tr>
   <td class="view_separator"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
  </tr>
  <tr>
   <td valign="top">
    <table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td class="table_header">&nbsp;</td>
       <td class="table_header" width="60">{"Date"|translate}</td>
       <td class="table_header" width="40">{"Counts"|translate}</td>
       <td class="table_header" width="50">{"Profile"|translate}</td>
      </tr>
     {foreach from=$NOTFOUNDS item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="row">
       {$ENTRY.kw}
       </td>
       <td class="row">
       {$ENTRY.sd|date_format:"%d.%m.%Y"}
       </td>
       <td class="row">
       {$ENTRY.kwcount}
       </td>
       <td class="row">
       {$ENTRY.profile}
       </td>
      </tr>
     {/foreach}
    </table>
   </td>
  </tr>
  <tr>
   <td class="view_header">
    <span class="title">{"Most searched keywords"|translate}</span>
   </td>
  </tr>
  <tr>
   <td class="view_separator"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
  </tr>
  <tr>
   <td valign="top">
    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
       <td class="table_header">&nbsp;</td>
       <td class="table_header" width="60">{"Date"|translate}</td>
       <td class="table_header" width="40">{"Counts"|translate}</td>
       <td class="table_header" width="50">{"Profile"|translate}</td>
      </tr>
     {foreach from=$MOSTSEARCHED item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="row">
       {$ENTRY.kw}
       </td>
       <td class="row">
       {$ENTRY.sd|date_format:"%d.%m.%Y"}
       </td>
       <td class="row">
       {$ENTRY.kwcount}
       </td>
       <td class="row">
       {$ENTRY.profile}
       </td>
      </tr>
     {/foreach}
    </table>
   </td>
  </tr>
  <tr>
   <td class="view_header">
    <span class="title">{"Statistics"|translate}</span>
   </td>
  </tr>
  <tr>
   <td class="view_separator"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
  </tr>
  <tr>
   <td valign="top">
   <table cellspacing="0" cellpadding="0" width="100%">
       <tr>
        <td class="table_header">&nbsp;</td>
        <td class="table_header" width="80">{"Value"|translate}</td>
       </tr>
       <tr>
        <td class="left">{"Different users"|translate}</td>
        <td class="right">{$STATS.users}</td>
       </tr>
       <tr>
        <td class="left">{"Keywords"|translate}</td>
        <td class="right">{$STATS.keywords}</td>
       </tr>
       <tr>
        <td class="left">{"Keywords found"|translate}</td>
        <td class="right">{$STATS.keywords_found}</td>
       </tr>
       <tr>
        <td class="left">{"Keywords not found"|translate}</td>
        <td class="right">{$STATS.keywords_not_found}</td>
       </tr>
       <tr>
        <td class="left">{"Indexed content"|translate}</td>
        <td class="right">{$STATS.indexed}</td>
       </tr>
       <tr>
        <td class="left">{"Keywords assigned"|translate}</td>
        <td class="right">({$STATS.keywords_diff_assigned}) {$STATS.keywords_assigned}</td>
       </tr>
   </table>
   </td>
  </tr>
  <tr>
   <td class="view_header">
    <span class="title">{"Last searched keywords"|translate}</span>
   </td>
  </tr>
  <tr>
   <td class="view_separator"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
  </tr>
  <tr>
   <td valign="top">
    <table cellspacing="0" cellpadding="0" width="100%">
      <tr>
       <td class="table_header">&nbsp;</td>
       <td class="table_header" width="60">{"Date"|translate}</td>
       <td class="table_header" width="40">{"Counts"|translate}</td>
       <td class="table_header" width="50">{"Profile"|translate}</td>
      </tr>
     {foreach from=$LASTSEARCHED item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="row">
       {$ENTRY.kw}
       </td>
       <td class="row">
       {$ENTRY.sd|date_format:"%d.%m.%Y"}
       </td>
       <td class="row">
       {$ENTRY.kwcount}
       </td>
       <td class="row">
       {$ENTRY.profile}
       </td>
      </tr>
     {/foreach}
    </table>
   </td>
  </tr>
  </table>
</form>