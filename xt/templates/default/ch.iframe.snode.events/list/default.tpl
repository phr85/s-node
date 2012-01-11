{XT_load_css file="events.css"}
{XT_load_css file="calendar.css"}
<div class="xt_event">
{foreach from=$xt5100_list.data item=EVENT}
    <div class="xt_evListitem">
    <div class="xt_evListday xt_calendar">
         <div class="xt_calM">{$EVENT.from_date|date_format:"%b"|utf8enc}</div>
		 <div class="xt_calDay">{if $EVENT.maintext != ""}<a href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&amp;x{$BASEID}_event_id={$EVENT.id}">{else}
	 	<a href="{$EVENT.link}">{/if}{$EVENT.from_date|date_format:"%e"}.</a></div>
	    </div>
    	 {if $EVENT.maintext != ""}
		<a class="xt_evTite" href="{$smarty.server.PHP_SELF}?TPL={get_param param='details_tpl'}&amp;x{$BASEID}_event_id={$EVENT.id}">{$EVENT.title}</a>
	 {else}
	 	<a class="xt_evTite" href="{$EVENT.link}">{$EVENT.title}</a>
	 {/if}<br />
       ({$EVENT.nodetitle})
	{if $EVENT.image_type == 2}
	            <div class="left">
	            <object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=5,0,0,0" width="200" height="{math equation=200/(width/height) width=$EVENT.width height=$EVENT.height}">
	            <param name="movie" value="{$XT_WEB_ROOT}download.php?file_id={$EVENT.image}" />
	            <param name="quality" value="high" />
	            <embed src="{$XT_WEB_ROOT}download.php?file_id={$EVENT.image}" quality="high" width="200" height="{math equation=200/(width/height) width=$EVENT.width height=$EVENT.height}" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" /></embed>
	            </object>
	            </div>
	 {else}
		 {image id=$EVENT.image version=1 title=$EVENT.title alt=$EVENT.title class="left"}
      {/if}

     <span class="xt_evIntroduction">{$EVENT.introduction}</span>
     <br clear="all" />
     </div>
{/foreach}
</div>