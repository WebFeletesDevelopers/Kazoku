FROM node:lts AS builder

COPY ./web /web
COPY ./public /public
WORKDIR /web
RUN yarn && yarn build

FROM nginx:1.17.8-alpine

COPY cfg/nginx/dev/default.conf /etc/nginx/conf.d/default.conf

COPY --from=builder /web /web
COPY --from=builder /public /public

