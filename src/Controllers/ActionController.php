<?php


namespace App\Controllers;


use App\DB;

class ActionController
{

    public function doAction() {
        $db = DB::singleton();


        if(isset($_POST) && !empty($_POST['action']) && !empty($_POST['id'])) {

            $action = $_POST['action'];
            $idtask = $_POST['id'];



            switch($action) {
                case 1:
                    $sql = "UPDATE tareas SET acabado = true, fecha_entrega = CURDATE() WHERE id_tarea = :id_tarea";
                    break;
                case 2:
                    $sql = "DELETE FROM tareas WHERE id_tarea = :id_tarea";
                    break;
            }




            try {
                $query = $db->prepare($sql);
                $query->bindValue(":id_tarea", $idtask);
                $query->execute();
            }
            catch(Exception $e) {
                echo $e->getMessage();

            }

            header('Location: ' . BASE . 'task/list');
        }
    }

}