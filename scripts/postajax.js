// http://www.captain.at/howto-ajax-form-post-get.php
// ajaxPost [POST] form data to target
// ajaxGet  [GET] form data to target
// ajaxUrl  request an URL to target
// ajaxImage loads an image to target

var http_request = false;
var target
var loadstatustext="<img src='/images/ajax-loader.gif' /> Requesting content..."

var tmp = new Array();
var isloading = new Array();

var refreshobj = new Array();
var http_request = new Array();
refreshobj["master1"] = new Object();
refreshobj["master1"][0]='child1';
refreshobj["master1"][1]='child2';


var i
for (i in refreshobj["master1"]) {
    //alert(refreshobj["master1"][i]);
}


function ajaxImage(url, target, alt) {
    document.getElementById(target).innerHTML = '<img src="' + url +'" alt="' + alt +'" title="'+ alt +'" />';
}

function ajaxPost(obj,targetdiv) {
    
    var poststr ='';

    for (i=0; i<obj.childNodes.length; i++) {
        if (obj.childNodes[i].tagName == "INPUT") {
            if (obj.childNodes[i].type == "text") {
                poststr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
            }
            if (obj.childNodes[i].type == "checkbox") {
                if (obj.childNodes[i].checked) {
                    poststr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
                } else {
                    poststr += obj.childNodes[i].name + "=&";
                }
            }
            if (obj.childNodes[i].type == "radio") {
                if (obj.childNodes[i].checked) {
                    poststr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
                }
            }
            if (obj.childNodes[i].type == "hidden") {
                poststr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
            }
        }

        if (obj.childNodes[i].tagName == "TEXTAREA") {
            poststr += obj.childNodes[i].name + "=" + encodeURI(obj.childNodes[i].value) + "&";
        }
        if (obj.childNodes[i].tagName == "SELECT") {
            var sel = obj.childNodes[i];
            poststr += sel.name + "=" + sel.options[sel.selectedIndex].value + "&";
        }
    }
    document.getElementById(targetdiv).innerHTML = loadstatustext;
    makePOSTRequest('ajax.php',targetdiv, poststr);
}

function ajaxGet(obj,targetdiv) {
    var getstr = "?";
    for (i=0; i<obj.childNodes.length; i++) {
        if (obj.childNodes[i].tagName == "INPUT") {
            if (obj.childNodes[i].type == "text") {
                getstr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
            }
            if (obj.childNodes[i].type == "checkbox") {
                if (obj.childNodes[i].checked) {
                    getstr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
                } else {
                    getstr += obj.childNodes[i].name + "=&";
                }
            }
            if (obj.childNodes[i].type == "radio") {
                if (obj.childNodes[i].checked) {
                    getstr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
                }
            }
            if (obj.childNodes[i].type == "hidden") {
                getstr += obj.childNodes[i].name + "=" + obj.childNodes[i].value + "&";
            }

        }
        if (obj.childNodes[i].tagName == "SELECT") {
            var sel = obj.childNodes[i];
            getstr += sel.name + "=" + sel.options[sel.selectedIndex].value + "&";
        }
    }
    document.getElementById(targetdiv).innerHTML = loadstatustext;
    makeRequest('ajax.php', targetdiv, getstr);
}
function ajaxUrl(url, targetdiv) {
    document.getElementById(targetdiv).innerHTML = loadstatustext;
    http_request[targetdiv] = false;
    if (window.XMLHttpRequest) { // Mozilla, Safari,...
        http_request[targetdiv] = new XMLHttpRequest();
        if (http_request[targetdiv].overrideMimeType) {
            // set type accordingly to anticipated content type
            //http_request[targetdiv].overrideMimeType('text/xml');
            http_request[targetdiv].overrideMimeType('text/html');
        }
    } else if (window.ActiveXObject) { // IE
        try {
            http_request[targetdiv] = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                http_request[targetdiv] = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
        }
    }
    if (!http_request[targetdiv]) {
        alert('Cannot create XMLHTTP instance');
        return false;
    }

    http_request[targetdiv].onreadystatechange = function() {
        alertContents(targetdiv);
    };

    //http_request[targetdiv].onreadystatechange = alertContents;
    http_request[targetdiv].open('GET', url , true);
    http_request[targetdiv].setRequestHeader('If-Modified-Since', 'Sat, 1 Jan 2000 00:00:00 GMT');
    http_request[targetdiv].send(null);
}

function ajaxReturnUrl(url, targetdiv) {
	isloading[targetdiv] = true;	
    http_request[targetdiv] = false;
    if (window.XMLHttpRequest) { // Mozilla, Safari,...
        http_request[targetdiv] = new XMLHttpRequest();
        if (http_request[targetdiv].overrideMimeType) {
            // set type accordingly to anticipated content type
            //http_request[targetdiv].overrideMimeType('text/xml');
            http_request[targetdiv].overrideMimeType('text/html');
        }
    } else if (window.ActiveXObject) { // IE
        try {
            http_request[targetdiv] = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                http_request[targetdiv] = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
        }
    }
    if (!http_request[targetdiv]) {
        alert('Cannot create XMLHTTP instance');
        return false;
    }

    http_request[targetdiv].onreadystatechange = function() {
        saveContents(targetdiv);
    };

    //http_request[targetdiv].onreadystatechange = alertContents;
    http_request[targetdiv].open('GET', url , true);
    http_request[targetdiv].setRequestHeader('If-Modified-Since', 'Sat, 1 Jan 2000 00:00:00 GMT');
    http_request[targetdiv].send(null);
}


function alertContents(targetdiv) {
    if (http_request[targetdiv].readyState == 4) {
        if (http_request[targetdiv].status == 200) {
            //alert(http_request[targetdiv].responseText);
            result = http_request[targetdiv].responseText;
            document.getElementById(targetdiv).innerHTML = result;
        } else {
            alert('There was a problem with the request.');
        }
    }
}

function saveContents(targetdiv) {
    if (http_request[targetdiv].readyState == 4) {
        if (http_request[targetdiv].status == 200) {
            
            result = http_request[targetdiv].responseText;
            tmp[targetdiv] = result;
        } else {
            alert('There was a problem with the request.');
        }
        isloading[targetdiv] = false;
    }
}

function getContent(targetdiv){
	return tmp[targetdiv];
}

function makePOSTRequest(url, targetdiv, parameters ) {
    
    if (window.XMLHttpRequest) { // Mozilla, Safari,...
        http_request[targetdiv] = new XMLHttpRequest();
        if (http_request[targetdiv].overrideMimeType) {
            // set type accordingly to anticipated content type
            //http_request[targetdiv].overrideMimeType('text/xml');
            http_request[targetdiv].overrideMimeType('text/html');
        }
    } else if (window.ActiveXObject) { // IE
        try {
            http_request[targetdiv] = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                http_request[targetdiv] = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
        }
    }

    if (!http_request[targetdiv]) {
        alert('Cannot create XMLHTTP instance');
        return false;
    }

    http_request[targetdiv].onreadystatechange = function() {
        alertContents(targetdiv);
    };

    http_request[targetdiv].open('POST', url, true);
    http_request[targetdiv].setRequestHeader('If-Modified-Since', 'Sat, 1 Jan 2000 00:00:00 GMT');
    http_request[targetdiv].setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    http_request[targetdiv].setRequestHeader("Content-length", parameters.length);
    http_request[targetdiv].setRequestHeader("Connection", "close");
    http_request[targetdiv].send(parameters);

}


function makeRequest(url, targetdiv, parameter ) {
    http_request[targetdiv] = false;
    if (window.XMLHttpRequest) { // Mozilla, Safari,...
        http_request[targetdiv] = new XMLHttpRequest();
        if (http_request[targetdiv].overrideMimeType) {
            // set type accordingly to anticipated content type
            //http_request[targetdiv].overrideMimeType('text/xml');
            http_request[targetdiv].overrideMimeType('text/html');
        }
    } else if (window.ActiveXObject) { // IE
        try {
            http_request[targetdiv] = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            try {
                http_request[targetdiv] = new ActiveXObject("Microsoft.XMLHTTP");
            } catch (e) {}
        }
    }
    if (!http_request[targetdiv]) {
        alert('Cannot create XMLHTTP instance');
        return false;
    }
    http_request[targetdiv].onreadystatechange = function() {
        alertContents(targetdiv);
    };
    http_request[targetdiv].open('GET', url + parameter, true);
    http_request[targetdiv].setRequestHeader('If-Modified-Since', 'Sat, 1 Jan 2000 00:00:00 GMT');
    http_request[targetdiv].send(null);
}

