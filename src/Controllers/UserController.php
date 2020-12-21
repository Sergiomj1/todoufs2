<?php

    namespace App\Controllers;
    
    use App\Controller;
    use App\DB;
    use App\Session;
    use App\Request;

    class UserController extends Controller
    {
        public function __construct(Request $request,Session $session){
            parent::__construct($request,$session);
        }





        //url = user/login
        function login(){
            $db = DB::singleton();
            $error = false;
            $result = [];

            if (isset($_POST) && !empty($_POST['nombre']) && !empty($_POST['pass'])) {
                if (session_status() != PHP_SESSION_ACTIVE) {
                    session_start();
                }

                $nombreUsuario = htmlspecialchars($_POST['nombre']); // recogemos el nombre de usuario
                $pass = md5(htmlspecialchars($_POST['pass'])); // y la contraseña encriptada en md5

                $sql = "SELECT id_usuario FROM usuarios WHERE nombre = :nombre AND password = :password";

                $query = $db->prepare($sql); // preparamos la query
                $query->bindValue(":nombre", $nombreUsuario); // le pasamos los parametros
                $query->bindValue(":password", $pass); // le pasamos los parametros
                $query->execute(); // ejecutamos la query

                // si la consulta devuelve 1 fila es que el usuario existe y su contraseña es valida
                if ($query->rowCount() == 1) {
                    $result = $query->fetchAll();
                    $result = reset($result);

                    $_SESSION['usuario']['id'] = $result['id_usuario']; // guardamos en la sesion el id de usuario
                    $_SESSION['usuario']['nombre'] = $nombreUsuario; // y el nombre de usuario

                    if (isset($_POST['recordar']) && $_POST['recordar'] == 1) {
                        // si se ha marcado la casilla de recordar la sesion
                        setCookie("password", $_POST['pass'], time() + (60 * 60 * 24 * 30)); //guardamos la id del usuario
                        setCookie("nombreUsuario", $nombreUsuario, time() + (60 * 60 * 24 * 30)); // guardamos el nombre de usuario
                    }

                    header('Location: ' . BASE); // lo trasladamos a la pantalla de tareas
                } else {
                    // si no existe el usuario
                    $error = true; // ponemos true esta variable para mostrar un error


                }
            }

            //aqui hago un array asociativo para que cuando entre al render pueda cojer las variables a los templates
            $this->render(['result' => $result, 'error' => $error], 'login');
        }
        function logout(){
            session_destroy();
            header('Location: ' . BASE);
        }


        public function register()
        {

            $db = DB::singleton();
            $error = null;

            if(isset($_POST) && !empty($_POST['username']) && !empty($_POST['pass']) && !empty($_POST['repass'])) {


                $usuario = htmlspecialchars($_POST['username']); // recogemos el nombre de usuarios
                $password = htmlspecialchars($_POST['pass']); // la contraseña
                $repassword = htmlspecialchars($_POST['repass']); // y la contraseña repetida

                try {
                    // si las contraseñas son iguales
                    if($password == $repassword) {
                        $md5password = md5($password); // la encriptamos en md5

                        $sql = "INSERT INTO usuarios (nombre, password) VALUES (:nombre, :password)";

                        $query = $db->prepare($sql); // preparamos la query
                        $query->bindValue(":nombre", $usuario); // le pasamos los parametros
                        $query->bindValue(":password", $md5password); // le pasamos los parametros
                        $query->execute(); // ejecutamos la query

                        // si el usuario se ha insertado a la base de datos (es decir affected_rows devuelve 1)
                        if($query->rowCount() == 1) {
                            session_start(); // iniciamos (o reiniciamos) la sesion
                            $_SESSION['signup_success'] = true;
                            header('Location: ' . BASE); // lo trasladamos a la pantalla de las tareas
                        }
                    }
                }
                catch(Exception $e) {
                    // si se provoca alguna excepcion
                    $error = $e->getMessage(); // guardamos el error en una variable
                    // El error se mostrara en una alerta de bootstrap
                }
            }

            $this->render([ 'error' => $error], 'register');

        }


        public function goregister(){


            $this->render(NULL, 'register');



        }

        public function gologin(){


            $this->render(NULL, 'login');


        }


        public function logged()
        {




        }



    }