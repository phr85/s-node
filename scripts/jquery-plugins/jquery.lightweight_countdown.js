/**
 * jquery lightweight_countdown Plugin
 * Proprietary licence avail. via info@iframe.ch
 * Version 0.1
 * Author Dominik Zogg
 * 
 * Usage:
 * 
 * $(document).ready(function () {
 *     $('#countdown').countdown({
 *         event: 'June 11, 2010'
 *     });
 * });
 *
 * <div id="countdown">
 *     <span class="days"></span>
 *     <span class="hours"></span>
 *     <span class="mins"></span>
 *     <span class="secs"></span>
 * </div>
 *
 */

$.fn.lightweight_countdown = function(options) {
    
    // Die Standard Optionen laden
    options = $.extend({}, $.fn.lightweight_countdown.defaults, options || {});
    
    // Wrapper ID
    wrapper_id = $(this).attr('id');
    
    // Das Zieldatum setzen
    event_date = new Date(options.event).getTime();
    
    // Die Zeit neu setzen
    setInterval(function() {
        set_time_values(wrapper_id, event_date);
    }, 1000);
    
    function set_time_values (wrapper_id, event_date) {
            
        // Das aktuelle Datum
        now = new Date().getTime();
        
        // Die Zeit bis zum Event in Sekunden
        time_difference = Math.floor((event_date - now) / 1000);
    
        if(time_difference > 0) {
            
            /**
             * Logik:
             * 1. Den Rest berechnen, welche beim Teilen durch die naechst groessere Einheit entsteht
             * 2. Durch die naechst groessere Einheit teilen und abrunden
             */
            
            secs = time_difference % 60;
            time_difference = Math.floor(time_difference / 60);
            
            mins = time_difference % 60;
            time_difference = Math.floor(time_difference / 60);
            
            hours = time_difference % 24;
            time_difference = Math.floor(time_difference / 24);
            
            days = time_difference;
            
            // Die Werte ausfuellen
            $('#' + wrapper_id + ' .days').text(two_digit(days));
            $('#' + wrapper_id + ' .hours').text(two_digit(hours));
            $('#' + wrapper_id + ' .mins').text(two_digit(mins));
            $('#' + wrapper_id + ' .secs').text(two_digit(secs));
            
            return(true);
        }
        else {
            return(false);
        }
    }
    
    // Macht aus einer Zahl einen mindestens zweistelligen String
    function two_digit (input) {
        if(input >= 10) { return input.toString();}
        else if(input < 10 && input > 0) { return "0" + input.toString(); }
        else { return "00"; }
    }
};

$.fn.lightweight_countdown.defaults = {
    event: 'January 1, 2010'
};