{XT_load_js file="jquery-ui/ui.datepicker.js"}

{assign var="THIS_YEAR" value=$TIME|date_format:"%Y"}

<input
      type="text"
      value="{if $xt1700_application.form.fillout}{$xt1700_application.form.fillout[$FIELD.label]}{elseif $FIELD.default != ""}{$FIELD.default}{/if}"
      id="application_{$FIELD.label}"
      {if $ERRORS|@count > 0}class="application_error"{/if}
      name="application[{$FIELD.label}]"
      size="{if $FIELD.size}{$FIELD.size}{else}20{/if}"
/>

<script type="text/javascript">
    //<![CDATA[
        {literal}
            $(document).ready(function(){
                $('{/literal}#application_{$FIELD.label}{literal}').datepicker({
                    clickInput:true,
                    firstDay: 1,
                    showWeeks: true,
                    dateFormat: 'dd.mm.yy',
                    monthNames: ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'],
                    dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag','Sonntag'],
                    dayNamesShort: ['So','Mo','Di','Mi','Do','Fr','Sa'],
                    dayNamesMin: ['So','Mo','Di','Mi','Do','Fr','Sa'],
                    yearRange: '{/literal}{$THIS_YEAR-100}:{$THIS_YEAR+10}{literal}'
                });
            });
        {/literal}
    //]]>
</script>