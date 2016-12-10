# EventList
Generates an event List from the owncloud calender

## Setup
First of all check out this repository:

Next, install dependencys using composer:

`docker run --rm -v $(pwd):/app composer/composer install`

Now set up your `docker-compose.yml`:
```
najuterminliste:
    build: .
    volumes:
     - ./data:/data/
     - ./templates:/root/templates
    environment:
     - ical_url=
     - ical_user=
     - ical_pw=
```
