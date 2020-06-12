<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title><?php echo $title; ?> | <?php $sitetitle = $this->db->get('site')->result(); echo $sitetitle[0]->title ?></title>
    <?php $icon = $this->db->get('site')->result(); ?>
    <link rel="icon" href="<?php echo base_url('files/site/'.$icon[0]->icon) ?>">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Toastr -->
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/toastr/toastr.min.css">
    <!-- datatables -->
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>plugins/datatables-bs4/css/dataTables.bootstrap4.css">

    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url('assets/') ?>dist/css/adminlte.min.css">
    <!-- Google Font: Source Sans Pro -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>

<body class="hold-transition <?php if($this->session->userdata('level')=="Peminjam"){ echo "layout-top-nav"; }elseif(current_url()==base_url('publik')){ echo 'layout-top-nav'; }else{ echo "sidebar-mini layout-fixed"; } ?>">
    <div class="wrapper">
        <?php if($this->session->userdata('level')=="Admin"){ ?>
            <?php $this->load->view('templates/navbar'); ?>
            <?php $this->load->view('templates/sidebar'); ?>
        <?php } ?>
        <?php $this->load->view('ekstra/modal'); ?>