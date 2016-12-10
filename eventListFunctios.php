<?php
require 'vendor/autoload.php';

//usage: printEvents(array("bla"),5);

echo "<?php header('Access-Control-Allow-Origin: *'); ?>\n\r";

use ICal\ICal;

$ical   = new ICal("./MYical.ics");
$events = $ical->events(); 

date_default_timezone_set($ical->calendarTimeZone());


function printEvents($filters = array(),$max = 0){
    global $ical, $events;
    $printCount = 0;
     
    foreach ($events as $event) {
        if($max != 0 && $printCount >= $max)
            return 1; //more events exist
        
        if($ical->iCalDateToUnixTimestamp($event->dtend) < time())
            continue;
        
        if(count($filters) == 0){
            printEvent($event);
            $printCount++;
        }
        else{
            foreach($filters as $filter){
                if(preg_match("/\[[\s\S]*" . $filter . "[\s\S]*\]/",$event->summary)){
                    printEvent($event);
                    $printCount++;
                    break;
                }
            }
        }
    }
    return 0; //no more events
}

function printEvent($event){
    global $ical;
    
    $begin = date_create();
    date_timestamp_set($begin,$ical->iCalDateToUnixTimestamp($event->dtstart));
    $line = $begin->format('d.m.') . " - ";
    
    $end = date_create();
    date_timestamp_set($end,$ical->iCalDateToUnixTimestamp($event->dtend) - 1);
    $line .= $end->format('d.m.') . " - ";
    
    $name =    $event->summary;
    
    $name = preg_replace("/\[[\s\S]*\]/","",$name);
    $line .= $name;
    
    preg_match("/(https?:\/\/[^\s]+)/", $event->description, $output_array);
    if(count($output_array) > 0){
        $link = str_replace("\\n","",$output_array[0]);
        $link = str_replace("\\r","",$link);
        $line = "<a href='" . $link . "'>" . $line . "</a>";
    }
    echo $line . "\n\r";
}

?>
