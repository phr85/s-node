// Browserweiche
var browser = '';
if (navigator.userAgent.indexOf("MSIE") > 0){
    browser = 'NETSCAPE';
}
if (navigator.userAgent.indexOf("MSIE") > 0 && navigator.userAgent.indexOf("Opera") < 0){
    browser = 'IE';
}
if (navigator.userAgent.indexOf("Opera") > 0){
    browser = 'OPERA';
}

function load(){
    var mybody = document.body;
    var main_table = mybody.getElementsByTagName("TABLE").item(0);
    main_table.style.width = "500px";
}

function popup(url,width,height,name){
    // center on screen
    LeftPosition=(screen.width)?(screen.width-width)/2:100;
    TopPosition=(screen.height)?(screen.height-height)/2:100;

    window.open(url,name,'scrollbars=1,width=' + width + ',height=' + height + ',top='+TopPosition+',left='+LeftPosition);
}

function addListener(element, type, expression, bubbling){
    bubbling = bubbling || false;
    if(window.addEventListener) { // Standard
        element.addEventListener(type, expression, bubbling);
        return true;
    } else if(window.attachEvent) { // IE
        element.attachEvent('on' + type, expression);
        return true;
    } else return false;
}

// useage: addListener(window, 'load', myFunction);

// functions to handle cookies
function createCookie(name,value,days) {
    if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toGMTString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
}

function readCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}

function eraseCookie(name) {
    createCookie(name,"",-1);
}
function ismaxlength(obj){
    var mlength=obj.getAttribute? parseInt(obj.getAttribute("maxlength")) : ""
    if (obj.getAttribute && obj.value.length>mlength)
    obj.value=obj.value.substring(0,mlength)
}

function showhideCheckbox(srcfield,dstfield){

    if(browser == 'IE'){
        if(document.getElementsByName(srcfield)[0].checked){
            document.getElementById(dstfield).style.display='block';
        }else{
            document.getElementById(dstfield).style.display='none';
        }
    }else{
        if(document.getElementsByName(srcfield)[0].checked){
            document.getElementById(dstfield).style.display='table-row';
        }else{
            document.getElementById(dstfield).style.display='none';
        }
    }
}

function trim (zeichenkette) {
    // Erst führende, dann Abschließende Whitespaces entfernen
    // und das Ergebnis dieser Operationen zurückliefern
    return zeichenkette.replace (/^\s+/, '').replace (/\s+$/, '');
}

// Element anhand von checkbox ein oder ausblenden
function toggleDivByCheckbox(thecheckbox,thediv){
        //Hide div w/id extra
       $(thediv).css("display","none");
        // If checked
        if ($(thecheckbox).is(":checked"))
        {
            //show the hidden div
            $(thediv).show("fast");
        }
        else
        {
            //otherwise, hide it
            $(thediv).hide("fast");
        }
}