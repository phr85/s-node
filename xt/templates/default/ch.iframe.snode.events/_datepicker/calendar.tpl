<h2><span class="light">{"Date"|translate}</span></h2>
<form name="calendar" id="calendar" method="post">
<table border="0" cellpadding="0" cellspacing="0" width="100%">
    <tr>
        <td class="left">{"Year"|translate}</td>
        <td class="right"><a href="#" onclick="document.getElementById('year').value=parseInt(document.getElementById('year').value)-1;window.opener.document.forms[0].x{$BASEID}_action.value='saveEvent';window.opener.document.forms[0].submit();document.forms[0].submit();"><img src="{$XT_IMAGES}icons/arrow_down.gif" alt="&lt;&lt;" /></a></td>
        <td class="right"><input style="width:100px;" type="text" name="x{$BASEID}_year" value="{$YEAR}" id="year" class="disabled" readonly="yes"></td>
        <td class="right"><a href="#" onclick="document.getElementById('year').value=parseInt(document.getElementById('year').value)+1;window.opener.document.forms[0].x{$BASEID}_action.value='saveEvent';window.opener.document.forms[0].submit();document.forms[0].submit();"><img src="{$XT_IMAGES}icons/arrow_up.gif" alt="&gt;&gt;" /></a></td>
    </tr>
    <tr>
        <td class="left">{"Month"|translate}</td>
        <td class="right">&nbsp;</td>
        <td class="right" colspan="2">
            <select name="x{$BASEID}_month" id="month" onchange="window.opener.document.forms[0].x{$BASEID}_year.value=document.getElementById('year').value;window.opener.document.forms[0].x{$BASEID}_action.value='saveEvent';window.opener.document.forms[0].submit();document.forms[0].submit();" style="width:100px;">
                <option value="1"{if $SELECT_MONTH == 1} selected{/if}>{"January"|translate}</option>
                <option value="2"{if $SELECT_MONTH == 2} selected{/if}>{"February"|translate}</option>
                <option value="3"{if $SELECT_MONTH == 3} selected{/if}>{"March"|translate}</option>
                <option value="4"{if $SELECT_MONTH == 4} selected{/if}>{"April"|translate}</option>
                <option value="5"{if $SELECT_MONTH == 5} selected{/if}>{"May"|translate}</option>
                <option value="6"{if $SELECT_MONTH == 6} selected{/if}>{"June"|translate}</option>
                <option value="7"{if $SELECT_MONTH == 7} selected{/if}>{"July"|translate}</option>
                <option value="8"{if $SELECT_MONTH == 8} selected{/if}>{"August"|translate}</option>
                <option value="9"{if $SELECT_MONTH == 9} selected{/if}>{"Septembers"|translate}</option>
                <option value="10"{if $SELECT_MONTH == 10} selected{/if}>{"Octobers"|translate}</option>
                <option value="11"{if $SELECT_MONTH == 11} selected{/if}>{"November"|translate}</option>
                <option value="12"{if $SELECT_MONTH == 12} selected{/if}>{"Decembers"|translate}</option>
            </select>
        </td>
    </tr>
</table>
<h2><span class="light">{"Calendar"|translate}</span></h2>
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
        <td {if $SELECTED_DAY == $day && $SELECTED_DAY != ""}style="background-color: yellow"{/if} class="date_box{if $smarty.foreach.d.iteration > 5}_marked{/if}">{if $day == ""}&nbsp;{else}<a href="#" onclick="saveDate('{$day}');">{$day}</a>{/if}</td>
        {/foreach}
    </tr>
    {/foreach}
</table>
<!--
<table border="0">
    <td style="vertical-align:middle;">
        <a href="#" onclick="window.opener.document.forms[0].x{$BASEID}_year.value=document.getElementById('year').value;window.opener.document.forms[0].x{$BASEID}_month.value=document.getElementById('month').value;window.opener.document.forms[0].x{$BASEID}_day.value=document.getElementById('day').value;window.close();"><img src="{$XT_IMAGES}icons/check.png" width="16" height="16" /></a>
    </td>
    <td>
        <a href="#" onclick="window.opener.document.forms[0].x{$BASEID}_year.value=document.getElementById('year').value;window.opener.document.forms[0].x{$BASEID}_month.value=document.getElementById('month').value;window.opener.document.forms[0].x{$BASEID}_day.value=document.getElementById('day').value;window.close();">&nbsp;{"Select"|translate}</a>
    </td>
</table>
-->
</form>
{literal}
<script language="javascript" type="text/javascript">
function saveDate(day) {
    window.opener.document.forms[0].x{/literal}{$BASEID}{literal}_action.value='saveEvent';
    window.opener.document.forms[0].x{/literal}{$BASEID}{literal}_year.value = document.getElementById('year').value;
    window.opener.document.forms[0].x{/literal}{$BASEID}{literal}_month.value=document.getElementById('month').value;
    window.opener.document.forms[0].x{/literal}{$BASEID}{literal}_day.value=day;
    window.opener.document.forms[0].submit();window.close();
}

</script>
{/literal}