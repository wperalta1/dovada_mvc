<!-- Incluir el header -->
<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- Inicio del contenido de la página -->
    <div class="card card-body bg-light mt-5">
        <h2 class="text-center"><?php echo $data['title']; ?></h2>
        <p class="text-center mb-3">Formulario para cargar una nueva ordenanza digital.</p>

        <form action="<?php echo URLROOT; ?>/ordenanzas/alta" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label><b>Número de ordenanza: <span style="color: red;"><sup>*</sup></span></b></label>
                        <input name="txtNro" type="text" class="form-control <?php echo (!empty($data['nroError'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['nro']; ?>">
                        <span class="invalid-feedback"><?php echo $data['nroError']; ?></span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label><b>Año: <span style="color: red;"><sup>*</sup></span></b></label>
                        <input name="txtAño" type="text" class="form-control <?php echo (!empty($data['añoError'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['año']; ?>">
                        <span class="invalid-feedback"><?php echo $data['añoError']; ?></span>
                    </div>
                </div>
            </div>
            
            <div class="form-group">
                <label><b>Descripción: <span style="color: red;"><sup>*</sup></span></b></label>
                <input name="txtDescripcion" type="text" class="form-control <?php echo (!empty($data['descripcionError'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['descripcion']; ?>">
                <span class="invalid-feedback"><?php echo $data['descripcionError']; ?></span>
            </div>

            <div class="form-group mb-3">
                <label><b>Archivo PDF: <span style="color: red;"><sup>*</sup></span></b></label>
                <div class="custom-file">
                    <input name="pdfOrdenanza" id="pdfOrdenanza" id="customFile" type="file" class="custom-file-input <?php echo (!empty($data['ordenanzaError'])) ? 'is-invalid' : ''; ?>">
                    <label class="custom-file-label" for="customFile">Buscar archivo</label>
                </div>
                <span class="text-danger text-sm" style="font-size: 12.8px"><?php echo $data['ordenanzaError']; ?></span>
                <span class="form-text text-muted">Sólo se permiten archivos en formato PDF.</span>
            </div>

            <div class="row mt-4">
                <div class="col">
                    <input type="submit" value="Aceptar" class="btn btn-success btn-block">
                </div>
                <div class="col">
                    <a href="<?php echo URLROOT; ?>/ordenanzas/index" class="btn btn-secondary btn-block">Cancelar</a>
                </div>
            </div>
        </form>
    </div>
<!-- /Fin del contenido de la página -->
<!-- Incluir el footer -->
<?php require APPROOT . '/views/inc/footer.php'; ?>

<script>
    // Add the following code if you want the name of the file appear on select
    $(document).ready(function(){
        $(".custom-file-input").on("change", function() {
            var fileName = $(this).val().split("\\").pop();
            $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
        });
    });
</script>