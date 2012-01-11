<form method="POST" name="mediatable">
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="admin_title" colspan="2">{"Image Picker"|translate}</td>
 </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" colspan="2">{"Choose an existing image"|translate}</td>
 </tr>
 <tr>
  <td style="padding: 10px; padding-right: 0px;" width="50%" valign="top">
   {include file="ch.iframe.snode.mediamanager/admin/overview_tree.tpl"}
  </td>
  <td style="padding: 10px;" width="50%" valign="top">
   <table cellspacing="0" cellpadding="0">
    <tr>
     <td class="lang_tab_active"><img src="{$XT_IMAGES}icons/photo_portrait.png" alt="" title=""></td>
    </tr>
   </table>
   {include file="ch.iframe.snode.mediamanager/admin/overview_browser.tpl"}
  </td>
 </tr>
</table>
<input type="hidden" name="x{$BASEID}_lang_filter" value="{$ACTIVE_LANG}">
<input type="hidden" name="x{$BASEID}_save_lang" value="{$ACTIVE_LANG}">
</form>
