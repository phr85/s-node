 <tr>
  <td class="view_header" colspan="2">
   <span class="title"> {"Trackbacks"|translate}<a name="additionalProperties">&nbsp;</a></span>
  </td>
 </tr>
 <tr>
 	<td class="left" >{"Add trackbacks"|translate}</td>
 	<td class="right">
	 	{"Separate multiple URIs with spaces"|translate}<br/>
	 	<input type="text" name="x{$BASEID}_XT_TB_send" value="" size="52" /><br/>
 	</td>
 </tr>
 <tr>
 	<td class="left" >{"Trackback title"|translate}</td>
 	<td class="right">
	 	<input type="text" name="x{$BASEID}_XT_TB_title" value="{$title}" size="52" /><br/>
 	</td>
 </tr>
  <tr>
 	<td class="left" >{"Trackback excerpt"|translate}</td>
 	<td class="right">
 	<textarea id="x{$BASEID}_XT_TB_excerpt" name="x{$BASEID}_XT_TB_excerpt" rows="4" cols="65">{$excerpt}</textarea>
 	</td>
 </tr>
 <tr>
 	<td class="left" >{"Source URL"|translate}</td>
 	<td class="right">
 		<input type="text" name="x{$BASEID}_XT_TB_source_url" size="72" value="{$url}" />
 	</td>
 </tr>
 {xt_get_trackback url="$url" assign="PINGED_TRACKBACKS"}
 <tr>
 	<td class="left" >{"Already pinged"|translate}</td>
 	<td class="right">
 		{foreach from=$PINGED_TRACKBACKS item="PT"}
 		{$PT.date|date_format:"%d.%m.%Y %H:%M"}:
 		{$PT.target_url}<br/>
 		{/foreach}
 	</td>
 </tr>
 <input type="hidden" name="x{$BASEID}_XT_autoaction[]" value="ch.iframe.snode.blog.sendTrackBack" />