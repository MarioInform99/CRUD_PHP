<!DOCTYPE html>
<html lang="es">
<?php require('./view/head_view.php');?>
<body class="container-fluid">
    <div class="col-6 contenedor">
        <div class="icon_login">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white"  viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
            </svg>
        </div>
        <form class="formulario" id="login" method="POST" action=""> 
           <div class="form-group">
                <input type="text"class="form-control" name="email" id="email" placeholder="Correo electronico"/>
           </div> <br/>
           <div class="form-group">
                <input type="password"class="form-control" name="password" id="password" placeholder="Contraseña"/>
           </div><br/>
            <input type="submit" class="btn_sub" value="Entrar"/>
        </form>
    </div>

</body>
</html>