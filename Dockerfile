#FROM php:7.4.27-apache
FROM alpine
COPY . /app
VOLUME /www
CMD cp -r /app/* /www && chmod 777 /www/Temp && chmod 777 /www/Config