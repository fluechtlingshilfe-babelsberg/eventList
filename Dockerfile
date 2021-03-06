FROM ubuntu:latest

RUN apt-get update && apt-get install -y cron php curl
 
# Add crontab file in the cron directory
ADD crontab /etc/cron.d/hello-cron
 
# Give execution rights on the cron job
RUN chmod 0644 /etc/cron.d/hello-cron
 
# Create the log file to be able to run tail
RUN touch /var/log/cron.log
 
ADD eventListFunctios.php /root/
ADD loader.sh /root/
ADD createCron.sh /root/createCron.sh
ADD vendor /root/vendor

VOLUME /data
VOLUME /root/templates
# Run the command on container startup
CMD /root/createCron.sh
