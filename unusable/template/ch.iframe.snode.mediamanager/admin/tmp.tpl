{if isset($OPEN_ITEM)}
 <table cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td class="table_header" colspan="3">{"Media viewer"|translate} - <b>{$OPEN_ITEM.title}</b></td>
  </tr>
  {foreach from=$OPEN_ITEM_VERSIONS item=VERSION name=V}
  {if $OPEN_VERSION == $VERSION.id || ($OPEN_VERSION == '' && $VERSION.version eq "Default")}
  <tr class="header_active">
   <td class="row" colspan="3" style="padding-top: 5px; vertical-align: top;">&raquo; <b><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_media_id={$VERSION.pid}&x{$BASEID}_media_version_id={$VERSION.id}">{$VERSION.version}</a></b></td>
  </tr>
  <tr>
   <td colspan="2" style="padding: 5px;" valign="top"><img src="/pictures/{$VERSION.id}?rand={$smarty.now}" alt="" class="browser"></td>
   <td style="padding-right: 8px; padding-top: 5px; width: 1px;" valign="top">
   <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=effectRotateRight&x{$BASEID}_media_id={$OPEN_ITEM.id}&x{$BASEID}_media_version={$VERSION.version}&x{$BASEID}_media_version_id={$VERSION.id}"><img src="{$XT_IMAGES}icons/rotate_right.png" alt=""></a>
   <br><a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_action=effectRotateLeft&x{$BASEID}_media_id={$OPEN_ITEM.id}&x{$BASEID}_media_version={$VERSION.version}&x{$BASEID}_media_version_id={$VERSION.id}"><img src="{$XT_IMAGES}icons/rotate_left.png" alt=""></a>
   <br><img src="{$XT_IMAGES}icons/shear.png" alt="">
   <br><img src="{$XT_IMAGES}icons/shear_vert.png" alt=""></td>
  </tr>
  {else}
  <tr class="header">
   <td class="row" colspan="3" style="padding-top: 5px; vertical-align: top;">&raquo; <a href="{$smarty.server.PHP_SELF}?TPL={$TPL}&x{$BASEID}_media_id={$VERSION.pid}&x{$BASEID}_media_version_id={$VERSION.id}">{$VERSION.version}</a></td>
  </tr>
  {/if}
  {/foreach}
 </table>
 <br>
 {/if}
