{literal}
<script type="text/javascript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].x{/literal}{$BASEID}_lang_filter.value='{$ACTIVE_LANG}';{literal}
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="edit" onSubmit="window.document.forms['editArticle'].x{$BASEID}_yoffset.value= window.pageYOffset;">
<h2><span class="light">{"POLL"|translate}:</span> {$ARTICLE.title}</h2>
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
<form method="post" name="formstable" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<h2>{"select_poll1"|translate}</h2>
{include file="includes/charfilter.tpl" form="formstable"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="45">{actionIcon action="NULL" label="ID" form=formstable sort=$sort.0.value icon=$sort.0.icon}</td>
   <td class="table_header">{actionIcon action="NULL" form=formstable label="Title" sort=$sort.1.value icon=$sort.1.icon}</td>
   <td class="table_header" width="30">{"pick"|translate}</td>
  </tr>
  {foreach from=$DATA item=FORM}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="row">{$FORM.id}&nbsp;</td>
       <td class="row">{
       actionLink
           action="pickForm"
           form="0"
           target="slave1"
           form_id=$FORM.id
           text=$FORM.title|truncate:80:"...":true
       }&nbsp;</td>
       <td>{
       actionIcon
           action="pickForm"
           icon="check.png"
           form="0"
           target="slave1"
           form_id=$FORM.id
           title="Pick this Form"
       }</td>
       
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="formstable"}
 <input type="hidden" name="x{$BASEID}_form_id" value="" />
 <input type="hidden" name="x{$BASEID}_sort" value="" />
</form>
 </tr>

</table>

<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
<form method="post" name="formstable" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<h2>{"select_poll2"|translate}</h2>
{include file="includes/charfilter.tpl" form="formstable"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="45">{actionIcon action="NULL" label="ID" form=formstable sort=$sort.0.value icon=$sort.0.icon}</td>
   <td class="table_header">{actionIcon action="NULL" form=formstable label="Title" sort=$sort.1.value icon=$sort.1.icon}</td>
   <td class="table_header" width="30">{"pick"|translate}</td>
  </tr>
  
  {foreach from=$DATA2 item=FORM}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="row">{$FORM.id}&nbsp;</td>
       <td class="row">{
       actionLink
           action="pickForm"
           form="0"
           target="slave1"
           form_id=$FORM.id
           text=$FORM.title|truncate:80:"...":true
       }&nbsp;</td>
       <td>{
       actionIcon
           action="pickForm"
           icon="check.png"
           form="0"
           target="slave1"
           form_id=$FORM.id
           title="Pick this Form"
       }</td>
       
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="formstable"}
 <input type="hidden" name="x{$BASEID}_form_id" value="" />
 <input type="hidden" name="x{$BASEID}_sort" value="" />
</form>
 </tr>

</table>

<input type="hidden" name="x{$BASEID}_image" value="{$ARTICLE.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$ARTICLE.image_version}" />
<input type="hidden" name="x{$BASEID}_article_id" value="" />
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_rid" value="{$ARTICLE.rid}" />
<input type="hidden" name="x{$BASEID}_chapter" value="" />
<input type="hidden" name="x{$BASEID}_level" value="" />
<input type="hidden" name="x{$BASEID}_liveedit" value="{$LIVEEDIT}" />
<input type="hidden" name="x{$BASEID}_active" value="{$ARTICLE.active}" />
<input type="hidden" value="{$smarty.server.HTTP_REFERER}" name="x{$BASEID}_request" />
{yoffset}
</form>