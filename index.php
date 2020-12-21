<?php

    ini_set('display_errors','On');
   

    require __DIR__.'/vendor/autoload.php';



//
    use App\App;

//phpinfo();

$conf=App::init();
//constants d'enrutament i BBDD
define('BASE',$conf['web']);
define('ROOT',$conf['root']);
define('DSN',$conf['driver'].':host='.$conf['dbhost'].';dbname='.$conf['dbname']);
define('USR',$conf['dbuser']);
define('PWD',$conf['dbpass']);

// incluir constantes extras
include 'settings.php';


    App::run();
    