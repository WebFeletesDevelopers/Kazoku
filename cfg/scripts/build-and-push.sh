#!/bin/bash

source $(dirname $0)/vars.sh

# Añadir credenciales

mkdir -p ${HOME}/.docker
echo ${DOCKER_AUTH_CONFIG} > ${HOME}/.docker/config.json

# Crear imágenes
# Debemos ejecutar este comando desde la raíz del proyecto, nunca desde la subcarpeta.

tag=${CI_COMMIT_BRANCH}

tag_version=$(git describe $(git rev-list --tags --max-count=1))

if [ "$tag" = "master" ]; then
  tag='latest'
else
  tag_version="${tag_version}_WFD_DEVELOP"
fi

tag_version="${tag_version}__$(git rev-list --all --max-count=1)"

sed -i -e "s/%%APP_VERSION%%/${tag_version}/" web/ts/main.ts

docker build -f cfg/docker-images/prod/php-fpm.Dockerfile -t "${registry_url}/${project_name}-php:${tag}" .
docker build -f cfg/docker-images/prod/nginx.Dockerfile -t "${registry_url}/${project_name}-web:${tag}" .

# Subir imágenes
docker push "${registry_url}/${project_name}-php:${tag}"
docker push "${registry_url}/${project_name}-web:${tag}"

# Esperar
echo 'Esperando...'
sleep 5
