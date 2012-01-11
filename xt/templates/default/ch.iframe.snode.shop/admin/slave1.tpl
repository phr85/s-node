<form method="POST" name="taxes">
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
</form>

<form method="POST" name="discounts">
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
 </form>
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr class="{cycle values='row_a,row_b'}">
   <td>
   </td>

  </tr>
 </table>


<script language="javascript"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x{$BASEID}_yoffset.value=yoffset
window.parent.frames['master'].document.forms[1].submit();
//-->
</script>

