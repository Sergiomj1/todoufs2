<?php
    namespace App\Controllers;

        use App\Request;
        use App\Session;
        use App\Controller;

    final class IndexController extends Controller{

        public function __construct(Request $request,Session $session){
            parent::__construct($request,$session);
        }
        
        public function index(){
            $db=$this->getDB();
            $data=$db->selectAll('users');
            $username = null;

            if (session_status() != PHP_SESSION_ACTIVE) {
                session_start();
            }

            if (isset($_SESSION['usuario']['nombre'])) {
                $username = $_SESSION['usuario']['nombre'];
            }

            // uso de funciones declaradas en el modelo 
            // y definidas en la clase abstracta
            // $stmt=$this->query($db,"SELECT * FROM users ",null);
            
            $dataview=[ 'title'=>'Todo',
                         'data'=>$data, 'username' => $username];
            $this->render($dataview);
        }
       
        
    }