FROM nginx:1.15.9-alpine

RUN mv /etc/nginx/conf.d/default.conf /etc/nginx/conf.d/default.conf.org
ADD ./conf.d/default.conf /etc/nginx/config.d/