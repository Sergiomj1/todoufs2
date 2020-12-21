<?php

 $error= $dataview['error'];
include 'header.tpl.php';
 ?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?=BASE;?>">Inicio</a></li>
            <li class="active">Registrarse</li>
        </ol>
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <h1 class="text-center">Registrarse</h1>
                <?php if(isset($error) && !empty($error)): ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Oups!</strong> <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                <form class="form" action="<?=BASE;?>user/register" method="POST">
                    <label>Nombre de usuario</label><br />
                    <input type="text" name="username" required /><br />
                    <label>Contraseña</label><br />
                    <input type="password" name="pass" required /><br />
                    <label>Repetir contraseña</label><br />
                    <input type="password" name="repass" required /><br />
                    <input class="btn btn-default" type="submit" value="Registrarse" />
                </form>
            </div>
        </div>
    </div>
<?php include 'footer.tpl.php'; ?>
