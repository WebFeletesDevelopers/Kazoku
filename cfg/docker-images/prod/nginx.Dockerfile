# FIXME

FROM nginx:1.17.8-alpine

COPY cfg/nginx/dev/default.conf /etc/nginx/conf.d/default.conf

COPY . /code
