{literal}
<style type="text/css">
@import url("{/literal}{$XT_STYLES}{literal}installer/default.css");
#introduction {
    width: 100%;
}
</style>
{/literal}
<form method="POST" name="slave1">
<div id="content">
<h1>{"Catalog"|translate}</h1>
<p id="introduction">{"intro_text"|translate}</p>
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_action" value="" />
<input type="hidden" name="x{$BASEID}_property_id" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_module" value="{$ADMINMODULE}" />
<p id="subtitle">{"last_changes"|translate}</p>

<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="40"><b>ID</b></td>
  <td class="table_header" width="60">{"art_nr"|translate}</td>
  <td class="table_header">{"productname"|translate}</td>
  <td class="table_header" width="50">{"date"|translate}</td>
 </tr>
 {foreach from=$CHANGES item=ENTRY}
 <tr class="{cycle values="row_a,row_b"}">
  <td class="row">{
  actionIcon
      action = "editArticle"
      icon   = "pencil.png"
      form   = "slave1"
      perm   = "editArticle"
      title  = "edit article"
      id     = $ENTRY.id
  }{$ENTRY.id}</td>
  <td class="row">{$ENTRY.art_nr|default:"<br />"}</td>
  <td class="row">{$ENTRY.title|default:"<br />"}</td>
  <td class="row">{$ENTRY.edate|date_format:"%d.%m.%Y"}</td>
 </tr>
 {/foreach}
</table>

<p id="subtitle">{"newest_entries"|translate}</p>
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="40"><b>ID</b></td>
  <td class="table_header" width="60">{"art_nr"|translate}</td>
  <td class="table_header">{"productname"|translate}</td>
  <td class="table_header" width="50">{"date"|translate}</td>
 </tr>
 {foreach from=$NEWEST item=ENTRY}
 <tr class="{cycle values="row_a,row_b"}">
  <td class="row">{
  actionIcon
      action = "editArticle"
      icon   = "pencil.png"
      form   = "slave1"
      perm   = "editArticle"
      title  = "edit article"
      id     = $ENTRY.id
  }{$ENTRY.id}</td>
  <td class="row">{$ENTRY.art_nr|default:"<br />"}</td>
  <td class="row">{$ENTRY.title|default:"<br />"}</td>
  <td class="row">{$ENTRY.edate|date_format:"%d.%m.%Y"}</td>
 </tr>
 {/foreach}
</table>
{yoffset}
</div>
</form>

<script language="javascript"><!--
yoffset = window.parent.frames['master'].pageYOffset;
window.parent.frames['master'].document.forms[1].x{$BASEID}_yoffset.value=yoffset
setTimeout("window.parent.frames['master'].document.forms[1].submit()",200);

//-->
</script>

