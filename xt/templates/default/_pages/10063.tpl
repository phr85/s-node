{literal}
<script language="JavaScript1.2" type="text/javascript">
var slideshow_width='320px' //SET IMAGE WIDTH
var slideshow_height='60px' //SET IMAGE HEIGHT
var pause=4000 //SET PAUSE BETWEEN SLIDE (3000=3 seconds)
var fadeimages=new Array()
//SET 1) IMAGE PATHS, 2) optional link, 3), optional link target:
fadeimages[0]=["download.php?file_id=549&file_version=5", "", ""]
fadeimages[1]=["download.php?file_id=549&file_version=6", "", ""]
fadeimages[2]=["download.php?file_id=549&file_version=5", "", ""]
fadeimages[3]=["download.php?file_id=549&file_version=7", "", ""]
fadeimages[4]=["download.php?file_id=549&file_version=5", "", ""]
fadeimages[5]=["download.php?file_id=549&file_version=8", "", ""]
fadeimages[6]=["download.php?file_id=549&file_version=5", "", ""]
fadeimages[7]=["download.php?file_id=549&file_version=9", "", ""]
fadeimages[8]=["download.php?file_id=549&file_version=5", "", ""]
fadeimages[9]=["download.php?file_id=549&file_version=10", "", ""]
fadeimages[10]=["download.php?file_id=549&file_version=5", "", ""]
fadeimages[11]=["download.php?file_id=549&file_version=11", "", ""]
fadeimages[12]=["download.php?file_id=549&file_version=5", "", ""]
fadeimages[13]=["download.php?file_id=549&file_version=12", "", ""]

////NO need to edit beyond here/////////////

var preloadedimages=new Array()
for (p=0;p<fadeimages.length;p++){
preloadedimages[p]=new Image()
preloadedimages[p].src=fadeimages[p][0]
}

var ie4=document.all
var dom=document.getElementById

if (ie4||dom)
document.write('<div style="position:relative;width:'+slideshow_width+';height:'+slideshow_height+';overflow:hidden"><div  id="canvas0" style="position:absolute;width:'+slideshow_width+';height:'+slideshow_height+';top:0;left:0;filter:alpha(opacity=10);-moz-opacity:10"></div><div id="canvas1" style="position:absolute;width:'+slideshow_width+';height:'+slideshow_height+';top:0;left:0;filter:alpha(opacity=10);-moz-opacity:10;visibility: hidden"></div></div>')
else
document.write('<img name="defaultslide" src="'+fadeimages[0][0]+'" />')

var curpos=10
var degree=10
var curcanvas="canvas0"
var curimageindex=0
var nextimageindex=1

function fadepic(){
if (curpos<100){
curpos+=10
if (tempobj.filters)
tempobj.filters.alpha.opacity=curpos
else if (tempobj.style.MozOpacity)
tempobj.style.MozOpacity=curpos/101
}
else{
clearInterval(dropslide)
nextcanvas=(curcanvas=="canvas0")? "canvas0" : "canvas1"
tempobj=ie4? eval("document.all."+nextcanvas) : document.getElementById(nextcanvas)
tempobj.innerHTML=insertimage(nextimageindex)
nextimageindex=(nextimageindex<fadeimages.length-1)? nextimageindex+1 : 0
var tempobj2=ie4? eval("document.all."+nextcanvas) : document.getElementById(nextcanvas)
tempobj2.style.visibility="hidden"
setTimeout("rotateimage()",pause)
}
}

function insertimage(i){
var tempcontainer=fadeimages[i][1]!=""? '<a href="'+fadeimages[i][1]+'" target="'+fadeimages[i][2]+'">' : ""
tempcontainer+='<img src="'+fadeimages[i][0]+'" border="0" />'
tempcontainer=fadeimages[i][1]!=""? tempcontainer+'</a>' : tempcontainer
return tempcontainer
}

function rotateimage(){
if (ie4||dom){
resetit(curcanvas)
var crossobj=tempobj=ie4? eval("document.all."+curcanvas) : document.getElementById(curcanvas)
crossobj.style.zIndex++
tempobj.style.visibility="visible"
var temp='setInterval("fadepic()",50)'
dropslide=eval(temp)
curcanvas=(curcanvas=="canvas0")? "canvas1" : "canvas0"
}
else
document.images.defaultslide.src=fadeimages[curimageindex][0]
curimageindex=(curimageindex<fadeimages.length-1)? curimageindex+1 : 0
}
function resetit(what){
curpos=10
var crossobj=ie4? eval("document.all."+what) : document.getElementById(what)
if (crossobj.filters)
crossobj.filters.alpha.opacity=curpos
else if (crossobj.style.MozOpacity)
crossobj.style.MozOpacity=curpos/101
}
function startit(){
var crossobj=ie4? eval("document.all."+curcanvas) : document.getElementById(curcanvas)
crossobj.innerHTML=insertimage(curimageindex)
rotateimage()
}
if (ie4||dom)
window.onload=startit
else
setInterval("rotateimage()",pause)
</script>
{/literal}