<br><b>Random image fader</b> Folder: <b>{$FOLDER}</b> - Show description: <b>{$SHOW_DESC}</b> - Show Details: <b>{$SHOW_DETAILS}</b><br><br>
{foreach from=$PICTURES item=PIC name=P}
    <div id="image{$smarty.foreach.P.iteration}" style="filter: alpha(opacity=0); -moz-opacity:0; visibility: hidden; display: none;">
    <table cellpadding="0" cellspacing="0" style="border: 1px solid black;">
     <tr>
      <td><img src="{$PIC_DIR}{$PIC.id}" alt="{$PIC.title}" title="{$PIC.title}"></td>
     </tr>
     {if $SHOW_DESC == 1}
     <tr>
      <td style="padding: 5px;background-color: #BBBBBB;">{$PIC.description}&nbsp;</td>
     </tr>
     {/if}
     {if $SHOW_DETAILS == 1}
     <tr>
      <td style="padding: 5px;background-color: #CCCCCC; border-top: 1px dotted #999999;">{"Original filename"|translate}: {$PIC.title}</td>
     </tr>
     <tr>
      <td style="padding: 5px;background-color: #CCCCCC; border-top: 1px dotted #999999;">{"Original resolution"|translate}: {$PIC.width} x {$PIC.height}</td>
     </tr>
     <tr>
      <td style="padding: 5px;background-color: #CCCCCC; border-top: 1px dotted #999999;">{"Original filesize"|translate}: {$PIC.filesize/1000} KB</td>
     </tr>
     {/if}
    </table>
    </div>
{/foreach}
{literal}
<script type="text/javascript"><!--

var active = 1;
var count = 0;
var _fade_in = true;
var img_count = 1;
var objref;

function tickFade(){
    if(document.getElementById('image' + (img_count-1)) != null){
       document.getElementById('image' + (img_count-1)).style.visibility = 'hidden'; 
       document.getElementById('image' + (img_count-1)).style.display = 'none';
    }
    objref = document.getElementById('image' + img_count);
    document.getElementById('image' + img_count).style.visibility = 'visible';
    document.getElementById('image' + img_count).style.display = 'block';
    
    if(typeof objref.style.opacity != 'undefined'){
        if(objref.style.opacity < 1.0 && _fade_in){
            objref.style.opacity = count/50;
            count++;
        } else {
            _fade_in = false;
        }
        if(objref.style.opacity > 0 && !_fade_in){
            _fade_in = false;
            objref.style.opacity = count/50;
            count--;
        } else {
            if(!_fade_in){
                img_count++;
                _fade_in = true;
            }
        }
    } else {
        
        var existingFilters = "";
        if(objref.style.filter){
            existingFilters = objref.style.filter + " ";
        }
        if(objref.filters.alpha.opacity < 100 && _fade_in){
            objref.style.filter = existingFilters + "alpha(opacity=" + count + ")";
            objref.filters.alpha.opacity = count;
            count++;
        } else {
            _fade_in = false;
        }
        if(objref.filters.alpha.opacity > 0 && !_fade_in){
            _fade_in = false;
            objref.style.filter = existingFilters + "alpha(opacity=" + count + ")";
            objref.filters.alpha.opacity = count;
            count--;
        } else {
            if(!_fade_in){
                img_count++;
                _fade_in = true;
            }
        }
    }
}

setInterval(function(){ tickFade(); },70);

// alpha(opacity=90);
//-->
</script>
{/literal}