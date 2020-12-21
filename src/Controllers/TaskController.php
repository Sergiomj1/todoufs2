<?php

namespace App\Controllers;

use App\Controller;
use App\Request;
use App\Session;
use App\DB;
use Exception;

class TaskController extends Controller
{

    public function __construct(Request $request, Session $session)
    {
        parent::__construct($request, $session);
    }

    public function index()
    {
        //task list for user

        //$tasks=$this->selectAll();
        $this->render();
    }

    public function new()
    {
        $this->render(null, 'newtask');
    }

    public function list()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

        $db = DB::singleton();

        // si $_SESSION existe y tiene un usuario guardado
        if (isset($_SESSION) && !empty($_SESSION['usuario'])) {
            $usuarioId = $_SESSION['usuario']['id']; // guardamos en $usuarioId el id del usuario
            $usuario = $_SESSION['usuario']['nombre']; // y guardamos en $usuario el nombre de usuario
        } else {
            // si no existe $_SESSION y no tiene un usuario
            echo '<h1>Deberias iniciar sesion antes de hacer nada</h1>'; // mostramos este error
            die; // y matamos el script justo qui
        }

        $result = [];

        try {
            $sql = "SELECT id_tarea, nombre, descripcion, acabado, fecha_creacion, fecha_entrega FROM tareas WHERE usuario = :usuario ORDER BY fecha_creacion DESC"; // query de las tareas
            $query = $db->prepare($sql); // preparamos la query
            $query->bindValue(":usuario", $usuarioId); // le asignamos un valor al parametro
            $query->execute(); // ejecutamos la query
            $result = $query->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        $this->render(['result' => $result, 'usuario' => $usuario], 'tasklist');
    }

    public function addTask()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

        $db = DB::singleton();
        $error = null;

        if (isset($_POST) && !empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['fechaEntrega'])) {
            // si $_POST existe y no estan vacios los campos
            $nombre = htmlspecialchars($_POST['nombre']); // recogemos el nombre
            $descripcion = htmlspecialchars($_POST['descripcion']); // recogemos la descripcion
            $fechaEntrega = $_POST['fechaEntrega']; // recogemos la fecha de entrega

            if (isset($_SESSION) && !empty($_SESSION['usuario']['id'])) {
                // si $_SESSIOn existe y no esta vacio
                $usuarioId = $_SESSION['usuario']['id']; // recogemos el id del usuario

                $sql = "INSERT INTO tareas (nombre, descripcion, fecha_creacion, fecha_entrega, usuario) VALUES (:nombre, :descripcion, CURDATE(), :fecha_entrega, :usuario)"; // sentencia para insertar la tarea
                // un '?' es un parametro
                try {
                    $query = $db->prepare($sql); // preparamos la query
                    $query->bindValue(":nombre", $nombre); // le damos los valores que vamos a insertar
                    $query->bindValue(":descripcion", $descripcion); // le damos los valores que vamos a insertar
                    $query->bindValue(":fecha_entrega", $fechaEntrega); // le damos los valores que vamos a insertar
                    $query->bindValue(":usuario", $usuarioId); // le damos los valores que vamos a insertar
                    $query->execute(); // ejecuta la query

                    if ($query->rowCount() == 1) {
                        // si se ha insertado una fila
                        header('Location: ' . BASE . 'task/list'); // vamos a la lista de tareas
                    }
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
            }
        }

        $this->render([ 'error' => $error ], 'addtask');
    }


    public function goaddTask(){

        $this->render(NULL, 'addtask');
    }

    private function task($id)
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

        $db = DB::singleton();

        // si $_SESSION existe y tiene un usuario guardado
        if (isset($_SESSION) && !empty($_SESSION['usuario'])) {
            $usuarioId = $_SESSION['usuario']['id']; // guardamos en $usuarioId el id del usuario
            $usuario = $_SESSION['usuario']['nombre']; // y guardamos en $usuario el nombre de usuario
        } else {
            // si no existe $_SESSION y no tiene un usuario
            echo '<h1>Deberias iniciar sesion antes de hacer nada</h1>'; // mostramos este error
            die; // y matamos el script justo qui
        }

        $result = [];

        try {
            $sql = "SELECT id_tarea, nombre, descripcion, acabado, fecha_creacion, fecha_entrega FROM tareas WHERE usuario = :usuario AND id_tarea = :id_tarea LIMIT 1"; // query de las tareas
            $query = $db->prepare($sql); // preparamos la query
            $query->bindValue(":usuario", $usuarioId); // le asignamos un valor al parametro
            $query->bindValue(":id_tarea", $id); // le asignamos un valor al parametro
            $query->execute(); // ejecutamos la query
            $result = $query->fetchAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        if (!empty($result)) {
            $result = reset($result);
        }

        return $result;
    }


    public function goedit(){


        $this->render(  NULL ,'edittask');

    }





    public function edit()
    {
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }

        $db = DB::singleton();
        $error = null;
        $params = $this->request->getParams();

        if (isset($_POST) && !empty($_POST['nombre']) && !empty($_POST['descripcion']) && !empty($_POST['fechaEntrega'])) {
            // si $_POST existe y no estan vacios los campos
            $nombre = htmlspecialchars($_POST['nombre']); // recogemos el nombre
            $descripcion = htmlspecialchars($_POST['descripcion']); // recogemos la descripcion
            $fechaEntrega = $_POST['fechaEntrega']; // recogemos la fecha de entrega
            $id_tarea = $_POST['id_tarea'];

            if (isset($_SESSION) && !empty($_SESSION['usuario']['id'])) {
                // si $_SESSIOn existe y no esta vacio
                $usuarioId = $_SESSION['usuario']['id']; // recogemos el id del usuario

                $sql = "UPDATE tareas SET nombre = :nombre, descripcion = :descripcion, fecha_entrega = :fecha_entrega WHERE usuario = :usuario AND id_tarea = :id_tarea"; // sentencia para insertar la tarea
                // un '?' es un parametro
                try {
                    $query = $db->prepare($sql); // preparamos la query
                    $query->bindValue(":nombre", $nombre); // le damos los valores que vamos a insertar
                    $query->bindValue(":descripcion", $descripcion); // le damos los valores que vamos a insertar
                    $query->bindValue(":fecha_entrega", $fechaEntrega); // le damos los valores que vamos a insertar
                    $query->bindValue(":usuario", $usuarioId); // le damos los valores que vamos a insertar
                    $query->bindValue(":id_tarea", $id_tarea); // le damos los valores que vamos a insertar
                    $query->execute(); // ejecuta la query

                    if ($query->rowCount() == 1) {
                        // si se ha insertado una fila
                        header('Location: ' . BASE . 'task/list'); // vamos a la lista de tareas
                    }
                } catch (Exception $e) {
                    $error = $e->getMessage();
                }
            }
        }

        $this->render([
            'error' => $error,
            'id_tarea' => $params['id'],
            'task' => $this->task($params['id']),
        ], 'edittask');
    }
}
