#!/bin/bash

if [ -z $ical_url ]; then echo "please set \$ical_url"; 
exit;
fi;

if [ -z $ical_user ]; then echo "please set \$ical_user"; 
exit;
fi;

if [ -z $ical_pw ]; then echo "please set \$ical_pw"; 
exit;
fi;

 dir=./
 curl $ical_url  -u$ical_user:$ical_pw  > $dir'MYical.ics'
 
 php generateList.php
