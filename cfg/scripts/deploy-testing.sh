#!/bin/bash

source $(dirname $0)/vars.sh

ssh ${host} "docker pull ${registry_url}/${project_name}-php:develop && docker pull ${registry_url}/${project_name}-web:develop"
ssh ${host} "cd ${web_root_testing} && docker-compose up -d"

scp ./cfg/nginx_testing_real_settings.conf ${web_host}:/etc/nginx/sites-enabled/${url_testing}.conf
ssh ${web_host} "systemctl restart nginx"

echo 'Despliegue completado en romeronet con la(s) URL:'
echo ${url_testing}
