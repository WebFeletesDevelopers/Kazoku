#!/bin/bash

source $(dirname $0)/vars.sh

touch .env
echo "${project_name_upper}_DATABASE_USER=${DATABASE_DATA_USR}" >> .env
echo "${project_name_upper}_DATABASE_PASSWORD=${DATABASE_DATA_PSW}" >> .env
echo "${project_name_upper}_DATABASE_DATABASE=${DATABASE_DATA_DBNAME}" >> .env

ssh ${host} "mkdir ${web_root} -p"
scp .env ${host}:${web_root}/.env
scp ./docker-compose.yml ${host}:${web_root}/docker-compose.yml
rm -rf .env
