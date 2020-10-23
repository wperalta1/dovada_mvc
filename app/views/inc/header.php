<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap 4 files -->
    <link link rel="stylesheet" href="<?php echo URLROOT; ?>/vendor/bootstrap/css/bootstrap.css">

    <!-- Fontawesome CDN -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

    <!-- Datatables CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4/dt-1.10.22/datatables.min.css"/>

    <!-- Main CSS file -->
    <link rel="stylesheet" href="<?php echo URLROOT; ?>/css/main.css">

    <!-- Page title from CONFIG -->
    <title><?php echo SITENAME; ?></title>
</head>
<body>
<!-- Incluir el navbar -->
<?php require APPROOT . '/views/inc/navbar.php'; ?>
<div class="container">