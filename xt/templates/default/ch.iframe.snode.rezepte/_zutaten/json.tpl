{literal}{ "results": [{/literal}
{foreach from=$DATA name=data item=rs}
       {literal}{{/literal} id: "{$rs.id}", value: "{$rs.name}", info: "{if $rs.kcal > 0}{$rs.kcal}kcal{/if}{if $rs.usda_id}usda id: {$rs.usda_id}{/if}", unitid: "{$rs.unit_id}" {literal}}{/literal}{if !$smarty.foreach.data.last},{/if}

{/foreach}
{literal}] }{/literal}