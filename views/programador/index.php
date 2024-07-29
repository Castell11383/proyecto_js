<?php include_once '../../includes/header.php' ?>

<div class="container mt-5 pt-3">
    <h1 class="text-center">Registro de Programadores</h1>
    <div class="row justify-content-center">
        <form id="form" class="col-lg-8 border bg-dark bg-gradient text-white text-center p-3 rounded shadow">
            <input type="hidden" name="progra_id" id="progra_id">
            <div class="row mb-3">
                <div class="col-5">
                    <label for="progra_nombre">Nombre</label>
                    <input type="text" name="progra_nombre" id="progra_nombre" class="form-control" required>
                </div>
                <div class="col-5">
                    <label for="progra_apellido">Apellido</label>
                    <input type="text" name="progra_apellido" id="progra_apellido" class="form-control" required>
                </div>
                <div class="col-2">
                    <label for="progra_edad">Edad</label>
                    <input type="number" name="progra_edad" id="progra_edad" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-6">
                    <label for="progra_correo">Correo</label>
                    <input type="email" name="progra_correo" id="progra_correo" class="form-control" required>
                </div>
                <div class="col-6">
                    <label for="progra_direccion">Dirección</label>
                    <input type="text" name="progra_direccion" id="progra_direccion" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col">
                    <label for="progra_telefono">Teléfono</label>
                    <input type="number" name="progra_telefono" id="progra_telefono" class="form-control" required>
                </div>
                <div class="col-5">
                    <label for="progra_dependencia">Dependencia</label>
                    <select id="progra_dependencia" name="progra_dependencia" class="form-select" aria-label="Default select example" required>
                        <option value="">Select</option>
                        <option value="Desarrollo">Desarrollo</option>
                        <option value="Ciber">CiberSeguridad</option>
                        <option value="Redes">Redes</option>
                        <option value="BD">Base de Datos</option>
                        <option value="Sistemas">Sistemas</option>
                        <option value="Hardware">Hardware</option>
                    </select>
                </div>

                <div class="col">
                    <label for="progra_genero">Género</label>
                    <select id="progra_genero" name="progra_genero" class="form-select" aria-label="Default select example" required>
                        <option value="">Select</option>
                        <option value="masculino">Masculino</option>
                        <option value="femenino">Femenino</option>
                    </select>
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
            <h2 class="text-center">Listado de Programadores</h2>
            <table class="table table-bordered table-hover border-dark shadow" id="tablaProgramador">
                <thead class="text-center table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Nombre</th>
                        <th>Apellido</th>
                        <th>Dependencia</th>
                        <th>Modificar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="6">No hay Programadores disponibles</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script defer src="../../src/js/funciones.js"></script>
<script defer src="../../src/js/programador/index.js"></script>

<?php include_once '../../includes/footer.php' ?>