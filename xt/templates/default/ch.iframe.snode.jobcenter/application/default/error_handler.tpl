{XT_load_js file="jquery-ui/ui.dialog.js"}
{XT_load_js file="jquery-ui/ui.draggable.js"}

<div id="errorbox" title="{$TITLE}">
    {if $MESSAGE}
        <div style="clear: both; float: left; width: 100%; padding-bottom: 15px; font-style: italic;">
            {$MESSAGE}
        </div>
    {/if}
    {foreach from=$xt1700_application.form.errors key=LABEL item=ERRORS}
        <div style="clear: both; float: left; width: 100%;">
            <div style="clear: both; float: left; width: 180px; padding-right: 20px; font-weight: bold;">
                {$LABEL|translate}:
            </div>
            <div style="float: left;">
                {foreach from=$ERRORS key=ERRORTYPE item=ERROR}
                    {if $ERRORTYPE == "invalid"}
                        {"Please check your input"|translate}
                    {elseif $ERRORTYPE == "empty"}
                        {"Field must be filled"|translate}
                    {else}
                        {$ERROR|translate}
                    {/if}
                    <br />
                {/foreach}
            </div>
        </div>
    {/foreach}
</div>

{literal}
<script type="text/javascript">
    //<![CDATA[
        $(document).ready(function(){
            $("#errorbox").dialog({
                modal:true,overlay:{opacity:0.5,background: "black"}{/literal}{$Options}{literal}
            });
        });
    //]]>
</script>
{/literal}