<form method="POST" name="slave1">
<input type="hidden" name="x{$BASEID}_id" value="">
<input type="hidden" name="x{$BASEID}_action" value="">
<input type="hidden" name="x{$BASEID}_property_id" value="">
<input type="hidden" name="x{$BASEID}_node_id" value="">
<input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}">
{include file="includes/lang_selector_simple.tpl" form="slave1"}

   <table cellspacing="0" cellpadding="0" width="100%">
    <tr>
       <td class="tab" colspan="4">{"last_changes"|translate}</td>
    </tr>
    <tr>
       <td class="table_header" width="20"><b>ID</b></td>
       <td class="table_header" width="60">{"art_nr"|translate}</td>
       <td class="table_header" width="*">{"productname"|translate}</td>
       <td class="table_header" width="50">{"date"|translate}</td>
      </tr>
      {foreach from=$CHANGES item=ENTRY}
     <tr class="{cycle values="row_a,row_b"}">
       <td class="row">{$ENTRY.id}</td>
       <td class="row">{$ENTRY.art_nr|default:"<br>"}</td>
       <td class="row">{$ENTRY.title|default:"<br>"}</td>
       <td class="row">{$ENTRY.edate|date_format:"%d.%m.%Y"}</td>
      </tr>
     {/foreach}
    </table>
<br>

<table cellspacing="0" cellpadding="0" width="100%">
    <tr>
       <td class="tab" colspan="4">{"newest_entries"|translate}</td>
    </tr>
<tr>
       <td class="table_header" width="20"><b>ID</b></td>
       <td class="table_header" width="60">{"art_nr"|translate}</td>
       <td class="table_header" width="*">{"productname"|translate}</td>
       <td class="table_header" width="50">{"date"|translate}</td>
      </tr>
      {foreach from=$NEWEST item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="row">{$ENTRY.id}</td>
       <td class="row">{$ENTRY.art_nr|default:"<br>"}</td>
       <td class="row">{$ENTRY.title|default:"<br>"}</td>
       <td class="row">{$ENTRY.edate|date_format:"%d.%m.%Y"}</td>
      </tr>
     {/foreach}
    </table>
{yoffset}
 </form>

<script language="javascript"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x{$BASEID}_yoffset.value=yoffset
setTimeout("window.parent.frames['master'].document.forms[1].submit()",200);

//-->
</script>

