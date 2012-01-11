{if sizeof($DATA) > 0}
<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$DATA item=NAV name=N}
 {if $NAV.root_count%3 == 1 && $NAV.level == 3}</tr><tr>{/if}
 {if $smarty.foreach.N.first}<tr>{/if}
  {if $NAV.level == 3}
  <td class="content_block" width="33%"><a target="{$NAV.target}" href="{if $NAV.ext_link}{$NAV.ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$NAV.id}{/if}">{
   image
       id=$NAV.image
       version=""
       title=$NAV.description
       alt=$NAV.title
   }</a>
  <br /><br />
  <div class="content_block_text">
   <span class="content_block_text_light">{$NAV.description}</span><br /><br />{else}
   <span style="padding-left: 12px;">&raquo;&nbsp;&nbsp;<a target="{$NAV.target}" href="{if $NAV.ext_link}{$NAV.ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$NAV.id}{/if}">{$NAV.title}</a></span><br />
   {/if}
  {if $NAV.subs > 0}
  </div>
  {/if}
 {/foreach}
</table>
{/if}