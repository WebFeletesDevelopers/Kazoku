#!/bin/bash

source $(dirname $0)/vars.sh

rm -rf .env
touch .env
echo "${project_name_upper}_DATABASE_USER=${DATABASE_DATA_USR}" >> .env
echo "${project_name_upper}_DATABASE_PASSWORD=${DATABASE_DATA_PSW}" >> .env
echo "${project_name_upper}_DATABASE_DATABASE=${DATABASE_DATA_DBNAME}" >> .env
echo "${project_name_upper}_MAIL_USER=${EMAIL_DATA_USR}" >> .env
echo "${project_name_upper}_MAIL_PASSWORD=${EMAIL_DATA_PSW}" >> .env

ssh ${host} "mkdir ${web_root} -p"
scp .env ${host}:${web_root}/.env
scp ./docker-compose.yml ${host}:${web_root}/docker-compose.yml
rm -rf .env
