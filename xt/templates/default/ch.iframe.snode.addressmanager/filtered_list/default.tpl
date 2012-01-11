<form action="/index.php?TPL={$TPL}" method="post" name="filtered_list">
{if $xt7400_filtered_list.property_id}
{subplugin package="ch.iframe.snode.properties" module="viewer" property=$xt7400_filtered_list.property_id style="dropdown_addressfilter.tpl" SOURCEBASEID=$BASEID}
{/if}
<hr />
{assign var="BASEID" value= 7400}
<div class="addresslist">
<div class="addresslisttitle">{actionLink action="NULL" text="firma"|translate form=filtered_list sort=$sort.0.value baseid=7400}</div>
<div class="addresslisttitle">{actionLink action="NULL" text="phone"|translate form=filtered_list sort=$sort.1.value baseid=7400}</div>
<div class="addresslisttitle">{actionLink action="NULL" text="postalCode"|translate form=filtered_list sort=$sort.2.value baseid=7400}
{actionLink action="NULL" text="city"|translate form=filtered_list sort=$sort.3.value baseid=7400}
</div>
<div class="addresslisttitle">{"webseite"|livetranslate}</div>
<br clear="all" />
{foreach from=$xt7400_filtered_list.data item=ADDRESS}
{if $ADDRESS.title!=""}
{cycle values=" address_odd, address_even" assign="line"}
<div class="addresslistcell{$line}"><a href="/index.php?TPL={get_param param='details_tpl'}&x7400_id={$ADDRESS.id}">{$ADDRESS.title}&nbsp;</a></div>
<div class="addresslistcell{$line}">{$ADDRESS.tel}&nbsp;</div>
<div class="addresslistcell{$line}">{$ADDRESS.postalCode} {$ADDRESS.city}&nbsp;</div>
<div class="addresslistcell{$line}">{$ADDRESS.website}&nbsp;</div>
<br clear="all" />
{/if}
{/foreach}
</div>
 <input type="hidden" name="x{$BASEID}_sort" value="" />
 <input type="hidden" name="x{$BASEID}_action" value="" />
</form>