function switchPermTable(base_id, user_id, index){
    fieldstatus = "x" + base_id + "_status[" + user_id + "][" + index + "]";
    fieldperm = "x" + base_id + "_perms[" + user_id + "][" + index + "]";
    if(document.getElementsByName(fieldperm)[0].value == 0){
        document.getElementsByName(fieldstatus)[0].src = 'images/icons/haken.gif';
        document.getElementsByName(fieldperm)[0].value=1;
    } else {
        document.getElementsByName(fieldstatus)[0].src = 'images/icons/delete_na.gif';
        document.getElementsByName(fieldperm)[0].value=0;
    }
}


function switchPerm(element, field){
    if(document.getElementsByName(field)[0].value == 1){
        document.getElementsByName(field)[0].value = 0;
        element.src = '/images/icons/forbidden_small.png';
    } else {
        document.getElementsByName(field)[0].value = 1;
        element.src = '/images/icons/check_small.png';
    }
}

var inEdit = false;
var oldInner = '';
var oldElement = null;
var oldForm = null;
var elementID = '';
var livemode = '';
var browser = '';


// Browserweiche
if (navigator.userAgent.indexOf("MSIE") > 0){
    browser = 'NETSCAPE';
}
if (navigator.userAgent.indexOf("MSIE") > 0 && navigator.userAgent.indexOf("Opera") < 0){
    browser = 'IE';
}
if (navigator.userAgent.indexOf("Opera") > 0){
    browser = 'OPERA';
}

function inlineEdit(element, form, baseid, element_id, live_mode, size){
    if(!inEdit){
        oldForm = document.forms[form];
        oldElement = element;
        elementID = element_id;
        oldInner = element.innerHTML;
        livemode = live_mode;
        base_id = baseid;
        element.innerHTML='<input onKeyDown=\'handleEnter(event)\' autocomplete=\'off\' size=\'' + size + '\' style="" id=\'tmp_edit\' type=\'text\' value=\'' + element.innerHTML + '\'>';
        form_element = document.getElementById('tmp_edit');
        document.getElementsByName('submit_save')[0].disabled=false;
        if(form_element != null){
            form_element.select();
        }
        inEdit = true;
    }
}

function save(){
    document.getElementsByName('x' + base_id + '_action')[0].value='save';
    document.getElementsByName('x' + base_id + '_live_edit_mode')[0].value = livemode
    document.getElementsByName('x' + base_id + '_live_edit_id')[0].value = elementID;
    document.getElementsByName('x' + base_id + '_live_edit_value')[0].value = document.getElementById('tmp_edit').value;
    oldForm.submit();
}

function handleEnter(event){
    var keyCode = event.keyCode ? event.keyCode : event.which ? event.which : event.charCode;
    if(keyCode == 27){
        oldElement.innerHTML = oldInner;
        oldInnet = '';
        oldElement = null;
        oldForm = null;
        elementID = '';
        livemode = '';
        document.getElementsByName('submit_save')[0].disabled=true;
        inEdit = false;
    }
    if(keyCode == 13){
        save();
    }
}

function ask(question,url){
    if(confirm(question)){
        window.location.href=url;
    }
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

function action(form, baseid, action){
    document.getElementsByName('x' + baseid + '_action')[0].value=action;
    document.forms[form].submit();
}

function action(form, baseid, action, anchor){
    document.getElementsByName('x' + baseid + '_action')[0].value=action;
    if(anchor != 'undefined'){
        document.forms[form].action=document.forms[form].action + '#' + anchor;
    }
    document.forms[form].submit();
}

function showhidePackage(srcfield,dstfield){

    if(browser == 'IE'){
        if(document.getElementsByName(srcfield).src == "images/icons/minus.gif"){
            document.getElementsByName(srcfield).src = "images/icons/plus.gif";

            document.getElementById(dstfield).style.display='block';
            document.getElementById(dstfield).focus();
        }else{
            document.getElementById(dstfield).style.display='none';
        }
    }else{
        if(document.getElementsByName(srcfield).src == "images/icons/minus.gif"){
            document.getElementsByName(srcfield).src = "images/icons/plus.gif";

            document.getElementById(dstfield).style.display='table';
            document.getElementById(dstfield).focus();
        }else{
            document.getElementById(dstfield).style.display='none';
            document.getElementsByName(srcfield).src = "images/icons/plus.gif";
        }
    }
}

function switchDebugger(){
    if(document.getElementById('debugger').style.display != 'none'){
        document.getElementById('debugger').style.display='none';
        document.getElementById('debugger').style.visibility='hidden';
    } else {
        document.getElementById('debugger').style.display='block';
        document.getElementById('debugger').style.visibility='visible';
    }
}

function popup(url,width,height,name){
    // center on screen
    LeftPosition=(screen.width)?(screen.width-width)/2:100;
    TopPosition=(screen.height)?(screen.height-height)/2:100;
    window.open(url,name,'scrollbars=1,width=' + width + ',height=' + height + ',top='+TopPosition+',left='+LeftPosition);
}

function anchor(anchor){
    document.location="#" + anchor;
}

function switchEditor(){
    if(document.getElementById('editor').style.visibility == 'hidden'){
        /* document.getElementById('topwindow').style.height="5px"; */
        document.getElementById('editor').style.display='table-row';
        document.getElementById('editor').style.visibility='visible';
        /* var tmp = document.getElementById('editor').offsetTop-document.getElementById('topwindow').offsetTop;
        document.getElementById('topwindow').style.height=(tmp-80) + "px"; */
    } else {
        document.getElementById('editor').style.display='none';
        document.getElementById('editor').style.visibility='hidden';
        /* document.getElementById('topwindow').style.height=""; */
    }
}

function switchImage(element, element_id, image_a, image_b){
    if(element.checked){
        document.getElementById(element_id).src = '/images/icons/' + image_a;
    } else {
        document.getElementById(element_id).src = '/images/icons/' + image_b;
    }
}

var visibleToolbar = true;
function switchToolbar(){
    if(visibleToolbar){
        document.getElementById('sidebar_icon').src = 'images/icons/window_sidebar_na.png';
        document.getElementById('sidebar').style.display='none';
        visibleToolbar = false;
    } else {
        document.getElementById('sidebar_icon').src = 'images/icons/window_sidebar.png';
        document.getElementById('sidebar').style.display='table-cell';
        visibleToolbar = true;
    }
} 