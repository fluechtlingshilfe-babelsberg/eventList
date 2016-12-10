#!/bin/bash

# prepend application environment variables to crontab
touch /tmp/run.sh
chmod +x /tmp/run.sh
echo "#!/bin/bash" > /tmp/run.sh
env | egrep ical_url | sed -e 's/^/export /' | cat - >> /tmp/run.sh
env | egrep ical_user | sed -e 's/^/export /' | cat - >> /tmp/run.sh
env | egrep ical_pass | sed -e 's/^/export /' | cat - >> /tmp/run.sh
cat /root/loader.sh >> /tmp/run.sh

# Run cron deamon
# -m off : sending mail is off 
# tail makes the output to cron.log viewable with the $(docker logs container_id) command
cron  && tail -f /var/log/cron.log
