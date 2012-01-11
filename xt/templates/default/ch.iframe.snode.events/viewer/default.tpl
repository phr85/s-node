{get_param param="registration_tpl" assign="registration_tpl"}
{xt_getaddresses id=$EVENT.address assign="addressEvent"}

{assign var="startdate" value=$EVENT.from_date|date_format:"%d %b %Y"|utf8enc}
{assign var="enddate" value=$EVENT.end_date|date_format:"%d %b %Y"|utf8enc}

<h1>{$EVENT.title}</h1>
<br />
{if $startdate == $enddate}
    {if $EVENT.set_start_date_only}
        {$EVENT.from_date|date_format:"%d.%m.%Y"|utf8enc}
    {else}
        {"duration"|livetranslate}: {$EVENT.from_date|date_format:"%d.%m.%Y (%H:%M"|utf8enc} - {$EVENT.end_date|date_format:"%H:%M)"|utf8enc}</span><br />
    {/if}
{else}
    {if $EVENT.set_start_date_only}
        <table>
            <tr>
                <td>
                    {"from"|livetranslate}: 
                </td>
                <td>
                    {$EVENT.from_date|date_format:" %d.%m.%Y"|utf8enc}
                </td>
            </tr>
            <tr>
                <td>
                    {"to"|livetranslate}:
                </td>
                <td>
                    {$EVENT.end_date|date_format:" %d.%m.%Y"|utf8enc}
                </td>
            </tr>
        </table>
    {else}
        <table>
            <tr>
                <td>
                    {"from"|livetranslate}: 
                </td>
                <td>
                    {$EVENT.from_date|date_format:" %d.%m.%Y %H:%M"|utf8enc}
                </td>
            </tr>
            <tr>
                <td>
                    {"to"|livetranslate}:
                </td>
                <td>
                    {$EVENT.end_date|date_format:" %d.%m.%Y %H:%M"|utf8enc}
                </td>
            </tr>
        </table>
    {/if}
{/if}
<br />
{if $EVENT.introduction != ''}
<b>{"Beschreibung"|livetranslate}</b><br />
<span class="introduction">{$EVENT.introduction}</span><br />{/if}
{if $EVENT.image > 0}{if $EVENT.image_zoom == 1}<a href="javascript:popup('{$smarty.server.PHP_SELF}?TPL={$IMAGE_POPUP_TPL}&amp;x{$FILEMANAGER_BASEID}_file_id={$EVENT.image}');">{else}{if $EVENT.image_link != ''}<a target="{$EVENT.image_link_target}" href="{$EVENT.image_link}">{/if}{/if}
{if $EVENT.image_type == 2}
<div class="left">
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$EVENT.width height=$EVENT.height}">
<param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$EVENT.image}" />
<param name="quality" value="high" />
<embed src="{$XT_WEB_ROOT}download.php?file_id={$EVENT.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$EVENT.width height=$EVENT.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
</object>
</div>
{else}{image
    id=$EVENT.image
    version=3
    title=$EVENT.title
    alt=$EVENT.title
    class="left"
}{/if}{if $EVENT.image_zoom == 1 || $EVENT.image_link != ''}</a>{/if}{/if}
{if $EVENT.maintext != ''}{$EVENT.maintext}{/if}
{if $EVENT.link !=""}<br /><a href="{$EVENT.link}"{if $EVENT.link_external > 0} target="_blank"{/if}>External link</a>{/if}
{if $EVENT.registertpl != "" && ($EVENT.reg_visitors < $EVENT.max_visitors || $EVENT.max_visitors == 0)}<br /><br /><a href="{$smarty.server.PHP_SELF}?TPL={$registration_tpl}&amp;x{$BASEID}_event_id={$EVENT.id}&amp;x{$BASEID}_style={$EVENT.registertpl}">{"Register"|translate}</a>{/if}
<br />
<br />
{if $addressEvent != ""}<p><b>{"adresse"|livetranslate}:</b></p>{/if}
{if $addressEvent.title != ""} {$addressEvent.title}<br />{/if}
{if $addressEvent.street != ""} {$addressEvent.street}<br />{/if}
{if $addressEvent.postalCode != ""} {$addressEvent.postalCode} {if $addressEvent.city != ""}{$addressEvent.city} {/if}<br />{/if}
<br />
<a href="/ajax.php?package=ch.iframe.snode.events&amp;module=ics&amp;param_id={$EVENT.id}">{"add to calendar"|livetranslate}</a><br />