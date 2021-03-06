<?php include("db.php") ?>

<?php include("includes/header.php") ?>
<div class="container p-4">
    <div class="row">
        <div class="col-md-4">

            <?php if (isset($_SESSION['message'])) { ?>

                <div class="alert alert-<?= $_SESSION['message_type'] ?>  alert-dismissible fade show" role="alert">
                    <?= $_SESSION['message'] ?>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>

            <?php session_unset();
            } ?>

            <div class="card card-body">
                <form action="guardar_tarea.php" method="POST">
                    <div class="form-group">
                        <input type="text" name="name" class="form-control" placeholder="Nombre de Tarea">
                        <?php if (isset($_SESSION['errn'])) { ?>

                            <p class="error"><?= $_SESSION['errn'] ?>
                            <p>

                            <?php
                        } ?>
                    </div>
                    <div class="form-group">
                        <textarea name="description" class="form-control" rows="2" placeholder="Descripcion de Tarea"></textarea>
                        <?php if (isset($_SESSION['errd'])) { ?>

                            <p class="error"><?= $_SESSION['errd'] ?>
                            <p>

                            <?php session_unset();
                        } ?>
                    </div>
                    <input type="submit" class="btn btn-success w-100" name="save_task" value="Guardar">

                </form>
            </div>
        </div>

        <div class="col-md-8">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Fecha de Creacion</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $query = "SELECT *FROM task";
                    $result_tasks = mysqli_query($conn, $query);

                    while ($row = mysqli_fetch_array($result_tasks)) { ?>
                        <tr>
                            <td> <?php echo $row['name'] ?></td>
                            <td><?php echo $row['description'] ?></td>
                            <td><?php echo $row['created'] ?></td>
                            <td><a href="editar_tarea.php?id= <?php echo $row['id'] ?>" class="btn btn-primary"><i class="fas fa-edit"></i></a>
                                <a href="eliminar_tarea.php?id= <?php echo $row['id'] ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
                            </td>

                        </tr>


                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>

</div>

<?php include("includes/footer.php") ?>