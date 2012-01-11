<div>
<h3>history</h3>
{foreach from=$DATA item=PAGE}
<a href="{$PAGE.link}">{$PAGE.title}</a>
{$PAGE.time|date_format:"%H:%M:%S"}<br />
{/foreach}
</div>