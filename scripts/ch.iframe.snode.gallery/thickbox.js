function thickboxgalleryinit (galleryid){
    
    galleryid = parseInt(galleryid);
    
    // Die Diashow starten/stoppen
    if(galleries[galleryid]['diashow'] === true) {
        thickboxgallerystartdiashow(galleryid);
    }
    else {
        thickboxgallerystopdiashow(galleryid);
    }
    
    // Start und Stopp Button
    $('#thickboxgallery_' + galleryid + ' .thickboxgallerybigimagewrapper').hover(
        function() {
            if(galleries[galleryid]['diashow'] === true) {
                $('#thickboxgallery_' + galleryid + ' .thickboxgallerybigimagewrapper').append('<a class="thickboxgallerystartstopbutton" onclick="thickboxgallerystopdiashow(' + galleryid + '); return false;" href="" style="background-image: url(/images/ch.iframe.snode.gallery/stop-icon.png);"></a>');
            }
            else {
                $('#thickboxgallery_' + galleryid + ' .thickboxgallerybigimagewrapper').append('<a class="thickboxgallerystartstopbutton" onclick="thickboxgallerystartdiashow(' + galleryid + '); return false;" href="" style="background-image: url(/images/ch.iframe.snode.gallery/start-icon.png);"></a>');
            }
        },
        function() {
            $('#thickboxgallery_' + galleryid + ' .thickboxgallerystartstopbutton').remove();
        }
    );
    
    // Den Scroller starten
    $('#thickboxgallery_' + galleryid + ' .scroll-pane').jScrollHorizontalPane({
        scrollbarHeight: 12,
        animateTo: true
    });
    
    // Die Bildflaeche unten pausiert die Diashow
    $('#thickboxgallery_' + galleryid + ' .thickboxgalleryscrollerwrapper').hover(
        function () {
            thickboxgallerystopdiashow(galleryid);
        },
        function () {
            thickboxgallerystartdiashow(galleryid);
        }
    );
}

function thickboxgalleryimagechange (galleryid, activeimage, directclick) {

    galleryid = parseInt(galleryid);
    activeimage = parseInt(activeimage);
    
    /*
    
    // Fals das Bild direkt gewaehlt wurde Diashow stoppen
    if(directclick === true) {
        thickboxgallerystopdiashow(galleryid);
    }
    
    */
    
    // Schluessel des neuen Bildes zuweisen
    galleries[galleryid]['activeimage'] = activeimage;
    
    // Bildpfad
    var url = '/download.php?file_id=' + galleries[galleryid]['images'][activeimage]['id'] + '&file_version=' + galleries[galleryid]['imageversion'];
    
    // Bildobjekt anlegen
    img = new Image();
    
    // Nach dem laden des Bildes ausfuehren
    $(img).load(function () {
        // Bildtext aktualisieren
        $('#thickboxgallery_' + galleryid + ' .thickboxgalleryimagetitle').html(
            galleries[galleryid]['images'][activeimage]['title']
        );
        $('#thickboxgallery_' + galleryid + ' .thickboxgalleryimagedescription').html(
            galleries[galleryid]['images'][activeimage]['description']
        );
        if(parseInt(galleries[galleryid]['images'][activeimage]['manual_date']) > 0) {
            $('#thickboxgallery_' + galleryid + ' .thickboxgalleryimagedate').html(thickboxgallerypreparedate(galleries[galleryid]['images'][activeimage]['manual_date']));
        }
        
        // Bild aktualisieren
        $('#thickboxgallery_' + galleryid + ' .' + galleries[galleryid]['inactiveelement'] + ' img').attr('src', url);
        $('#thickboxgallery_' + galleryid + ' .' + galleries[galleryid]['activeelement']).fadeOut(fade_time+1000);
        $('#thickboxgallery_' + galleryid + ' .' + galleries[galleryid]['inactiveelement']).fadeIn(fade_time);
        
        // aktiv/inaktiv tauschen
        temp = galleries[galleryid]['activeelement'];
        galleries[galleryid]['activeelement'] = galleries[galleryid]['inactiveelement'];
        galleries[galleryid]['inactiveelement'] = temp;
        
        // Den Scroller verschieben
        $('#thickboxgallery_' + galleryid + ' .scroll-pane')[0].scrollTo('img:eq(' + activeimage + ')');
        
    }).attr('src', url);

}

function thickboxgalleryimageprev (galleryid) {
    galleryid = parseInt(galleryid);
    // Nur das vorherige Bild anzeigen, wenn wir nicht beim ersten Element sind
    if((galleries[galleryid]['activeimage']-1) >= 0) {
        newimage = galleries[galleryid]['activeimage']-1;
    }
    else {
        newimage = galleries[galleryid]['images'].length-1;
    }
    thickboxgalleryimagechange(galleryid, newimage);
}

function thickboxgalleryimagenext (galleryid) {
    galleryid = parseInt(galleryid);
    // Nur das naechste zuweisen, wenn es sich nicht um das letze Element handelt
    if((galleries[galleryid]['images'].length-1) >= (galleries[galleryid]['activeimage']+1)) {
        newimage = galleries[galleryid]['activeimage']+1;
    }
    else {
        newimage = 0;
    }
    thickboxgalleryimagechange(galleryid, newimage);
}

function thickboxgallerystartdiashow (galleryid) {
    galleryid = parseInt(galleryid);
    thickboxgalleryimagenext(galleryid);
    galleries[galleryid]['diashow_status'] = setInterval(function() {
        thickboxgalleryimagenext(galleryid);
    }, fade_delay);
    galleries[galleryid]['diashow'] = true;
    $('#thickboxgallery_' + galleryid + ' .thickboxgallerystartstopbutton').remove();
}

function thickboxgallerystopdiashow (galleryid) {
    galleryid = parseInt(galleryid);
    clearInterval(galleries[galleryid]['diashow_status']);
    galleries[galleryid]['diashow'] = false;
    $('#thickboxgallery_' + galleryid + ' .thickboxgallerystartstopbutton').remove();
}

function thickboxgallerypreparedate (unixtimestamp_in_s) {
    input_date = new Date(parseInt(unixtimestamp_in_s) * 1000);
    day = thickboxgallerytwodigits(input_date.getDate());
    month = thickboxgallerytwodigits(input_date.getMonth()+1);
    year = input_date.getFullYear();
    output_date = day + '.' + month + '.' + year;
    return output_date;
}

function thickboxgallerytwodigits (input) {
    if(input >= 10) { return input.toString();}
    else if(input < 10 && input > 0) { return "0" + input.toString(); }
    else { return "00"; }
}

// Globale
var fade_time = 1000;
var fade_delay = 5000;