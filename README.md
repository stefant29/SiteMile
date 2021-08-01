<p align="center">
    <h1 align="center">SiteMile Messaging APP</h1>
    <br>
</p>

To build and run the app, you need to:
1. install `git bash` and `docker`
2. create a file named "`docker-compose.yml`", paste the content from bellow 
3. using `git bash`, go to the root of the new file ("`docker-compose.yml`") and run `docker-compose up`
4. go to "`localhost:8886`" using `Google Chrome`

Obs. If you encounter any errors with docker, a good old computer restart could solve them.
Be sure to also delete everything created by docker and start fresh:
```
docker stop sitemile_web && docker stop sitemile_mysql
docker rm sitemile_web && docker rm sitemile_mysql
docker network prune
```
Also, delete folder `c:\www\sitemile-files` and its content.


DOCKER COMPOSE
-------------------

```
version: '3.3'

services:
  db:
    image: mysql:5.7
    container_name: sitemile_mysql
    environment:
      MYSQL_DATABASE: "sitemile"
      # So you don't have to use root, but you can if you like
      MYSQL_USER: "sitemile"
      # You can use whatever password you like
      MYSQL_PASSWORD: "sitemile-password"
      # Password for root access
      MYSQL_ROOT_PASSWORD: "password"
      TZ: "Europe/London"
    stdin_open: true
    tty: true
    restart: always
    ports:
      - "3336:3306"
    volumes:
      - "sitemile-db:/var/lib/mysql"
    networks:
      testing_net:
        ipv4_address: 172.29.1.0

  web:
    image: stefant29/sitemile:beta3
    container_name: sitemile_web
    environment:
      TZ: 'Europe/London'
      MYSQL_ROOT_PASSWORD: "password"
      DATABASE_HOST: "db"
      USE_DEMO_DATA: "TRUE"
    ports:
      - "8886:80"
    tmpfs:
      - /tmp
    stdin_open: true
    tty: true
    volumes:
      - "c:\\www\\sitemile-files:/var/www/sitemile"
    depends_on:
      - db
    entrypoint: bash -c "./var/www/install_sitemile.sh && apachectl -D FOREGROUND"
    networks:
      testing_net:
        ipv4_address: 172.29.1.1

networks:
  testing_net:
    ipam:
      driver: default
      config:
        - subnet: 172.29.0.0/16

volumes:
  sitemile-db:


```
