<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN">
<head>
 <title>Snode XT :: Administration</title>
 <link rel="stylesheet" href="{$XT_STYLES}sourceedit/default.css" />
 {$META}
</head>
<body>
<form method="POST" name="sourceedit">
<table cellpadding="0" cellspacing="0" width="100%">
 <tr>
  <td class="toolbox">
   <input type="hidden" name="x{$BASEID}_tpl_id" value="{$TPL_ID}">
   <input type="hidden" name="x{$BASEID}_file" value="{$TPL_FILE}">
   <input type="submit" class="button" value="{'Save'|translate}" accesskey="S"> <input type="button" class="button" value="{'Close'|translate}" onclick="window.close();" accesskey="Q">
  </td>
 </tr>
</table>
<textarea rows="30" cols="120" name="x{$BASEID}_source" style="margin: 10px;">{$SOURCE}</textarea>
</form>
{literal}
<script type="text/javascript"><!--

document.getElementsByName('x{/literal}{$BASEID}{literal}_source')[0].focus();
window.opener.location.href = '{/literal}{$smarty.server.PHP_SELF}?TPL={$TPL_ID}{literal}';

//-->
</script>
{/literal}
</body>
</html>