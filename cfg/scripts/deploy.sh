#!/bin/bash

source $(dirname $0)/vars.sh

ssh ${host} "docker pull ${registry_url}/${project_name}-php && docker pull ${registry_url}/${project_name}-web"
ssh ${host} "cd ${web_root} && docker-compose up -d"

scp ./cfg/nginx_real_settings.conf ${web_host}:/etc/nginx/sites-enabled/${url}.conf
ssh ${web_host} "systemctl restart nginx"

echo 'Despliegue completado en romeronet con la(s) URL:'
echo ${url}
