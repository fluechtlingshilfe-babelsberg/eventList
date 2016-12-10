#!/bin/bash
cd /root
if [ -z $ical_url ]; then echo "please set \$ical_url"; 
exit;
fi;

dir=./

if [ -z $ical_user ]; then 
echo "no user specifyed. trying without auth."; 

curl $ical_url  > $dir'MYical.ics'
for i in templates/*.php; do php $i > /data/$(basename $i); done
 
exit;
fi;

if [ -z $ical_pw ]; then echo "please set \$ical_pw"; 
exit;
fi;


 curl $ical_url  -u$ical_user:$ical_pw  > $dir'MYical.ics'
 for i in templates/*.php; do php $i > /data/$(basename $i); done
