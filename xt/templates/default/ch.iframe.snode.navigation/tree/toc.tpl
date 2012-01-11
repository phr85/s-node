<h1>{$TPL_REAL_TITLE}</h1>
<p>{$TPL_DESC}</p>
{if sizeof($DATA) > 0}
{foreach from=$DATA item=PAGE}
{if $PAGE.level == 2}
<h2>{$PAGE.title}</h2>
{else}
<a 
 target="{$PAGE.target}" 
 href="{if $PAGE.ext_link}{$PAGE.ext_link}{else}{$smarty.server.PHP_SELF}?TPL={$PAGE.id}{/if}">
 {$PAGE.title}
</a><br />
{/if}
{/foreach}
</ul>
</div>
{/if}