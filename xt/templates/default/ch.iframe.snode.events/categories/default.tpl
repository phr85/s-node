<h1>{"Events"|translate}</h1>
<h2>{"Please Select Category"|livetranslate}</h2>
{if sizeof($DATA) > 0}
 <ul class="event_categories">
	  {foreach from=$DATA item=NAV}
	  <li>
		  {if $NAV.selected}
		  <a href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&amp;x{$BASEID}_category_id={$NAV.id}">
		  {$NAV.title}</a>
		  {else}
		  <a href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&amp;x{$BASEID}_category_id={$NAV.id}">
		  {$NAV.title}</a>
		  {/if}
	  </li>	
	 {/foreach}
 </ul>
{/if}