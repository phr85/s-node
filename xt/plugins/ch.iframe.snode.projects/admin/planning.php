<?php

$width = 750;
$start_date = 1104537600;
$day = 86400;
$unit = $day;
$unit_width = 40;

$steps = array(
    array('duration' => $day, 'start_date' => 1104537600),
    array('duration' => $day*2, 'start_date' => 1104537600+$day),
    array('duration' => $day*4, 'start_date' => 1104537600+$day*3),
    array('duration' => $day*3, 'start_date' => 1104537600+$day*7),
    array('duration' => $day*3, 'start_date' => 1104537600+$day*10),
    array('duration' => $day*1, 'start_date' => 1104537600+$day*13),
    array('duration' => $day*1, 'start_date' => 1104537600+$day*14),
    array('duration' => $day*1, 'start_date' => 1104537600+$day*15),
);
$steps_effective = array(
    array('duration' => $day+26531, 'start_date' => 1104537600),
    array('duration' => $day*2-16000, 'start_date' => 1104537600+$day+26531),
    array('duration' => $day*4-35000, 'start_date' => 1104537600+$day*2-16000+$day+26531),
    array('duration' => $day*3+40300, 'start_date' => 1104537600+$day*4-35000+$day*2-16000+$day+26531),
);

$im = @imagecreatetruecolor($width, 400)
     or die("Cannot Initialize new GD image stream");

// colors
$background_color = imagecolorallocate($im, 255, 255, 255);
$header_color = imagecolorallocate($im, 172, 183, 196);
$line_color = imagecolorallocate($im, 230, 230, 230);
$text_header_color = imagecolorallocate($im, 255, 255, 255);
$text_color = imagecolorallocate($im, 217, 224, 232);
$scala_background_color = imagecolorallocate($im, 198, 205, 213);

// activity colors
$activity_color = imagecolorallocatealpha($im, 172, 183, 196, 50);
$activity_effective_color = imagecolorallocatealpha($im, 0, 200, 0, 90);

// fill background
imagefill($im,0,0,$background_color);

// draw header
imagefilledrectangle($im,0,0,$width,24,$header_color);
imagefilledrectangle($im,0,25,$width,49,$scala_background_color);

// draw dates
ImageTTFText ($im, 8, 0, 5, 17, $text_header_color, FONT_DIR . "tahoma.ttf", date("d.M Y", $start_date));

for($i = date("d", $start_date); $i <= 30; $i++){
    $new_date = $start_date + (($i-1) * $day);
    ImageTTFText ($im, 8, 0, ($i-1)*$unit_width+5, 41, $text_header_color, FONT_DIR . "tahoma.ttf", date("D", $new_date));
}

// draw lines
$start = 49;
$count = 1;
foreach($steps as $key => $step){
    $line_y = $start + $count*22;
    imageline($im,0,$line_y,$width,$line_y,$line_color);
    
    // draw activity
    $activity_y = $line_y - 16;
    
    $start_x = (($step['start_date']-$start_date)/$unit*$unit_width)+5;
    imagefilledrectangle(
        $im,
        $start_x,
        $activity_y-1,
        $start_x + $step['duration']/$unit*$unit_width,
        $activity_y+2,
        $activity_color
    );
    
    if(array_key_exists($key, $steps_effective)){
        if($steps_effective[$key]['duration'] > $step['duration']){
            $activity_effective_color = imagecolorallocatealpha($im, 200, 0, 0, 60);
        } else {
            $activity_effective_color = imagecolorallocatealpha($im, 0, 200, 0, 50);
        }
        $start_effective_x = (($steps_effective[$key]['start_date']-$start_date)/$unit*$unit_width)+5;
        
        $last_end = $start_effective_x + $steps_effective[$key]['duration']/$unit*$unit_width;
        
        imagefilledrectangle(
            $im,
            (($steps_effective[$key]['start_date']-$start_date)/$unit*$unit_width)+5,
            $activity_y+4,
            $start_effective_x + $steps_effective[$key]['duration']/$unit*$unit_width,
            $activity_y+11,
            $activity_effective_color
        );
        
        $diff = ($steps_effective[$key]['duration'] - $step['duration']);
        if($diff < 86400){
            $diff = round($diff / 3600,1) . " h";
        }
        if($diff > 0){
            $diff = '+' . $diff;
        }
        
        if($start_x + $step['duration']/$unit*$unit_width > $start_effective_x + $steps_effective[$key]['duration']/$unit*$unit_width){
            $text_position = $start_x + $step['duration']/$unit*$unit_width;
        } else {
            $text_position = $start_effective_x + $steps_effective[$key]['duration']/$unit*$unit_width;
        }
        ImageTTFText ($im, 8, 0, $text_position + 5, $activity_y+10, $activity_effective_color, FONT_DIR . "tahoma.ttf",$diff);
    }
    
    $count++;
}

imagepng($im,IMAGE_DIR . 'test_gantt.png');
imagedestroy($im);

$content = XT::build("planning.tpl");

?>
