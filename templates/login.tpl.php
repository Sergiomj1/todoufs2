<?php

 $error= $dataview['error'];
include 'header.tpl.php';
?>
    <div class="container">
        <ol class="breadcrumb">
            <li><a href="<?=BASE;?>">Inicio</a></li>
            <li class="active">Iniciar sesion</li>
        </ol>
        <section class="row">
            <div class="col-lg-6 col-lg-offset-3">
                <h1 class="text-center">Iniciar Sesion</h1>
                <?php if(isset($error) && $error): ?>
                    <div class="alert alert-warning alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Oups!</strong> Nombre de usuario o contraseña incorrectos!
                    </div>
                <?php endif; ?>
                <form class="form" action="<?=BASE;?>user/login" method="post">
                    <label>Nombre</label><br />
                    <?php if(isset($_COOKIE) && !empty($_COOKIE['nombreUsuario'])): ?>
                        <input type="text" name="nombre" value="<?php echo $_COOKIE['nombreUsuario']; ?>" required /><br />
                    <?php else: ?>
                        <input type="text" name="nombre" required /><br />
                    <?php endif; ?>
                    <label>Contraseña</label><br />
                    <?php if(isset($_COOKIE) && !empty($_COOKIE['password'])): ?>
                        <input type="password" name="pass" value="<?php echo $_COOKIE['password']; ?>" required /><br />
                    <?php else: ?>
                        <input type="password" name="pass" required /><br />
                    <?php endif; ?>
                    <label>Recordarme</label>
                    <input style="width: 20px; height: 20px;" type="checkbox" name="recordar" value="1" /><br />
                    <input class="btn btn-default" type="submit" value="entrar" />
                </form>
            </div>
        </section>
    </div>

<?php include 'footer.tpl.php'; ?>