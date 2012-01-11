{XT_load_js file="jquery-ui/ui.dialog.js"}{XT_load_js file="jquery-ui/ui.draggable.js"}

<div id="errorbox" title="{$Title}">
    {if $Message}
        <span style="font-style: italic;">
            {$Message}
        </span><br /><br />
    {/if}
    {foreach from=$ERRORS key=KEY item=ERROR}
        {if $LABELS[$KEY] != ""}
            <span style="font-weight: bold;">
                {$LABELS[$KEY]}:
            </span>
        {/if}
        {foreach from=$ERROR item=E}
            {$E}
        {/foreach}<br/>
    {/foreach}
</div>

{literal}
<script type="text/javascript">
    //<![CDATA[
        $(document).ready(function(){
            $("#errorbox").dialog({
                modal:true,overlay:{opacity:0.5,background: "black"}
                {/literal}{$Options}{literal}
            });
        });
    //]]>
</script>
{/literal}