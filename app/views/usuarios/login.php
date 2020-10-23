<!-- Incluir el header -->
<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- Inicio del contenido de la página -->
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card card-body bg-light mt-5">
                <?php notificar('usuariosAltaExito'); ?>
                <h2 class="text-center">Iniciar sesión</h2>
                <p class="text-center mb-3">Por favor complete el formulario para poder registrar su cuenta en el sistema.</p>

                <form action="<?php echo URLROOT; ?>/usuarios/login" method="POST">
                    <div class="form-group">
                        <label><b>Usuario: <span style="color: red;"><sup>*</sup></span></b></label>
                        <input name="txtUsername" type="text" class="form-control form-control-lg <?php echo (!empty($data['usernameError'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['username']; ?>">
                        <span class="invalid-feedback"><?php echo $data['usernameError']; ?></span>
                    </div>

                    <div class="form-group">
                        <label><b>Contraseña: <span style="color: red;"><sup>*</sup></span></b></label>
                        <input name="txtPassword" type="password" class="form-control form-control-lg <?php echo (!empty($data['passwordError'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['password']; ?>">
                        <span class="invalid-feedback"><?php echo $data['passwordError']; ?></span>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <input type="submit" value="Iniciar sesión" class="btn btn-success btn-block btn-lg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/usuarios/register" class="btn btn-light btn-block">¿No posee una cuenta? Regístrese</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- /Fin del contenido de la página -->
<!-- Incluir el footer -->
<?php require APPROOT . '/views/inc/footer.php'; ?>