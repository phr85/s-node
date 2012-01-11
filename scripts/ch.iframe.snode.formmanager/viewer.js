$(function(){
    $('.XTFoMdatepicker').datepicker({
        showWeeks: true,
        firstDay: 1,
        changeFirstDay: false,
        dateFormat: 'dd.mm.yy',
        firstDay: 1,
        showWeeks: true,
        dateFormat: 'dd.mm.yy',
        monthNames: ['Januar','Februar','März','April','Mai','Juni','Juli','August','September','Oktober','November','Dezember'],
        dayNames: ['Sonntag','Montag','Dienstag','Mittwoch','Donnerstag','Freitag','Samstag','Sonntag'],
        dayNamesShort: ['So','Mo','Di','Mi','Do','Fr','Sa'],
        dayNamesMin: ['So','Mo','Di','Mi','Do','Fr','Sa'],
        yearRange: '-100:+20',
        showOn: "both",
        buttonImage: '/images/icons/calendar.png',
        buttonImageOnly: true
     }
    );
});