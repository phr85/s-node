<form method="POST" name="mediatable">
 {include file="includes/buttons.tpl" data=$BUTTONS}
 <table cellpadding="0" cellspacing="0" width="100%">
  <tr>
   <td valign="top" style="width: 340px;">{include file="ch.iframe.snode.mediamanager/admin/overview_tree.tpl"}</td>
   <td style="padding-left: 10px;" valign="top">{include file="ch.iframe.snode.mediamanager/admin/overview_browser.tpl"}</td>
  </tr>
 </table>
</form>