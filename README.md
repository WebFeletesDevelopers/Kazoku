# Club kazoku

Sistema de gestión de alumnado, clases y centros. Centro de información para usuarios y herramientas de profesorado

## Información de interés
* [Enlace a la presentación en Google Slides](https://docs.google.com/presentation/d/1Tk8hJBYVyyMKXgkxLFOPNnH5Xa_Kizr9NCVhZrcmF4Q/edit?usp=sharing) - Presentación para la exposición del proyecto.
* [Enlace al video demo](https://drive.google.com/drive/folders/1NqG90r9D2HFYT_mlegrWQ6uvG4LxdPQM?usp=sharing) - Se encuentra dentro de una caroepta en Google Drive.
* [Enlace a la memoria del proyecto](https://docs.google.com/document/d/1g070WeKhdBxYWxJ0EcBri8vPi0mRwhOOv0TBsHws6H0/edit#) - Documento de Google Docs.

## Publicado en 
* [Producción](https://kazoku.romeronet.es)
* [Desarrollo](https://testingkazoku.romeronet.es)


## Información Técnica
### Documentación del proyecto
Se encuentra disponible en:
* [PHP](https://github.com/WebFeletesDevelopers/Kazoku/tree/master/docs/php)
* [TypeScript](https://github.com/WebFeletesDevelopers/Kazoku/tree/master/docs/ts)

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
## Información de usuario (Enlaces de testing, la versión final puede variar)

### Gestión de cuentas para usuarios 
* [Inicio de Sesion](https://testingkazoku.romeronet.es/login) - Disponible para todos los usuarios
* [Registro](https://testingkazoku.romeronet.es/registro) - Disponible para todos los usuarios
* [Recuperación de contraseña](https://testingkazoku.romeronet.es/user/startPasswordRecovery) - Disponible para todos los usuarios
### Páginas de información para usuarios
* [Mi Perfil](https://testingkazoku.romeronet.es/profile) - Disponible para todos los usuarios
* [Mi Clase](https://testingkazoku.romeronet.es/virtualClass) - Disponible para todos los usuarios
* [Aula virtual](https://testingkazoku.romeronet.es/virtualClass) - No disponible en este momento

### Gestión de cuentas para profesores 
* [Confirmar usuarios](https://testingkazoku.romeronet.es/confirmUser) - Disponible para todos los profesores
* [Crear Usuario](https://testingkazoku.romeronet.es/newUser) - Disponible para todos los profesores
### Gestión general para profesores
* [Creador de Noticias](https://testingkazoku.romeronet.es/newsCreator) - Disponible para todos los profesores
* [Gestion de clases](https://testingkazoku.romeronet.es/classAdmin) - Disponible para todos los profesores
* [Gestion de Centros](https://testingkazoku.romeronet.es/centerAdmin) - Disponible para todos los profesores
* [Listado de alumnos](https://testingkazoku.romeronet.es/judokas) - Disponible para todos los profesores
* [Pasar lista](https://testingkazoku.romeronet.es/assistance) - Disponible para todos los profesores
### Listados para profesores
* [Detalles de clases](https://testingkazoku.romeronet.es/classDetail) - Disponible para todos los profesores
* [Detalles de Centros](https://testingkazoku.romeronet.es/centerDetail) - Disponible para todos los profesores
* [Detalles de Alumnos](https://testingkazoku.romeronet.es/judokaDetail) - Disponible para todos los profesores
### Panel de control
* [Panel de control](https://testingkazoku.romeronet.es/judokaDetail) - Disponible para todos los profesores









## Construido con 

* [PHP](php.net/) - Para el backend
* [TypeScript](https://www.typescriptlang.org) - Para el frontend
* [Twig](https://twig.symfony.com) - Para crear y gestionar plantillas de frontend
* [Slim](http://www.slimframework.com) - Para hacer rutas

## Autores

* **Fran Romero** - *Web developer at Freepik Company* - [fromero98](https://github.com/fromero98)
* **Alberto Gómez** - *SPOILER ALERT: Web developer at Bettergy Company* - [albertogomezp](https://github.com/albertogomezp/)
* este proyecto ha sido desarrollado como proyecto de fin de grado para el  [IESCampanillas](https://github.com/IESCampanillas)
