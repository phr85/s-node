<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="properties_overview">
{include file="includes/buttons.tpl" data=$BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="properties_overview"}
{include file="includes/charfilter.tpl" form="properties_overview"}
{if $FORCE_SLAVE_RELOAD == "1"}

{literal}
<script language="JavaScript"><!--
if(window.parent.frames['slave1']){
    window.parent.frames['slave1'].document.forms[0].submit();
}
{/literal}
document.properties_overview.x{$BASEID}_lang_filter.value='';
//-->
</script>
{/if}
<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td class="table_header" width="80">{"options"|translate}</td>
       <td class="table_header" width="20">ID</td>
       <td class="table_header" width="180">{"fieldname"|translate}</td>
       <td class="table_header">{"description"|translate}</td>
      </tr>

      {foreach from=$DATA item=ENTRY}
      {if $CHAR_FILTER == "" OR $CHAR_FILTER == "all" OR $ENTRY.title|lower|truncate:1:"" == $CHAR_FILTER}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {actionIcon
             action         = "editProperty"
             icon           = "pencil.png"
             form           = "0"
             perm           = "manageProperties"
             title          = "edit property"
             target         = "slave1"
             property_id    = $ENTRY.id
        }{actionIcon
             action         = "deleteProperty"
             icon           = "delete.png"
             form           = "properties_overview"
             perm           = "manageProperties"
             ask            = "Are you sure to delete this property?"
             title          = "delete property"
             property_id    = $ENTRY.id
        }</td>
       <td class="row">
       {$ENTRY.id}
       </td>
       <td class="row">{$ENTRY.title|default:"?"}</td>
       <td class="row">{$ENTRY.description|default:"&nbsp;"|truncate:35:"..."}</td>
      </tr>
      {/if}
     {/foreach}
    </table>
 {include file="ch.iframe.snode.properties/admin/hiddenValues.tpl"}
</form>