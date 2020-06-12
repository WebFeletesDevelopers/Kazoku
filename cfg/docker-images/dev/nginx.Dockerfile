FROM nginx:1.17.8-alpine

COPY nginx/dev/default.conf /etc/nginx/conf.d/default.conf

