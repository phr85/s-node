{literal}
<script type="text/javascript"><!--
if(window.parent.frames['master']){
    window.parent.frames['master'].document.forms[1].x{/literal}{$BASEID}_lang_filter.value='{$ACTIVE_LANG}';{literal}
    window.parent.frames['master'].document.forms[1].submit();
}
//-->
</script>
{/literal}
<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="post" name="edit" onSubmit="window.document.forms['editpoll'].x{$BASEID}_yoffset.value= window.pageYOffset;">
{include file="includes/buttons.tpl" data=$EDIT_BUTTONS}

{include file="ch.iframe.snode.formreport/admin/time.tpl"}
<table cellspacing="0" cellpadding="0" width="100%">
 <tr>
<form method="post" name="formstable" action="{$smarty.server.PHP_SELF}?TPL={$TPL}">
<h2>{"Form"|translate}</h2>
{include file="includes/charfilter.tpl" form="formstable"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="45">{actionIcon action="NULL" label="ID" form=formstable sort=$sort.0.value icon=$sort.0.icon}</td>
   <td class="table_header">{actionIcon action="NULL" form=formstable label="Title" sort=$sort.1.value icon=$sort.1.icon}</td>
   <td class="table_header" width="30">{"pick"|translate}</td>
  </tr>
  {foreach from=$DATA item=FORM}
      <tr class="{cycle values="row_a,row_b"}">
       {if $PICKEDFORM != $FORM.id}<td class="row">{else}<td class="row" style="background-color: #DBFF8C;">{/if}{$FORM.id}&nbsp;</td>
       {if $PICKEDFORM != $FORM.id}<td class="row">{else}<td class="row" style="background-color: #DBFF8C; ">{/if}{
       actionLink
           action="pickForm"
           form="0"
           target="slave1"
           form_id=$FORM.id
           text=$FORM.title|truncate:80:"...":true
       }&nbsp;</td>
       
       {if $PICKEDFORM != $FORM.id}
       <td>{
       actionIcon
           action="pickForm"
           icon="check.png"
           form="0"
           target="slave1"
           form_id=$FORM.id
           title="Pick this Form"
       }
       {else}
       <td style="background-color: #DBFF8C;">{
       actionIcon
           action="pickForm"
           icon="warning.png"
           form="0"
           target="slave1"
           form_id=$FORM.id
           title="Pick this Form"
       }
       {/if}</td>
       
      </tr>
  {/foreach}
 </table>
 {include file="includes/navigator.tpl" form="formstable"}
 <input type="hidden" name="x{$BASEID}_form_id" value="" />
 <input type="hidden" name="x{$BASEID}_sort" value="" />
</form>
 </tr>

</table>



<input type="hidden" name="x{$BASEID}_image" value="{$poll.image}" />
<input type="hidden" name="x{$BASEID}_image_version" value="{$poll.image_version}" />
<input type="hidden" name="x{$BASEID}_poll_id" value="" />
<input type="hidden" name="x{$BASEID}_id" value="" />
<input type="hidden" name="x{$BASEID}_node_pid" value="" />
<input type="hidden" name="x{$BASEID}_node_id" value="" />
<input type="hidden" name="x{$BASEID}_position" value="" />
<input type="hidden" name="x{$BASEID}_rid" value="{$poll.rid}" />
<input type="hidden" name="x{$BASEID}_chapter" value="" />
<input type="hidden" name="x{$BASEID}_level" value="" />
<input type="hidden" name="x{$BASEID}_liveedit" value="{$LIVEEDIT}" />
<input type="hidden" name="x{$BASEID}_active" value="{$POLL.active}" />
<input type="hidden" value="{$smarty.server.HTTP_REFERER}" name="x{$BASEID}_request" />
{yoffset}
</form>
{include file="includes/editor.tpl"}
{literal}
<script type="text/javascript"><!--
function switchLinkType(element,id){
    if(id != '' || id == 0){
        if(element.checked){
            document.getElementById('image' + id + '_link').value='';
            document.getElementById('image' + id + '_link').disabled=true;
            document.getElementById('image' + id + '_link_target').disabled=true;
        } else {
            document.getElementById('image' + id + '_link').disabled=false;
            document.getElementById('image' + id + '_link_target').disabled=false;
        }
    } else {
        if(element.checked){
            document.getElementById('image_link').value='';
            document.getElementById('image_link').disabled=true;
            document.getElementById('image_link_target').disabled=true;
        } else {
            document.getElementById('image_link').disabled=false;
            document.getElementById('image_link_target').disabled=false;
        }
    }
}
//-->
</script>
{/literal}