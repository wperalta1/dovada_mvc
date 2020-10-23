<!-- Incluir el header -->
<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- Inicio del contenido de la página -->
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <h1 class="mb-5"><?php echo $data['title']; ?></h1>
            </div>
            <div class="col-md-6">
                <a href="<?php echo URLROOT; ?>/ordenanzas/alta" class="btn btn-primary pull-right"><i class="fa fa-plus-circle" aria-hidden="true"></i> Nueva Ordenanza</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12 card card-body">
            <?php notificar('ordenanzasAltaExito'); ?>
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped table-hover table-bordered bg-light text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Ord. N°</th>
                                <th>Descripción</th>
                                <th>Creado por:</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($data['ordenanzas'] as $ordenanza){
                                    echo '<tr>';
                                    echo '<td>'. $ordenanza['ordId'] .'</td>';
                                    echo '<td>'. $ordenanza['ordNro'] . '/' . $ordenanza['ordAño'] .'</td>';
                                    echo '<td>'. $ordenanza['ordDescripcion'] .'</td>';
                                    echo '<td>'. $ordenanza['usrNombre'] .'</td>';
                                    echo '<td><button data-ruta="'. $ordenanza['ordRuta'] .'" type="button" class="btn btn-info btnVerOrdenanza"><i class="fa fa-eye"></i></button></td>';
                                    echo '</tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<!-- /Fin del contenido de la página -->
<!-- Incluir el footer -->
<?php require APPROOT . '/views/inc/footer.php'; ?>

<script>
    $(document).ready(function() {
        // Inicializar datatable
        $('#dataTable').DataTable();

        // Abrir ordenanza en una nueva pestaña
        $('.btnVerOrdenanza').click(function() {
            /*var id = $('#btnVerOrdenanza').data('id');
            alert(id);*/
            var ruta = $(this).data('ruta');
            window.open('ordenanzasDigitales/' + ruta);
        });
    });
</script>