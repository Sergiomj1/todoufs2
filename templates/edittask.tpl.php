<?php

$error = $dataview['error'];
$id_tarea = $dataview['id_tarea'];
$task = $dataview['task'];
include 'header.tpl.php';
?>
<div class="container">
  <ol class="breadcrumb">
    <li><a href="<?=BASE;?>">Inicio</a></li>
    <li><a href="<?=BASE;?>task/list">Tareas de <?php echo $_SESSION['usuario']['nombre']; ?></a></li>
    <li class="active">Editar una tarea</li>
    </ol>
    <div class="row">
        <div class="col-lg-6 col-lg-offset-3">
            <h1 class="text-center">Editar una tarea</h1>
            <?php if(isset($error)): ?>
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <strong>Oups!</strong> <?php echo $error; ?>.
                </div>
            <?php endif; ?>
            <form class="form" action="<?=BASE;?>task/edit" method="post">
                <label>Nombre</label><br />
                <input type="text" name="nombre" required value="<?php echo $task['nombre']; ?>" /><br />
                <label>descripcion</label><br />
                <textarea name="descripcion" placeholder="Escribe aqui la descripcion de la tarea..." required><?php echo $task['descripcion']; ?></textarea><br />
                <label>Fecha de entrega</label><br />
                <input type="date" name="fechaEntrega" required value="<?php echo $task['fecha_entrega']; ?>" /><br /><br />
                <input type="hidden" name="id_tarea" value="<?php echo $id_tarea; ?>" /><br /><br />
                <input class="btn btn-success" type="submit" value="Actualizar tarea" />
            </form>
        </div>
    </div>
</div>

<?php include 'footer.tpl.php'; ?>