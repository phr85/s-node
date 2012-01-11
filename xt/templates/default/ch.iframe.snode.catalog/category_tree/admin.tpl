{if sizeof($DATA) > 0}


<table cellpadding="0" cellspacing="0" width="100%">
 {foreach from=$DATA item=NAV}
 <tr>{
  if $NAV.level > 1
      }{
      if $NAV.itw
      }<td class="navigation_subentry_active" style="padding-left: {$NAV.level*11}px;">{
       if $NAV.subs
        }<img src="{$XT_IMAGES}icons/minus_blue.gif" />&nbsp;&nbsp;{
       /if
       }<a href="{$smarty.server.PHP_SELF}?TPL={$NAV.id}">{$NAV.title}</a></td>{
       else
       }<td class="navigation_subentry" style="padding-left: {$NAV.level*11}px;">{
       if $NAV.subs
        }<img src="{$XT_IMAGES}icons/plus_blue.gif" />&nbsp;&nbsp;{
       /if
       }<a href="{$smarty.server.PHP_SELF}?TPL={$NAV.id}">{$NAV.title}</a></td>{
      /if}{
      else
      }{if $NAV.itw
      }<td class="navigation_subentry_active" style="padding-left: {$NAV.level*6}px;">{
       if $NAV.subs
        }<img src="{$XT_IMAGES}icons/minus_blue.gif" />&nbsp;&nbsp;{
       /if
       }<a href="{$smarty.server.PHP_SELF}?TPL={$NAV.id}">{$NAV.title}</a></td>{
      else
      }<td class="navigation_entry" style="padding-left: {$NAV.level*6}px;">{
      if $NAV.subs
        }<img src="{$XT_IMAGES}icons/plus_blue.gif" />&nbsp;&nbsp;{
      /if
      }<a href="{$smarty.server.PHP_SELF}?TPL={$NAV.id}">{$NAV.title}</a></td>{
      /if}{
  /if
 }</tr>
 {/foreach}
</table>


{/if}
