{include file="includes/charfilter.tpl" form="formstable"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">{"Options"|translate}</td>
   <td class="table_header" width="45">ID</td>
   <td class="table_header">{"Title"|translate}</td>
  </tr>
  {foreach from=$DATA item=FORM}
  <tr class="{cycle values="row_a,row_b"}">
   <td class="button"><a href="#" onclick="saveForm({$FORM.id}, '{$FORM.title}');"><img src="{$XT_IMAGES}icons/check.png" width="16" height="16" alt="&nbsp;" /></a></td>
   <td class="row">{$FORM.id}&nbsp;</td>
   <td class="row">{$FORM.title}</td>
  </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="formstable"}
{literal}
<script language="javascript" type="text/javascript">
function saveForm(form_id, form_title) {
  {/literal}  window.opener.document.forms['{$form}'].{$field}.value= form_id;
    window.opener.document.forms['{$form}'].{$titlefield}.value= form_title;
    window.close();
    {literal}
}
</script>
{/literal}