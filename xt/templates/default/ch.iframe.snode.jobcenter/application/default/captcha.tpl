<img
    src="/captcha_image.php?name=application_{$FIELD.label}&amp;time={$TIME*1000}"
    id="application_{$FIELD.label}_image"
    class="application_captcha_image"
    alt=""
/>
<br />
<input
    type="text"
    value="{if $FIELD.default != ""}{$FIELD.default}{/if}"
    id="application_{$FIELD.label}"
    {if $ERRORS|@count > 0}class="application_error"{/if}
    name="application[{$FIELD.label}]"
    size="{if $FIELD.size}{$FIELD.size}{else}20{/if}"
/>
<br />
<a href="#"
   rel="application_{$FIELD.label}"
   class="reload_captcha"
>
    {"reload captcha"|livetranslate}
</a>

{literal}
<script type="text/javascript" >
    //<![CDATA[
        $(document).ready(function(){
            $('.reload_captcha').click(function(){
                date = new Date();
                now = date.getTime();
                input_id = $(this).attr('rel');
                image_id = input_id + '_image';
                image_url = '/captcha_image.php?name=' + input_id + '&time=' + now;
                $('#' + image_id).attr('src', image_url);
                return false;
            });
        });
    //]]>
</script>
{/literal}