<?php
require 'ics-parser/class.iCalReader.php';


$ical   = new ICal("./MYical.ics");
$events = $ical->events(); 

foreach ($events as $event) {
var_dump($event);
    $endTimestamp = $ical->iCalDateToUnixTimestamp($event['DTEND']);
    if($endTimestamp < time())
        continue;
    
    $begin = date_create();
    date_timestamp_set($begin,$ical->iCalDateToUnixTimestamp($event['DTSTART']));
    $line = $begin->format('j.n') . " - ";
    
    $end = date_create();
    date_timestamp_set($end,$endTimestamp);
    $line .= $end->format('j.n') . " - ";
    
    $line .=    $event['SUMMARY'];
    preg_match("/(https?:\/\/[^\s]+)/", $event['DESCRIPTION'], $output_array);
    if(count($output_array) > 0){
        $link = str_replace("\\n","",$output_array[0]);
        $link = str_replace("\\r","",$link);
        $line = "<a href='" . $link . "'>" . $line . "</a>";
    }
    echo $line . "\n\r";
}

?>
