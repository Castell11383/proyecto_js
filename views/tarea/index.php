<?php

require_once '../../models/Aplicacion.php';
require_once '../../models/Programador.php';

try {
    $programador = new Programador();
    $programadores = $programador->buscar();

} catch (PDOException $e) {
    $error = $e->getMessage();

} catch (Exception $e2) {
    $error = $e2->getMessage();
}

try {
    $aplicacion = new Aplicacion();
    $aplicaciones = $aplicacion->buscar();

} catch (PDOException $e) {
    $error = $e->getMessage();

} catch (Exception $e2) {
    $error = $e2->getMessage();
}

?>

<?php include_once '../../includes/header.php' ?>


<div class="container mt-5 pt-3">
    <h1 class="text-center">Registro de Tareas</h1>
    <div class="row justify-content-center">
        <form id="form" class="col-lg-8 border bg-dark bg-gradient text-white text-center p-3 rounded shadow">
            <input type="hidden" name="tarea_id" id="tarea_id">
            <div class="row mb-3">
                <div class="col-6">
                    <label for="tarea_programador">Programador</label>
                    <select name="tarea_programador" id="tarea_programador" class="form-select" required>
                        <option value="">Select</option>
                        <?php foreach ($programadores as $key => $programador) : ?>
                            <option value="<?= $programador['progra_id'] ?>"><?= $programador['progra_nombre'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>

                <div class="col-6">
                    <label for="tarea_aplicacion">Aplicacion</label>
                    <select name="tarea_aplicacion" id="tarea_aplicacion" step="1" class="form-select" required>
                        <option value="">Select</option>
                        <?php foreach ($aplicaciones as $key => $aplicacion) : ?>
                            <option value="<?= $aplicacion['app_id'] ?>"><?= $aplicacion['app_nombre'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>

            <div class="row mb-3">

                <div class="col">
                </div>

                <div class="col-6">
                    <label for="tarea_descripcion">Descripcion</label>
                    <select id="tarea_descripcion" name="tarea_descripcion" class="form-select" aria-label="Default select example" required>
                        <option value="">Select</option>
                        <option value="Desarrollo">Desarrollo</option>
                        <option value="Mantenimiento">Mantenimiento</option>
                        <option value="Creacion">Creación</option>
                        <option value="Modificacion">Modificación</option>
                        <option value="Actualizar">Actualizar</option>
                    </select>
                </div>

                <div class="col">
                </div>

            </div>

            <div class="row justify-content-center mb-3">
                <div class="col">
                    <button type="submit" id="btnGuardar" class="btn btn-primary w-100"><i class="bi bi-floppy-fill"></i> Registrar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnBuscar" class="btn btn-warning w-100"><i class="bi bi-binoculars-fill"></i> Buscar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnModificar" class="btn btn-warning w-100"><i class="bi bi-back"></i> Modificar</button>
                </div>
                <div class="col">
                    <button type="button" id="btnCancelar" class="btn btn-primary w-100"><i class="bi bi-x-octagon-fill"></i> Cancelar</button>
                </div>
                <div class="col">
                    <button type="reset" id="btnLimpiar" class="btn btn-success w-100"><i class="bi bi-stars"></i> Limpiar</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="container mt-5 pt-3">
    <div class="row justify-content-center">
        <div class="col-lg-8 table-responsive">
            <h2 class="text-center">Listado de Tareas</h2>
            <table class="table table-bordered table-hover border-dark shadow" id="tablaTarea">
                <thead class="text-center table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Programador</th>
                        <th>Aplicacion</th>
                        <th>Descripcion</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">No hay Tareas disponibles</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script defer src="../../src/js/funciones.js"></script>
<script defer src="../../src/js/tarea/index.js"></script>

<?php include_once '../../includes/footer.php' ?>