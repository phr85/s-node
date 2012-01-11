{XT_load_css file="events.css"}
{XT_load_css file="calendar.css"}
<div class="xt_event">
<h1>Termine {$xt5100_monthlist.additionaldata.year}</h1>
{foreach from=$xt5100_monthlist.data item=MONTH key=m}
    <h2>{"month"|cat:$m|translate}</h2>
    {foreach from=$MONTH item=EVENT name=list}
    {cycle values="even,odd" assign="rowclass"}
        <div class="xt_evList{$rowclass}">
        <div class="xt_evListday xt_calendar">
         <div class="xt_calM">{$EVENT.from_date|date_format:"%b"|utf8enc}</div>
		 <div class="xt_calDay"><a href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&amp;x{$BASEID}_event_id={$EVENT.id}">{$EVENT.from_date|date_format:"%e"}.</a></div>
	    </div>
        <div class="xt_evListcontent"><a class="xt_evTite" href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&amp;x{$BASEID}_event_id={$EVENT.id}">{$EVENT.title}</a> ({$EVENT.nodetitle})<br />
            {if $EVENT.image>0}{image
                id=$EVENT.image
                version=0
                title=$EVENT.title
                alt=$EVENT.title
                class="left"}{/if}
            <span class="xt_evIntroduction">{$EVENT.introduction}</span>

        </div>
        <br clear="all" />
        </div>
    {/foreach}
{/foreach}
</div>