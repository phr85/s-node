{get_param param="title" assign="title"}
{if $title !=""}
<h1>{$title} </h1><br />
{/if}
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$DATA.galleries item=GALLERY}
 <tr>
  <td valign="top" width="15%" style="padding:0px 10px 8px 0px;"><a href="{$smarty.server.PHP_SELF}?TPL={$DATA.gallery_tpl}&amp;x{$BASEID}_id={$GALLERY.id}">{
  image
      id=$GALLERY.image
      version=2
      class="left_thumag"
  }</a></td>
  <td valign="top">
   <h2><a href="{$smarty.server.PHP_SELF}?TPL={$DATA.gallery_tpl}&amp;x{$BASEID}_id={$GALLERY.id}">{$GALLERY.title}</a></h2>
   {$GALLERY.description}
  </td>
 </tr>
 {/foreach}
</table>
