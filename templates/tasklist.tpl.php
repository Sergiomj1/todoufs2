<?php include 'header.tpl.php'; ?>
<?php
 // ['result' => $result, 'usuario' => $usuario]
    $result = $dataview['result'];
    $usuario = $dataview['usuario'];
?>

<div class="container">
    <ol class="breadcrumb">
        <li><a href="<?=BASE;?>">Inicio</a></li>
        <li class="active">Tareas de <?php echo $usuario; ?></li>
    </ol>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <a class="btn btn-default" href="<?=BASE;?>task/addTask" style="margin-bottom: 10px;s"><span class="glyphicon glyphicon-plus"></span> Añadir nueva tarea</a>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <?php if(count($result) > 0): ?>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Fecha de creacion</th>
                            <th>Fecha de entrega</th>
                            <th>Estado</th>
                            <th>Opciones</th>
                        </tr>
                        <?php foreach($result as $row): ?>
                            <tr>
                                <td><?php echo $row['nombre']; ?></td>
                                <td><p class="descripcion"><?php echo $row['descripcion']; ?></p></td>
                                <?php $fechaCreacion = new DateTime($row['fecha_creacion']); ?>
                                <td><?php echo $fechaCreacion->format('d-m-Y'); ?></td>
                                <?php $fechaEntrega = new DateTime($row['fecha_entrega']); ?>
                                <td><?php echo $fechaEntrega->format('d-m-Y'); ?></td>
                                <?php if(!$row['acabado']): ?>
                                    <td>
                                        <form action="<?=BASE;?>action/doAction" method="post">
                                            <label>En curso</label>
                                            <input type="hidden" name="action" value="1" />
                                            <input type="hidden" name="id" value="<?php echo $row['id_tarea']; ?>" />
                                            <button class="btn btn-default" type="submit">
                                                <span class="glyphicon glyphicon-flag"></span> Acabar tarea
                                            </button>
                                        </form
                                    </td>
                                <?php else: ?>
                                    <td>Terminado</td>
                                <?php endif; ?>
                                <td class="text-center">
                                    <form action="<?=BASE;?>action/doAction" method="post">
                                        <input type="hidden" name="action" value="2" />
                                        <input type="hidden" name="id" value="<?php echo $row['id_tarea']; ?>" />
                                        <button class="btn btn-danger" type="submit">
                                            <span class="glyphicon glyphicon-trash"></span>
                                            Eliminar
                                        </button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-default" href="<?=BASE;?>task/edit/id/<?php echo $row['id_tarea']; ?>">
                                        <span class="glyphicon glyphicon-edit"></span>
                                        Editar
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
            <?php else: ?>
                <h1 class="text-center">No tienes tareas :(</h1>
                <p class="text-center">Prueba a <a href="<?=BASE;?>task/addTask">crear una tarea nueva</a></p>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include 'footer.tpl.php'; ?>
