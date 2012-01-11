<form method="post" name="publish">
{include file="ch.iframe.snode.packagebuilder/admin/hiddenValues.tpl"}
<table cellspacing="0" cellpadding="0" width="100%">
<tr>
<td class="view_header" colspan="2">
<span class="title_light">{"publish"|translate}</span>
</td>
</tr>
<tr>
<td class="view_separator" colspan="2"><img src="{$XT_IMAGES}spacer.gif" alt="" /></td>
</tr>
<tr>
<td colspan="2">
{include file="includes/buttons.tpl" data=$BUTTONS withouthidden="1"}
</td>
</tr>
<tr>
 <td class="left">
    {"Comment"|translate}
 </td>
 <td class="right">
   <textarea name="x{$BASEID}_comment" rows="10" cols="150"></textarea>
 </td>
</tr>
<tr>
	
 <td class="left">
    {"package"|translate}
 </td>
 <td class="right">
   <select name="x{$BASEID}_package" style="width:360px;" size="15"/>
 {foreach from=$PRODUCTS item=PRODUCT}
      <option label="{$PRODUCT}" value="{$PRODUCT}">{$PRODUCT}</option>  
 {/foreach}
 </select>
 </td>
</tr>
</table>
<input type="hidden" name="x{$BASEID}_action" />
<input type="hidden" name="x{$BASEID}_package_id" />
</form>
<table cellspacing="0" cellpadding="0" width="100%">
  <tr>
   <td class="table_header" width="150">{"date"|translate}</td>
   <td class="table_header" width="150">{"revision"|translate}</td>
   <td class="table_header" width="200">{"package"|translate}</td>
   <td class="table_header">{"comment"|translate}</td>
   <td class="table_header" width="20">&nbsp;</td>
  </tr>
  {foreach from=$LAST_PUBLISH item=PUBLISHED}
  <tr class="{cycle values="row_a,row_b"}">
       <td class="row">{$PUBLISHED.publish_date|date_format:"%d.%m.%Y"}</td>
       <td class="row">{$PUBLISHED.revision}</td>
       <td class="row">{$PUBLISHED.package}</td>
       <td class="row">{$PUBLISHED.comment|nl2br}</td>
       <td class="row">
		{actionIcon
           action = "deletePublished"
           title = "Delete published"
           form= "publish"
           icon= "delete.png"
           yoffset="1"
           package_id = $PUBLISHED.id
           ask="are you sure to delete this published package?"
       }
	   </td>
   </tr>    
   {/foreach}
</table>