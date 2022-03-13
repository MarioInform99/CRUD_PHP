<!DOCTYPE html>
<html lang="es">
<?php require('./view/head_view.php');?>
<body class="container-fluid">
    <div class="col-6 contenedor_register">
        <div class="icon_login">
            <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="white"  viewBox="0 0 16 16">
                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z"/>
            </svg>
        </div>
        <form class="formulario" id="registerForm" method="POST" action=""> 
           <div class="form-group">
               <label for="name">
                   Nombre:
               </label>
                <input type="text"class="form-control" name="name" id="name" autocomplete="off" placeholder="Nombre usuario"/>
                <?php if(isset($msgError['name']) && !empty($msgError['name'])){
                            echo "<span class=\"red\">".$msgError['name']."</span>";
                        }
                ?>
           </div> <br/>
           <div class="form-group">
               <label for="email_regis">
                   Correo electronico:
               </label>
                <input type="text"class="form-control" name="email_regis" id="email_regis" autocomplete="off" placeholder="Correo electronico"/>
                <?php if(isset($msgError['email_regis']) && !empty($msgError['email_regis'])){
                            echo "<span class=\"red\">".$msgError['email_regis']."</span>";
                        }
                ?>
           </div> <br/>
           <div class="form-group">
               <label for="password_regis">
                   Contraseña:
               </label>
                <input type="password"class="form-control" name="password_regis" autocomplete="off" id="password_regis" placeholder="Contraseña"/>
                <?php if(isset($msgError['password_regis']) && !empty($msgError['password_regis'])){
                            echo "<span class=\"red\">".$msgError['password']."</span>";
                        }
                ?>
           </div><br/>
           <div class="form-group">
               <label for="repeat_password">
                   Repite la contraseña:
               </label>
                <input type="password" class="form-control" name="repeat_password" autocomplete="off" id="repeat_password" placeholder="Contraseña"/>
                <?php if(isset($msgError['repeat_password']) && !empty($msgError['repeat_password'])){
                            echo "<span class=\"red\">".$msgError['repeat_password']."</span>";
                        }
                ?>
            </div><br/>
            <a href="?">Volver al login</a>
            <input type="submit" class="btn_sub_regist"  name="register" value="Registrarse"/>
        </form>
    </div>
    <script src="./libs/index.js" type="module"></script>
</body>
</html>