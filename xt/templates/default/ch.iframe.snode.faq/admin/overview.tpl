<form method="POST" name="faq">
 {include file="includes/buttons.tpl" data=$BUTTONS withouthidden=true yoffset=true}
 {include file="includes/lang_selector_simple.tpl" form="faq"}
 <table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="80">&nbsp;</td>
   <td class="table_header" width="100">{actionIcon action="NULL" form=faq label="Date" sort=$sort.0.value icon=$sort.0.icon}</td>
   <td class="table_header" width="40">{actionIcon action="NULL" label="ID" form=faq sort=$sort.1.value icon=$sort.1.icon}</td>
   <td class="table_header">{actionIcon action="NULL" form=faq label="Title" sort=$sort.2.value icon=$sort.2.icon}</td>
  </tr>
  {foreach from=$xt1400_DATA item=FAQ name=FAQTABLE}
  <tr class="{cycle values="row_a,row_b"}" {if $FAQ.locked_user == $USER_ID}style="background-image: url({$XT_IMAGES}admin/gfx/naventry_active.gif);"{/if}>
   <td class="button">{if $FAQ.locked != 1 || $FAQ.locked_user == $USER_ID}{if $FAQ.active
   }{actionIcon 
        action="deactivateFaq"
        icon="active.png"
        form="faq"
        perm="statuschange"
        id=$FAQ.id
        title="Deactivate this faq"
   }{else
   }{actionIcon 
        action="activateFaq"
        icon="inactive.png"
        form="faq"
        perm="statuschange"
        id=$FAQ.id
        title="Activate this faq"
   }{/if
   }{actionIcon 
        action="editFaq"
        icon="pencil.png"
        form="0"
        target="slave1"
        id=$FAQ.id
        perm="edit"
        title="Edit this faq"
   }{actionIcon 
        action="deleteFaq"
        icon="delete.png"
        form="faq"
        id=$FAQ.id
        perm="delete"
        title="Delete this faq"
        ask="Are you sure you want to delete this faq?"
   }{else}{"In edit"|translate}{/if}
   <img src="{$XT_IMAGES}/icons/{if $FAQ.is_answered == 1}status_1.gif{else}status_0.gif{/if}" title="{if $FAQ.is_answered == 1}{"answered"|translate}{else}{"Not answered yet"|translate}{/if}" alt="{"Is Answered"|translate}?" /></td>
   <td class="row">{$FAQ.date|date_format:"%d.%m.%Y %H:%I"}</td>
    <td class="row">{$FAQ.id}</td>
   <td class="row">{
   actionLink
       action="editFaq"
       form="0"
       target="slave1"
       perm="view"
       id=$FAQ.id
       text=$FAQ.title|truncate:40:"...":true
   }&nbsp;</td>
  </tr>
  {/foreach}
 </table>
 <input type="hidden" name="faq" value="">
	<input type="hidden" name="showtabs" value="1" />
 	{include file="includes/navigator.tpl" form="faq"}
	{include file="ch.iframe.snode.faq/admin/hiddenValues.tpl"}
 <input type="hidden" name="x{$BASEID}_sort" value="" />
</form>