# Club kazoku

Sistema de gestión de alumnado, clases y centros. Centro de información para usuarios y herramientas de profesorado

## Información Técnica

Para desplegar este proyecto en local es necesario el uso de <a href="docker.com" target="_blank">docker</a>.
### Requisitos

Hacer un git clone de este proyecto, arrancar docker y en la raiz de proyecto ejecutar
```
make build-dev start-dev
```
tras unos instantes se habrán iniciado las imágenes y ya estará listo, solo hace falta ir a <a href="localhost:8080/" target="_blank">localhost:8080/</a> y aparecerá la página de inicio
### Arrancar el proyecto

Para iniciar el proyecto en cualquier momento se ha de ejecutar el comando
```
make start-dev
```

Es muy importante para evitar roturas en las imágenes de usar el siguiente comando una vez se haya terminado el desarrollo
```
make stop-dev
```

En caso de necesitar purgar las imágenes con ejecutar el comando se reiniciarán
```
make daily-up 
```
Todas las funciones se encuentran en el fichero <a href="/makefile">make</a>
## Cambios en Typscript

El código escrito en TypeScript ha de ser compilado antes de que se ejecute,por lo que emplearemos el siguiente comando cada vez que incluyamos un cambio

```
make web-dev 
```
O podemos ejecutar el siguiente para que cada vez que guardemos se auto compile
```
make watch
```
 Para terminar su ejecución tan solo tendremos que pulsar <kbd>ctrl</kbd>+ <kbd>c</kbd>

### Traducciones

Para escribir una traducción en una plantilla twig hay que escribir
```
{{ "Texto a traducir" | trans }}
```
Estas cadenas de texto se guardan en ficheros .po, uno por cada idioma, para actualizar las entradas hay que ejecutar
```
make update-po
```
Al ejecutarlo, se generarán las cadenas vacías listas para escribir su traducción, se pueden editar directamente los ficheros o usar un IDE que simplifica y lo hace visualmente más bonito. Nosotros hemos usado poedit.
<br>
Una vez se hayan hecho las traduciones, se han de compilar las traducciones con el comando:
```
make compile-mo-dev
```
## Información de usuario




## Construido con 

* [PHP](php.net/) - Para el backend
* [TypeScript](https://www.typescriptlang.org) - Para el frontend
* [Twig](https://twig.symfony.com) - Para crear y gestionar plantillas de frontend
* [Slim](http://www.slimframework.com) - Para hacer rutas

## Autores

* **Fran Romero** - *Web developer at Freepik Company* - [fromero98](https://github.com/fromero98)
* **Alberto Gómez** - *Web developer at Bettergy Company* - [albertogomezp](https://github.com/albertogomezp/)
* este proyecto ha sido desarrollado como proyecto de fin de grado para el  [IESCampanillas](https://github.com/IESCampanillas)
