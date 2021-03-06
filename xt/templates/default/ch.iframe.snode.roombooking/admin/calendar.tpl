<h2>{$SETTEDDATE|date_format}</h2>
<form name="calendar" method="post" action="">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td class="left_small">{"Year"|translate}</td>
        <td class="right_small">
        <select name="x{$BASEID}_year" id="year" onchange="calcDate();">
        <option value="{$YEAR-2}">{$YEAR-2}</option>
        <option value="{$YEAR-1}">{$YEAR-1}</option>
        <option value="{$YEAR}" selected>{$YEAR}</option>
        <option value="{$YEAR+1}">{$YEAR+1}</option>
        <option value="{$YEAR+2}">{$YEAR+2}</option>
        </select>
    </tr>
    <tr>
        <td class="left_small">{"Month"|translate}</td>
        <td class="right_small">
            <select name="x{$BASEID}_month" id="month" onchange="calcDate();">
                <option value="1"{if $MONTH == 1} selected{/if}>{"January"|translate}</option>
                <option value="2"{if $MONTH == 2} selected{/if}>{"February"|translate}</option>
                <option value="3"{if $MONTH == 3} selected{/if}>{"March"|translate}</option>
                <option value="4"{if $MONTH == 4} selected{/if}>{"April"|translate}</option>
                <option value="5"{if $MONTH == 5} selected{/if}>{"May"|translate}</option>
                <option value="6"{if $MONTH == 6} selected{/if}>{"June"|translate}</option>
                <option value="7"{if $MONTH == 7} selected{/if}>{"July"|translate}</option>
                <option value="8"{if $MONTH == 8} selected{/if}>{"August"|translate}</option>
                <option value="9"{if $MONTH == 9} selected{/if}>{"September"|translate}</option>
                <option value="10"{if $MONTH == 10} selected{/if}>{"October"|translate}</option>
                <option value="11"{if $MONTH == 11} selected{/if}>{"November"|translate}</option>
                <option value="12"{if $MONTH == 12} selected{/if}>{"December"|translate}</option>
            </select>
        </td>
    </tr>
</table>

<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td class="date_title">{"Mo"|translate}</td>
        <td class="date_title">{"Tu"|translate}</td>
        <td class="date_title">{"We"|translate}</td>
        <td class="date_title">{"Th"|translate}</td>
        <td class="date_title">{"Fr"|translate}</td>
        <td class="date_title">{"Sa"|translate}</td>
        <td class="date_title">{"Su"|translate}</td>
    </tr>
    {foreach from=$DAYS item=DAY}
    <tr>
        {foreach from=$DAY item=day name=d}
        <td {if $SELECTED_DAY == $day}style="background-color: yellow"{/if} 
        class="date_box{if $smarty.foreach.d.iteration > 5}_marked{/if}" onclick="document.getElementById('day').value='{$day}'; calcDate('');">
        {if $day == ""}&nbsp;{else}
        <a href="#" onclick="document.getElementById('day').value='{$day}'; calcDate('');">{$day}</a>{/if}
        <sub>{$BOOKEDDAYS[$day]}</sub>
        </td>
        {/foreach}
    </tr>
    {/foreach}
</table>
<br />&nbsp;
<!-- actionIcon
action="updateDate"
icon="check.png"
title="select"
label="select"
form="calendar"
-->

{actionIcon
action="goToToday"
icon="star_yellow.png"
title="go to today"
label="go to today"
form="calendar"}
<br />&nbsp;
{actionIcon
action="goToOverview"
icon="table.png"
title="Overview"
label="overview"
target="slave1"
form=0}

<input type="hidden" name="x{$BASEID}_date" value="" id="date" />
<input type="hidden" name="x{$BASEID}_day" value="" id="day" />
<input type="hidden" name="x{$BASEID}_use_date" value="{$USE_DATE}" id="use_date" />
<input type="hidden" name="x{$BASEID}_use_date_str" value="{$USE_DATE_STR}" id="use_date_str" />
{include file="ch.iframe.snode.roombooking/admin/hiddenValues.tpl"}
</form>

{literal}
<script language="javascript" type="text/javascript">
function calcDate(){
    var humDate = new Date(Date.UTC(document.getElementById('year').value,
          (document.getElementById('month').value-1),
          document.getElementById('day').value,
          0,
          0,
          0));
          document.getElementById('date').value = (humDate.getTime()/1000.0);
   document.forms[0].submit();
}

if(window.parent.frames['slave1'].document.forms[0].autorefresh){
    {/literal}
    {if $NEWDATE > 0}     
    window.parent.frames['slave1'].document.forms[0].submit();
    {/if}
    {literal}
}
</script>
{/literal}