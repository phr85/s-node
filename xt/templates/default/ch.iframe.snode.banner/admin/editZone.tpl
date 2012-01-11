{literal}
<script language="JavaScript"><!--
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>
{/literal}

<form method="POST">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title_light">{"Zone"|translate}:</span> <span class="title">{$ZONE.title}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="left">{"Title"|translate}</td>
  <td class="right"><input type="text" name="x{$BASEID}_title" size="42" value="{$ZONE.title|htmlspecialchars}"></td>
 </tr>
 <tr>
  <td class="left">{"Description"|translate}</td>
  <td class="right">{toggle_editor id="description"}
  <textarea id="x{$BASEID}_description" name="x{$BASEID}_description" rows="4" cols="65">{$ZONE.description}</textarea></td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Banner"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
</table>
{include file="includes/buttons.tpl" data=$BUTTONS_BANNER withouthidden="1"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="80">{"Options"|translate}</td>
  <td class="table_header">{"Title"|translate}</td>
  <td class="table_header" width="50">{"CTR"|translate}</td>
  <td class="table_header" width="50">{"Views"|translate}</td>
  <td class="table_header" width="50">{"Clicks"|translate}</td>

 </tr>
 {foreach from=$BANNERS item=BANNER}
 <tr class="{cycle values=row_a,row_b}">
  <td class="button" valign="top" width="80">{if $BANNER.timer == 'ready'}<img src="{$XT_IMAGES}icons/alarmclock_pause.png" alt="" width="16" />{/if
      }{if $BANNER.timer == 'expired'}<img src="{$XT_IMAGES}icons/alarmclock_stop.png" alt="" width="16" />{/if
      }{if $BANNER.timer == 'running'}<img src="{$XT_IMAGES}icons/alarmclock_run.png" alt="" width="16" />{/if
      }{if $BANNER.timer == 'unused'}<img src="{$XT_IMAGES}spacer.gif" alt="" width="16" />{/if}
  {if $BANNER.active == 0}{
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
  <td class="row" valign="top">{
  actionLink
      action="editBanner"
      form="0"
      banner_id=$BANNER.id
      text=$BANNER.title|truncate:30:"...":true
  }&nbsp;<br />
  <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&amp;x{$BASEID}_banner_id={$BANNER.id}&amp;x{$BASEID}_action=editBanner">
  {if $BANNER.image_type == 2}
  <div style="border: 1px solid black; margin-top: 5px; width: 200px;">
  <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$BANNER.width height=$BANNER.height}">
   <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$BANNER.image}" />
   <param name="quality" value="high" />
   <embed src="{$XT_WEB_ROOT}download.php?file_id={$BANNER.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$BANNER.width height=$BANNER.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
  </object>
  </div>
  {else}{image
    id=$BANNER.image
    version=0
    title=$BANNER.title
    alt=$BANNER.title
    style="border: 1px solid black; margin-top: 5px;"
  }{/if}
  </a></td>
  <td class="row" valign="top">{$BANNER.ctr}&nbsp;%&nbsp;</td>
  <td class="row" valign="top">{$BANNER.views}&nbsp;</td>
  <td class="row" valign="top">{$BANNER.clicks}&nbsp;</td>

 </tr>
 {/foreach}
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Banner code"|translate}</span>
  </td>
 </tr>
 <tr>
  <td class="view_separator" colspan="4"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <td class="left">{"Code for external sites"|translate}</td>
  <td class="right">
  <textarea  rows="20" cols="65" readonly="readonly" id="BannerCode">
<script language='JavaScript' type='text/javascript'>
<!--
   AdsRandom = new String (Math.random()); AdsRandom = AdsRandom.substring(2,11);
   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
   document.write ("http://{$smarty.server.SERVER_NAME}/index.php?TPL=302&amp;random=" + AdsRandom);
   document.write ("&amp;zonename={$ZONE.title}");
   document.write ("'><" + "/script>");
//-->
</script>
 </textarea></td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_zone_id" value="{$ZONE.id}" />
<input type="hidden" name="x{$BASEID}_banner_id" />
{include file="includes/editor.tpl"}
</form>
