# Creacion de CRUD en PHP-MVC

Repaso de la arquitectura MVC en PHP e implementacion de WebSockets del lado del servidor y del cliente.

![image](https://s3.amazonaws.com/media-p.slid.es/uploads/158334/images/2098746/mvc_structure__Slides.png)

Esto se acerca en la ruta C:\Windows\System32\drivers\etc hosts
127.0.0.1 crud.local.com
127.0.0.1 jobtest.localhost.com

## Inicio del proyecto

Es necesario que la arquitectura de los archivos sea la siguiente:

```bash
|---CARPETA
    |----controllers
    |----models
    |----views
    |----index.php
```

Primero implementamos el <i>index.php</i>, en este verificamos que tenemos inicado la sesión, en caso de que no lo este la iniciamos esta se puede comprobar con la siguiente código.

```bash

//Iniciamos la sesion con session_start()
if(session_status()==PHP_SESSION_NONE){session_start();}

```
