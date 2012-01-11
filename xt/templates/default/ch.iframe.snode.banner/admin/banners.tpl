{literal}
<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
{/literal}
<form method="POST">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header">
   <span class="title">{$ZONE.title}</span>
  </td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {if $ZONE.description != ''}
 <tr>
  <td class="view_header">
   <span class="subline">{$ZONE.description}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 {/if}
</table>
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header" width="200">{"Title"|translate}</td>
  <td class="table_header" width="50">{"CTR"|translate}</td>
  <td class="table_header" width="50">{"Views"|translate}</td>
  <td class="table_header" width="50">{"Clicks"|translate}</td>
  <td class="table_header">{"Link"|translate}</td>
 </tr>
 {foreach from=$BANNERS item=BANNER}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button" valign="top" width="80">{if $BANNER.active == 0}{
  actionIcon
      action="activateBannerInZone"
      icon="inactive.png"
      title="Activate this banner for this zone"
      form="0"
      banner_id=$BANNER.id
  }{else}{
  actionIcon
      action="deactivateBannerInZone"
      icon="active.png"
      title="Deactivate this banner for this zone"
      form="0"
      banner_id=$BANNER.id
  }{/if}{
  actionIcon
      action="editBanner"
      form="0"
      icon="pencil.png"
      banner_id=$BANNER.id
      title="Edit this banner"
  }{
  actionIcon
      action="deleteBannerFromZone"
      form="0"
      icon="delete.png"
      banner_id=$BANNER.id
      zone_id=$ZONE.id
      title="Delete banner from this zone"
      ask="Are you sure you want to delete this banner link?"
  }</td>
  <td class="row" valign="top"><b>{$BANNER.title|truncate:30:"...":true}</b>&nbsp;<br />{image
    id=$BANNER.image
    version=2
    title=$BANNER.title
    alt=$BANNER.title
    style="border: 1px solid black; margin-top: 5px;"
  }</td>
  <td class="row" valign="top">{$BANNER.ctr}&nbsp;%&nbsp;</td>
  <td class="row" valign="top">{$BANNER.views}&nbsp;</td>
  <td class="row" valign="top">{$BANNER.clicks}&nbsp;</td>
  <td class="row" valign="top"><img src="{$XT_IMAGES}admin/arrow.gif" alt="" />&nbsp;&nbsp;<a href="{if $BANNER.link_type == 1}{$smarty.server.PHP_SELF}?TPL={$BANNER.link}{else}{$BANNER.link}{/if}" target="_blank">{$BANNER.link|truncate:30:"...":true}</a>&nbsp;</td>
 </tr>
 {/foreach}
</table>
<input type="hidden" name="x{$BASEID}_zone_id" value="{$ZONE.id}" />
<input type="hidden" name="x{$BASEID}_banner_id" />
</form>
