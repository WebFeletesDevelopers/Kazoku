#!/bin/bash

source $(dirname $0)/vars.sh

ssh ${host} "docker pull ${repo}/${project_name}-php && docker pull ${repo}/${project_name}-web"
ssh ${host} "cd ${web_root} && docker-compose up -d"

scp ./cfg/nginx_real_settings.conf ${host}:/etc/nginx/sites-enabled/${url}.conf
ssh ${host} "systemctl restart nginx"

echo 'Despliegue completado en romeronet con la(s) URL:'
echo ${url}
