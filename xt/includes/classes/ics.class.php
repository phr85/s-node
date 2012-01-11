<?php

/**
 * ics.class.php
 *
 * Distributed under the GNU Lesser General Public License (LGPL v3)
 * (http://www.gnu.org/licenses/lgpl.html)
 * This program is distributed in the hope that it will be useful - WITHOUT
 * ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or
 * FITNESS FOR A PARTICULAR PURPOSE.
 *
 * Author: iframe AG, Dominik Zogg <dominik.zogg at iframe.ch>
 *
 */

class ics {

    var $filename = "";
    var $events = array();

    var $linebreak = "\r\n";

    var $cal_header = "";
    var $cal_footer = "";

    var $calendar = "";

    /**
     * @param array $events: (
     *  $events[0]['id'];
     *  $events[0]['creation_date'];
     *  $events[0]['from_date'];
     *  $events[0]['end_date'];
     *  $events[0]['title'];
     *  $events[0]['text'];
     *  $events[0]['location'];
     * )
     * @param string $filename
     *
     */
    function ics ($events, $filename = "calendar", $linebreak = "\r\n") {
        if(is_array($events)) {
            if($linebreak == "\r\n" || $linebreak == "\n" || $linebreak == "\r") {
                $this->linebreak = $linebreak;
            }
            $this->filename = $filename;
            $this->generate_header();
            $this->generate_footer();
            $this->prepare_calendar($events);
            $this->build_calendar();
        }
    }

    /**
     * @param array $events
     *
     */
    function prepare_calendar ($events) {
        if(is_array($events)) {
            foreach($events as $event) {
                if($returnvalue = $this->generate_event($event)) {
                    array_push($this->events, $returnvalue);
                }
            }
        }
    }

    function generate_header () {
        $this->cal_header = "BEGIN:VCALENDAR" .
                            $this->linebreak .
                            "PRODID:-//iframe AG/S-NODE" .
                            $this->linebreak .
                            "VERSION:2.0" .
                            $this->linebreak .
                            "METHOD:PUBLISH";
    }

    function generate_footer () {
        $this->cal_footer = "END:VCALENDAR";
    }

    /**
     * @param array $event
     * @return string or FALSE
     *
     */
    function generate_event ($event) {

        $event_data = array();
        $event_str = "BEGIN:VEVENT" . $this->linebreak;

        // Die UID setzen
        if(isset($event['id'])) {
            $event_data['UID'] = md5($event['id'] . "@" . $_SERVER['SERVER_NAME']);
        }

        // Das Erstellungsdatum setzen
        if(isset($event['creation_date'])) {
            $event_data['DTSTAMP'] = gmstrftime("%Y%m%dT%H%M00Z", $event['creation_date']);
        }
        // Falls kein Erstellungsdatum angegeben wurde den DSTAMP auf das from_date setzen, falls vorhanden
        elseif(isset($event['from_date'])) {
            $event_data['DTSTAMP'] = gmstrftime("%Y%m%dT%H%M00Z", $event['from_date']);
        }

        // Das Startdatum setzen
        if(isset($event['from_date'])) {
            $event_data['DTSTART'] = gmstrftime("%Y%m%dT%H%M00Z", $event['from_date']);
        }

        // Das Enddatum setzen
        if(isset($event['end_date'])) {
            $event_data['DTEND'] = gmstrftime("%Y%m%dT%H%M00Z", $event['end_date']);
        }

        // Den Titel setzen
        if(isset($event['title'])) {
            $event_data['SUMMARY'] = $this->clean_values($event['title']);
        }

        // Die Beschreibung setzen
        if(isset($event['text'])) {
            $event_data['DESCRIPTION'] = $this->clean_values($event['text']);
        }

        // Den Ort setzen
        if(isset($event['location'])) {
            $event_data['LOCATION'] = $this->clean_values($event['location']);
        }

        // Falls die mindest Werte gesetzt sind den Event zurueckgeben im richtigen Format
        if(isset($event_data['UID']) &&
           isset($event_data['DTSTAMP']) &&
           isset($event_data['DTSTART']) &&
           isset($event_data['DTEND']) &&
           isset($event_data['SUMMARY'])) {
            foreach($event_data as $key => $value) {
                $event_str .= $key . ":" . $value . $this->linebreak;
            }
            $event_str .= "END:VEVENT" . $this->linebreak;
            return($event_str);
        }
        else {
            return(FALSE);
        }

    }

    /**
     * @param string $input
     * @return string
     *
     */
    function clean_values($input) {
        $badsigns = array("<br />", "<br/>", "<br>", "\r\n", "\r", "\n", "\t", '"');
        $goodsigns = array('\n', '\n', '\n', '', '', '', ' ', '\"');
        return(trim(str_replace($badsigns, $goodsigns, strip_tags($input, "<br>"))));
    }

    function build_calendar () {
        $this->calendar = $this->cal_header . $this->linebreak;
        foreach($this->events as $event) {
            $this->calendar .= $event;
        }
        $this->calendar .= $this->cal_footer;
    }

    function return_calendar () {
        header("Content-type: text/calendar");
        header('Content-Disposition: attachment; filename="' .  $this->filename . '_' . date("d-m-Y") . '.ics"');
        echo $this->calendar;
        die();
    }

}

?>