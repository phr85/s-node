<?
/***************************************************************************

PHP vCard class v2.0
(c) Kai Blankenhorn
www.bitfolge.de/en
kaib@bitfolge.de


This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.

ACHTUNG!!!
Diese Klasse wurde umgeschrieben und entspricht nicht mehr dem Original, d.h. sie kann nicht einfach durch eine neue Version ersetzt werden.
Desweiteren arbeitet diese Klasse jetzt mit UTF8

***************************************************************************/

class vCard {
    var $properties;
    var $filename;
    /** Main address data table
     *
     * @var string
     */
    var $_table = 'addresses';

    function vCard($id, $use_userid = false) {

        if ($use_userid != false) {
            $result = XT::query("SELECT
		       *
		    FROM
		      " . XT::getDatabasePrefix() . $this->_table . "
			WHERE
				user_id=" . $id,__FILE__,__LINE__);
        } else {
            $result = XT::query("SELECT
		       *
		    FROM
		      " . XT::getDatabasePrefix() . $this->_table . "
			WHERE
				id=" . $id,__FILE__,__LINE__);
        }


        while($row = $result->fetchRow()) {
            $gender = "";
            if ($row['gender'] > 0) {
                $gender = $row['gender'] == 1 ? "Herr" : "Frau";
            }
            // Set the name
            $this->setName($row['lastName'] , $row['firstName'] , "", $gender);

            // Set the description
            $this->setNote($row['description']);
            // Phone numbers
            $this->setPhoneNumber($row['tel'], "WORK");
            $this->setPhoneNumber($row['tel_private'], "HOME");
            $this->setPhoneNumber($row['tel_mobile'], "CELL");
            $this->setPhoneNumber($row['tel_mobile_private'], "CELL;HOME");
            $this->setPhoneNumber($row['fax'], "FAX;WORK");
            $this->setPhoneNumber($row['fax_private'], "FAX;HOME");
            // Website
            $this->setURL($row['website'], "WORK");
            // Email
            $this->setEmail($row['email'], "WORK");
            $this->setEmail($row['email_private'], "HOME");
            // Address

            $result_c = XT::query("
				SELECT
				    *
				FROM
				     " . XT::getDatabasePrefix() . "countries
				WHERE
					country='" . $row['country'] . "'
				",__FILE__,__LINE__);
            if($row_c = $result_c->fetchRow()) {
                $country = $row_c['name'];
            }
            $result_cr = XT::query("
				SELECT
				    *
				FROM
				     " . XT::getDatabasePrefix() . "countries_regions
				WHERE
					country='" . $row['country'] . "' AND region=" . $row['state'] . "
				",__FILE__,__LINE__);
            if($row_cr = $result_cr->fetchRow()) {
                $region = $row_cr['name'];
            }




            switch ($row['type']) {
                case 1:
                    $this->setOrg($row['title']);
                    $this->properties['X-ABShowAs'] = 'COMPANY';
                    $this->setAddress("", "", $row['street'], $row['city'], $region, $row['postalCode'], $country,'WORK;POSTAL');
                    break;
                case 3:
                    if($row['birthdate'] !=0){
                        $this->setBirthday($row['birthdate']);
                    }
                    $this->setAddress("", "", $row['street'], $row['city'], $region, $row['postalCode'], $country,'HOME;POSTAL');
                    break;
                default:
                    break;
            }


            // Image
            if ($row['image'] > 0){
                $filename = DATA_DIR . 'files/' . $row['image'] . '_cube';
                $this->setPhoto("PNG",file_get_contents($filename));
            }
        }

    }

    function setPhoneNumber($number, $type="") {
        // type may be PREF | WORK | HOME | VOICE | FAX | MSG | CELL | PAGER | BBS | CAR | MODEM | ISDN | VIDEO or any senseful combination, e.g. "PREF;WORK;VOICE"
        $key = "TEL";
        if ($type!="") $key .= ";".$type;
        $key.= ";UTF-8";
        $this->properties[$key] = $this->quoted_printable_encode($number);
    }
    function setEmail($address,$type="") {
        $key = "EMAIL;INTERNET";
        if ($type!="") $key .= ";".$type;
        $this->properties[$key] = $address;
    }
    // UNTESTED !!!
    function setPhoto($type, $photo) { // $type = "GIF" | "JPEG"
        $this->properties["PHOTO;TYPE=$type;ENCODING=BASE64"] = base64_encode($photo);
    }

    function setFormattedName($name) {
        $this->properties["FN"] = $this->quoted_printable_encode($name);
    }

    function setOrg($name) {
        $this->properties["ORG"] = $this->quoted_printable_encode($name);
    }

    function setName($family="", $first="", $additional="", $prefix="", $suffix="") {
        $this->properties["N"] = "$family;$first;$additional;$prefix;$suffix";
        $this->filename = str_ireplace(" ","_",$first) . "_" . str_ireplace(" ","_",$family)  . ".vcf";
        if ($this->properties["FN"]=="") $this->setFormattedName(trim("$prefix $first $additional $family $suffix"));
    }

    function setBirthday($date) { // $date format is YYYY-MM-DD
        $this->properties["BDAY"] = $date;
    }

    function setAddress($postoffice="", $extended="", $street="", $city="", $region="", $zip="", $country="", $type="HOME;POSTAL") {
        // $type may be DOM | INTL | POSTAL | PARCEL | HOME | WORK or any combination of these: e.g. "WORK;PARCEL;POSTAL"
        $key = "ADR";
        if ($type!="") $key.= ";$type";
        $key.= ";UTF-8";
        $this->properties[$key] = $this->encode($name).";".$this->encode($extended).";".$this->encode($street).";".$this->encode($city).";".$this->encode($region).";".$this->encode($zip).";".$this->encode($country);

        if ($this->properties["LABEL;$type;UTF-8"] == "") {
            //$this->setLabel($postoffice, $extended, $street, $city, $region, $zip, $country, $type);
        }
    }

    function setLabel($postoffice="", $extended="", $street="", $city="", $region="", $zip="", $country="", $type="HOME;POSTAL") {
        $label = "";
        if ($postoffice!="") $label.= "$postoffice\r\n";
        if ($extended!="") $label.= "$extended\r\n";
        if ($street!="") $label.= "$street\r\n";
        if ($zip!="") $label.= "$zip ";
        if ($city!="") $label.= "$city\r\n";
        if ($region!="") $label.= "$region\r\n";
        if ($country!="") $country.= "$country\r\n";

        $this->properties["LABEL;$type;UTF-8"] = $this->quoted_printable_encode($label);
    }

    function setNote($note) {
        $this->properties["NOTE;UTF-8"] = $this->quoted_printable_encode($note);
    }

    function setURL($url, $type="") {
        // $type may be WORK | HOME
        $key = "URL";
        if ($type!="") $key.= ";$type";
        $this->properties[$key] = $url;
    }

    function getVCard() {
        $text = "BEGIN:VCARD\r\n";
        $text.= "VERSION:3.0\r\n";
        if (is_array($this->properties)) {
            foreach($this->properties as $key => $value) {
                $text.= "$key:$value\r\n";
            }
        }
        $text.= "REV:".date("Y-m-d")."T".date("H:i:s")."Z\r\n";
        $text.= "END:VCARD\r\n";
        return $text;
    }

    function getFileName() {
        return $this->filename;
    }

    function download() {
        $output = $this->getVCard();
        $filename = $this->getFileName();

        Header("Content-Disposition: attachment; filename=$filename");
        Header("Content-Length: ".strlen($output));
        Header("Connection: close");
        Header("Content-Type: text/x-vCard; name=$filename");
        echo $output;
        exit;
    }


    function encode($string) {
        return $this->escape($this->quoted_printable_encode($string));
    }

    function escape($string) {
        return str_replace(";","\;",$string);
    }

    // taken from PHP documentation comments

    function quoted_printable_encode($input, $line_max = 76) {
/*
        $hex = array('0','1','2','3','4','5','6','7','8','9','A','B','C','D','E','F');
        $lines = preg_split("/(?:\r\n|\r|\n)/", $input);
        $eol = "\r\n";
        $linebreak = "=0D=0A";
        $escape = "=";
        $output = "";

        for ($j=0;$j<count($lines);$j++) {
            $line = $lines[$j];
            $linlen = strlen($line);
            $newline = "";
            for($i = 0; $i < $linlen; $i++) {
                $c = substr($line, $i, 1);
                $dec = ord($c);
                if ( ($dec == 32) && ($i == ($linlen - 1)) ) { // convert space at eol only
                    $c = "=20";
                } elseif ( ($dec == 61) || ($dec < 32 ) || ($dec > 126) ) { // always encode "\t", which is *not* required
                    $h2 = floor($dec/16); $h1 = floor($dec%16);
                    $c = $escape.$hex["$h2"].$hex["$h1"];
                }
                if ( (strlen($newline) + strlen($c)) >= $line_max ) { // CRLF is not counted
                    $output .= $newline.$escape.$eol; // soft line break; " =\r\n" is okay
                    $newline = "    ";
                }
                $newline .= $c;
            } // end of for
            $output .= $newline;
            if ($j<count($lines)-1) $output .= $linebreak;
        }
        return trim($output);*/

        return trim($input);
    }
}
?>