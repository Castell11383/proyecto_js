<?php include_once '../../includes/header.php' ?>
<div class="container mt-5 pt-3">
    <h1 class="text-center text-black">Registro de Aplicaciones</h1>
    <div class="row justify-content-center">
        <form id="form" class="col-lg-8 border bg-dark bg-gradient text-white text-center p-3 rounded shadow">
            <input type="hidden" name="app_id" id="app_id">
            <div class="row mb-3">
                <div class="col-6">
                    <label for="app_nombre">Nombre</label>
                    <input type="text" name="app_nombre" id="app_nombre" class="form-control" required>
                </div>
                <div class="col-3">
                    <label for="app_cantidad">Cantidad de Usuarios</label>
                    <input type="number" name="app_cantidad" id="app_cantidad" step="1" class="form-control" required>
                </div>
                <div class="col-3">
                    <label for="app_registro">Fecha de Registro</label>
                    <input type="datetime-local" name="app_registro" id="app_registro"  class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">

                <div class="col-3">
                    <label for="app_tipo">Tipo de Aplicación</label>
                    <select id="app_tipo" name="app_tipo" class="form-select" aria-label="Default select example" required>
                        <option value="">Select</option>
                        <option value="Controles">Controles</option>
                        <option value="Inventarios">Inventarios</option>
                        <option value="Bibliotecas">Bibliotecas</option>
                        <option value="Comercio">Comercio</option>
                        <option value="Asistencias">Asistencias</option>
                        <option value="Registros">Registros</option>
                        <option value="Rede Social">Redes Sociales</option>
                        <option value="Gestiones">Gestiones</option>
                        <option value="Aprendizaje">Aprendizaje</option>
                        <option value="Financiera">Financiera</option>
                        <option value="Salud">Salud</option>
                        <option value="Noticias">Noticias</option>
                        <option value="Viajes">Viajes</option>
                        <option value="Reservaciones">Reservaciones</option>
                        <option value="Juegos">Juegos</option>
                    </select>
                </div>

                <div class="col-3">
                    <label for="app_entrega">Fecha de Entrega</label>
                    <input type="datetime-local" name="app_entrega" id="app_entrega" class="form-control" required>
                </div>

                <div class="col-6">
                    <label for="app_dependencia">Dependencia</label>
                    <select id="app_dependencia" name="app_dependencia" class="form-select" aria-label="Default select example" required>
                        <option value="">Select</option>
                        <option value="Almacenes">Almacenes</option>
                        <option value="Comerciales">Comerciales</option>
                        <option value="Administradores">Administradores</option>
                        <option value="Centros Educativos">Centros Educativos</option>
                        <option value="Bancos">Bancos</option>
                        <option value="Empresas Civiles">Empresas Civiles</option>
                        <option value="Empresas del Estado">Empresas del Estado</option>
                        <option value="Secretarias">Secretarias</option>
                        <option value="Redes Sociales">Redes Sociales</option>
                        <option value="Capacitadoras">Capacitadoras</option>
                        <option value="Desarrolladoras">Desarrolladoras</option>
                        <option value="Hospitales">Hospitales</option>
                        <option value="Medios de Comunicacion">Medios de Comunicacion</option>
                        <option value="Agencias de Viajes">Agencias de Viajes</option>
                        <option value="Hoteleria">Hoteleria</option>
                        <option value="Restaurantes">Restaurantes</option>
                        <option value="Eventos">Eventos</option>
                        <option value="Entrenamiento">Entrenamiento</option>
                    </select>
                </div>

            </div>
            <div class="row mb-3">
                
                <div class="col">
                    <label for="app_descripcion">Descripcion de la Aplicacion</label>
                    <input type="text" name="app_descripcion" id="app_descripcion" class="form-control" required>
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
            <h2 class="text-center">Listado de Aplicaciones</h2>
            <table class="table table-bordered table-hover border-dark shadow" id="tablaAplicacion">
                <thead class="text-center table-dark">
                    <tr>
                        <th>No.</th>
                        <th>Nombre</th>
                        <th>Registro</th>
                        <th>Tipo</th>
                        <th>Dependencia</th>
                        <th>Entrega</th>
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
<script defer src="../../src/js/aplicacion/index.js"></script>

<?php include_once '../../includes/footer.php' ?>