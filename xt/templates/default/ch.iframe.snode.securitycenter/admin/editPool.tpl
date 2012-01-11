<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="edit_node">
 {include file="includes/buttons.tpl" data=$EDIT_NODE_BUTTONS withouthidden=1}
 <table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="view_header" colspan="2">
   <span class="title">{"Edit pool"|translate}</span>
  </td>
 </tr>
<tr>
  <td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
 </tr>
 <tr>
  <tr>
   <td class="left">{"Name"|translate}</td>
   <td class="right"><input type="text" name="x{$BASEID}_title" id="title" value="{$NODE.title}" size="42" onfocus="this.select()"></td>
  </tr>
 </table>
 {include file="ch.iframe.snode.securitycenter/admin/hiddenValues.tpl"}
</form>

{literal}
<script type="text/javascript">
addEvent(window, 'load', function() {
 document.getElementById('title').focus()
});

function addEvent(obj, evType, fn){
 if (obj.addEventListener){
    obj.addEventListener(evType, fn, true);
    return true;
 } else if (obj.attachEvent){
    var r = obj.attachEvent("on"+evType, fn);
    return r;
 } else {
    return false;
 }
}
</script>
{/literal}