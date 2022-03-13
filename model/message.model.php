<?php
/**
 * Devolucion de errores con 
 * @author Mario 
 * @Class Message
 * 
 */
Class Message{
    //Creamos un array con los mensajes de error que nos apareciera 
    public  $msgError=array('register'=>array(
                                                'success'=>"Se ha registrado correctamente",
                                                'fail'=>array(
                                                'exist'=>"El usuario ya existe, verifique sus datos.",
                                                'name'=>"Nombre es un campo obligatorio",
                                                'email_regis'=>array('empty'=>"Correo no puede estar vacio",
                                                      'error'=>"Correo introducido no valido"),
                                                'password'=>array('empty'=>"La contraseña no puede estar vacia",
                                                                  'repeat_password'=>"Las contraseñas no coinciden"),
                                                'repeat_password'=>'Este campo no puede estar vacio'
                                                ),
                                            ),
                              'login'=>array('good'=>"Se ha iniciado sesión correctamente",
                                            'fail'=>"No se ha podido iniciar sesión")
                    );
    //Implementamos los mensajes de correcto o success
    public $msgSuccess=array(                    
                    'user'=>array('register'=>"Se ha registrado correctamente",
                            'login'=>"Se ha iniciado sesión correctamente")
                    );
    /**
     * Ha este metodo le pasamos un array con el nombre del input del error
     * @param array
     * @return array
     */
    public  function getMessageRegister($array=[],$request){
        define('TYPE','register');
        define('FAIL','fail');
        $msgFail=$this->msgError[TYPE][FAIL];
        $msgString=array();
        //Verificamos que los campos cumple los requisitos dichos
        if(isset($request['name']) && empty($request['name'])){
            $msgString["name"]=$msgFail['name'];
        }
        if(isset($request['email_regis']) && empty($request['email_regis'])){
            $msgString["email_regis"]=$msgFail['email_regis']['empty'];
        }
        if(isset($request['password_regis']) && empty($request['password_regis'])){
            $msgString['password']=$msgFail['password']['empty'];
        }
        if(isset($request['repeat_password']) && empty($request['repeat_password'])){
            $msgString['repeat_password']=$msgFail['repeat_password'];
        }
        return $msgString;
    }

}