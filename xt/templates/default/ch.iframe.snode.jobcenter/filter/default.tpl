{XT_load_css file="ch.iframe.snode.jobcenter.css"}
{XT_load_js file="ch.iframe.snode.jobcenter/filter.js"}

<h1>{"Jobs"|livetranslate}</h1>
<br />
<form method="post" action="">
    <div id="jobfilterwrapper">
        <div class="jobfilterelementwrapper">
            <h2>{"Category"|livetranslate}</h2>
            <select name="x{$BASEID}_categories">
                <option value="{$xt1700_filter.default_values.categories}">{"display all"|translate}</option>
                {foreach from=$xt1700_filter.data.categories key=CATKEY item=CAT}
                    <option value="{$CATKEY}" {if $CAT.selected}selected="selected"{/if}>{$CAT.title}</option>
                {/foreach}
            </select>
        </div>
        <div class="jobfilterelementwrapper">
            <h2>{"Location"|livetranslate}</h2>
            <select name="x{$BASEID}_cities">
                <option value="{$xt1700_filter.default_values.cities}">{"display all"|translate}</option>
                {foreach from=$xt1700_filter.data.cities key=CITYKEY item=CITY}
                    <option value="{$CITYKEY}" {if $CITY.selected}selected="selected"{/if}>{$CITY.title}</option>
                {/foreach}
            </select>
        </div>
    </div>
    <br class="clear" />
</form>
