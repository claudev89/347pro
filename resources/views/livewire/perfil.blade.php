<div class="row">
    <div class="col-12 col-md-3 bg-white me-3 mb-3 p-4 rounded">
        <div class="btn-group-vertical w-100" role="group" aria-label="Vertical button group">
            <button type="button" class="btn btn-outline-secondary text-dark text-start">Información básica</button>
            <button type="button" class="btn btn-outline-secondary text-dark text-start">Productos guardados</button>
            <button type="button" class="btn btn-outline-secondary text-dark text-start">Historial de compras</button>
        </div>
    </div>
    <div class="col-12 col-md-8 bg-white mb-3 p-4 rounded">
        <h5 class="fw-bold mb-3">PERFIL DE USUARIO</h5>
        <div class="row d-flex">
            <div class="col-12 col-md-4 mb-3 me-3 text-center">
                <div class="position-relative d-flex justify-content-center">
                    <img
                        src="{{ $usuario?->profile_photo_url }}"
                        class="w-100 rounded-pill img-thumbnail mb-2"
                        alt="Foto de perfil"
                        style="max-width: 20rem">
                </div>
                <button class="btn btn-primary mb-2 text-white"><i class="bi bi-camera"></i> Cambiar foto de perfil</button>
                <button class="btn btn-danger mb-2"><i class="bi bi-trash"></i> Eliminar foto de perfil</button>
            </div>
            <div class="col-12 col-md-7 mb-3">
                <form>
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" id="nombre" placeholder="Nombre">
                        <label for="nombre">Nombre</label>
                    </div>
                    <div class="form-floating mb-4">
                        <input type="email" class="form-control" id="email" placeholder="Correo electrónico">
                        <label for="email">Correo electrónico</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" id="actualPWD" placeholder="Contraseña actual">
                        <label for="actualPWD">Contraseña actual</label>
                    </div>
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" id="newPWD" placeholder="Contraseña nueva">
                        <label for="newPWD">Contraseña nueva</label>
                    </div>
                    <div class="form-floating">
                        <input type="password" class="form-control" id="newPWD2" placeholder="Correo electrónico">
                        <label for="newPWD2">Repetir contraseña</label>
                    </div>

                    <div class="text-end">
                        <button class="btn btn-primary mt-2 text-white">
                            <i class="bi bi-floppy"></i> Guardar Cambios
                        </button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
