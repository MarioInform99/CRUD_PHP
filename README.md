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

Comprobamos que el usuario esta identificado con la siguiente sentencia:<br/>

```bash

if(isset($_SESSION['login[status]']) && $_SESSION['login[status]']==1){
    require_once('./view/crud/crud.php');
    die();
}

```

Los primeros pasos a realizar es el login y registro del usuario. Por ejemplo, todo debe de estar anidado con el controlador, modelo y vista.<br/>
Por ejemplo el usuario realizar una peticion de entrada o un login. Este se inicia en el <i>index.php</i> posteriomente analiza este codigo.

```bash

<?php
/**
 * Implementamos las librerias o clases necesarias
 * Implementamos el controlador del usuario
 */
require_once('./controller/login.controller.php');
$User=new LoginController();
//Iniciamos la sesion con session_start()
if(session_status()==PHP_SESSION_NONE){session_start();}
//Verificamos si se ha creado el login de session, que es un
//array
if(isset($_SESSION['info_user']) && $_SESSION['info_user[status]']==1){
    require_once('./view/crud/crud.php');
    die();
}else if(isset($_REQUEST['register'])){
    $User->userRegister();
}else{
    //Si no cumple la condicion iniciamos
    $User->LoginEnter();
}

```

Si no cumple con algunas de las condiciones le redirigimos a la funcion <i>LoginEnter()</i>, este se encarga de controlar la entrada de datos del usuario. Y para redigir a la vista del login, si existe un cambio y no concuerda con el código.
<br/>
<i>LoginEnter()</i> como bien hemos dicho es el controlador, del usuario.

```bash

public function LoginEnter(){
        //Verficamos si se encuentra en la base de datos
        $checked=false;
        if(!empty($_REQUEST['email']) && isset($_REQUEST['email'])){
            $_SESSION['login']['email']=$_REQUEST['email'];
            $checked=true;
        }else{
            $checked=false;
        }
        if(!empty($_REQUEST['password']) && isset($_REQUEST['password'])){
            $checked=true;
        }else{
            $checked=false;
        }
        if($checked && $this->ObjUser->checked_login($_REQUEST)){
            require_once('./view/crud/crud.php');
            die();
        }
        require('./view/login/login.view.php');
        die();
    }

```
