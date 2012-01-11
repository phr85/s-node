<form method="post" name="slave1" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<div id="content">
<h1>{"Recipe"|translate}</h1>
{"last_changes"|translate}

<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
  <td class="table_header" width="40"><br /></td>
  <td class="table_header" width="40"><b>ID</b></td>
  <td class="table_header">{"productname"|translate}</td>
  <td class="table_header" width="50">{"date"|translate}</td>
 </tr>
 {foreach from=$CHANGES item=ENTRY}
 <tr class="{cycle values="row_a,row_b"}">
  <td class="row">{
  actionIcon
      action = "editRecipe"
      icon   = "pencil.png"
      form   = "slave1"
      perm   = "editRecipe"
      title  = "edit recipe"
      id     = $ENTRY.id
  }</td>
  <td class="row">{$ENTRY.id}</td>
  <td class="row">{$ENTRY.title|default:"<br />"}</td>
  <td class="row">{$ENTRY.m_date|date_format:"%d.%m.%Y"}</td>
 </tr>
 {/foreach}
</table>
<br />
<br />
 {"newest_entries"|translate} 
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
 <td class="table_header" width="40"><br /></td>
  <td class="table_header" width="40"><b>ID</b></td>
  <td class="table_header">{"productname"|translate}</td>
  <td class="table_header" width="50">{"date"|translate}</td>
 </tr>
 {foreach from=$NEWEST item=ENTRY}
 <tr class="{cycle values="row_a,row_b"}">
   <td class="row">{
  actionIcon
      action = "editRecipe"
      icon   = "pencil.png"
      form   = "slave1"
      perm   = "editRecipe"
      title  = "edit recipe"
      id     = $ENTRY.id
  }</td>
  <td class="row">{$ENTRY.id}</td>
  <td class="row">{$ENTRY.title|default:"<br />"}</td>
  <td class="row">{$ENTRY.c_date|date_format:"%d.%m.%Y"}</td>
 </tr>
 {/foreach}
</table>

{include file="ch.iframe.snode.rezepte/admin/hiddenValues.tpl"}
</div>
</form>

<script language="javascript" type="text/javascript"><!--
yoffset = window.parent.frames['master'].pageYOffset;
setTimeout("window.parent.frames['master'].document.forms[1].x{$BASEID}_yoffset.value=yoffset",200);
//-->
</script>