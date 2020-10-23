<!-- Incluir el header -->
<?php require APPROOT . '/views/inc/header.php'; ?>
<!-- Inicio del contenido de la página -->
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h1 class="display-3"><?php echo $data['title']; ?></h1>
            <p class="lead"><?php echo $data['description']; ?></p>
            <p class="lead"><?php echo SITENAME . ' ' . APP_VERSION; ?></p>
        </div>
    </div>
<!-- /Fin del contenido de la página -->
<!-- Incluir el footer -->
<?php require APPROOT . '/views/inc/footer.php'; ?>