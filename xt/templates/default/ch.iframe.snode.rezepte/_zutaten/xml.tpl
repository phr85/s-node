<?xml version="1.0" encoding="utf-8" ?>
{if count($DATA)>0}
<results>
{foreach from=$DATA item=rs}
<rs id="{$rs.id}" unitid="{$rs.unitid}" info="{if $rs.kcal > 0}{$rs.kcal}kcal{/if}{if $rs.usda_id}usda id: {$rs.usda_id}{/if}">{$rs.name}</rs>
{/foreach}
</results>
{else}
<results/>
{/if}