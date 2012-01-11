{get_param param="height" assign="height"}
{get_param param="width" assign="width"}

 <object classid="CLSID:D27CDB6E-AE6D-11cf-96B8-444553540000" width="{$width}" height="{$height}"
          codebase="http://active.macromedia.com/flash2/cabs/swflash.cab#version=4,0,0,0">
    <param name="movie" value="/video/{$xt240_movie.id}.swf">
    <param name="quality" value="high">
    <param name="scale" value="exactfit">
	{if $xt240_autoplay == true}
  		<param name="autoplay" value="true" />
  	{else}
  		<param name="autoplay" value="false" />
  	{/if}
    <embed src="/video/{$xt240_movie.id}.swf" quality="high" scale="exactfit" menu="false"
           bgcolor="#000000" width="{$width}" height="{$height}" swLiveConnect="false"
           type="application/x-shockwave-flash"
           pluginspage="http://www.macromedia.com/shockwave/download/download.cgi?P1_Prod_Version=ShockwaveFlash">
    </embed>
  </object>