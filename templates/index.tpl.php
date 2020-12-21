<?php include 'header.tpl.php'; ?>
    <main role="main" class="inner cover">
        <div class="container">
            <div class="row titulo-principal">
                <div class="col-lg-12 text-center imgfon">

                    <div class="imagefont"></div>
                    <h1>Todo List</h1>

                </div>
            </div>
            <div class="row text-center inicio-links">
                <?php if(isset($_SESSION) && !empty($_SESSION['usuario']['id']) && !empty($_SESSION['usuario']['nombre'])): ?>
                <div class="col-lg-12">
                    <a class="ennav" href="<?=BASE;?>task/list">Ver tareas</a>
                </div>
            </div>
            <?php else: ?>
                <div class="col-lg-6">
                    <a class="ennav" href="<?=BASE;?>user/gologin">Iniciar sesion</a>

                </div>
                <div class="col-lg-6">
                    <a class="ennav" href="<?=BASE;?>user/goregister">Registrarse</a>
                </div>
            <?php endif; ?>
        </div>
        </div>
    </main>

<?php include 'footer.tpl.php'; ?>