<!-- Incluir el header -->
<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- Inicio del contenido de la página -->
    <div class="row">
        <div class="col-md-8 mx-auto">
            <div class="card card-body bg-light mt-5">
                <h2 class="text-center">Crear una nueva cuenta</h2>
                <p class="text-center mb-3">Por favor complete el formulario para poder registrar su cuenta en el sistema.</p>

                <form action="<?php echo URLROOT; ?>/usuarios/register" method="POST">
                    <div class="form-group">
                        <label><b>Nombre: <span style="color: red;"><sup>*</sup></span></b></label>
                        <!-- Si $data['nombreError] no está vacío, es decir que tiene un error, asignarle la clase is-invalid al input para mostrarlo en rojo. -->
                        <input name="txtNombre" type="text" class="form-control form-control-lg <?php echo (!empty($data['nombreError'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['nombre']; ?>">
                        <span class="invalid-feedback"><?php echo $data['nombreError']; ?></span>
                    </div>

                    <div class="form-group">
                        <label><b>Correo electrónico: <span style="color: red;"><sup>*</sup></span></b></label>
                        <input name="txtEmail" type="email" class="form-control form-control-lg <?php echo (!empty($data['emailError'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['email']; ?>">
                        <span class="invalid-feedback"><?php echo $data['emailError']; ?></span>
                    </div>

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

                    <div class="form-group">
                        <label><b>Confirmar contraseña: <span style="color: red;"><sup>*</sup></span></b></label>
                        <input name="txtConfirmPassword" type="password" class="form-control form-control-lg <?php echo (!empty($data['confirmPasswordError'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['confirmPassword']; ?>">
                        <span class="invalid-feedback"><?php echo $data['confirmPasswordError']; ?></span>
                    </div>

                    <div class="row mb-3">
                        <div class="col">
                            <input type="submit" value="Registrar" class="btn btn-success btn-block btn-lg">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="<?php echo URLROOT; ?>/usuarios/login" class="btn btn-light btn-block">¿Ya posee una cuenta? Inicie sesión</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
<!-- /Fin del contenido de la página -->
<!-- Incluir el footer -->
<?php require APPROOT . '/views/inc/footer.php'; ?>