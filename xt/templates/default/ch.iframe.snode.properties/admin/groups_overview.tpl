<form action="{$smarty.server.PHP_SELF}?TPL={$TPL}" method="POST" name="fieldgroups_overview">

{include file="includes/buttons.tpl" data=$BUTTONS}
{include file="includes/lang_selector_simple.tpl" form="fieldgroups_overview"}
{include file="includes/charfilter.tpl" form="fieldgroups_overview"}


<table cellspacing="0" cellpadding="0" width="100%">
     <tr>
       <td class="table_header" width="80">{"options"|translate}</td>
       <td class="table_header" width="20">ID</td>
       <td class="table_header" width="80">{"groupname"|translate}</td>
       <td class="table_header">{"description"|translate}</td>
      </tr>

      {foreach from=$DATA item=ENTRY}
      <tr class="{cycle values="row_a,row_b"}">
       <td class="button">
       {actionIcon
             action         = "editGroup"
             icon           = "pencil.png"
             form           = "0"
             perm           = "manageProperties"
             title          = "edit fieldgroup"
             target         = "slave1"
             group_id       = $ENTRY.id
        }{actionIcon
             action         = "deleteGroup"
             icon           = "delete.png"
             form           = "fieldgroups_overview"
             perm           = "manageProperties"
             ask            = "Are you sure to delete this fieldgroup?"
             title          = "delete fieldgroup"
             group_id  = $ENTRY.id
        }</td>
       <td class="row">
       {$ENTRY.id}
       </td>
       <td class="row">{$ENTRY.title|default:"?"}</td>
       <td class="row">{$ENTRY.description|default:"?"|truncate:35:"..."}</td>
      </tr>
     {/foreach}
    </table>
 {include file="includes/navigator.tpl" form="fieldgroups_overview"}
{include file="ch.iframe.snode.properties/admin/hiddenValues.tpl"}
</form>