<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="<?php echo $this->config->item('charset'); ?>">
    <title><?php echo $titulo; ?></title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width">
    <link rel="shortcut icon" href="<?php echo base_url('assets/images/favicon.ico'); ?>">
    
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->

    <!-- page level plugin styles -->
    <?php foreach($css as $cssVal) { ?>
        <link rel="stylesheet" href="<?php echo base_url('assets/' . $cssVal); ?>.css">
    <?php }?>
    <!-- /page level plugin styles -->

    <!-- build:css({.tmp,app}) styles/app.min.css -->
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/bootstrap/dist/css/bootstrap.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/vendor/perfect-scrollbar/css/perfect-scrollbar.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/roboto.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/font-awesome.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/panel.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/feather.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/animate.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/urban.css'); ?>">
    <link rel="stylesheet" href="<?php echo base_url('assets/styles/urban.skins.css'); ?>">
<!-- endbuild -->

</head>

<body>


    <div class="app layout-fixed-header">

      
    