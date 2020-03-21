#!/bin/bash

source $(dirname $0)/vars.sh

# Añadir credenciales

mkdir -p ${HOME}/.docker
echo ${DOCKER_AUTH_CONFIG} > ${HOME}/.docker/config.json

# Crear imágenes
# Debemos ejecutar este comando desde la raíz del proyecto, nunca desde la subcarpeta.

tag=${CI_COMMIT_BRANCH}

if [ "$tag" = "master" ]; then
  tag='latest'
fi

docker build -f cfg/docker-images/prod/php-fpm.Dockerfile -t "${registry_url}/${project_name}-php:${tag}" .
docker build -f cfg/docker-images/prod/nginx.Dockerfile -t "${registry_url}/${project_name}-web:${tag}" .

# Subir imágenes
docker push "${registry_url}/${project_name}-php:${tag}"
docker push "${registry_url}/${project_name}-web:${tag}"

# Esperar
echo 'Esperando...'
sleep 5
