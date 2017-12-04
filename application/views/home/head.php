<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Lasabunga</title>
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/assets/css/font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo base_url() ?>assets/assets/css/style.css">

	<script src="<?php echo base_url() ?>assets/assets/js/jquery-3.1.1.min.js"></script>
	<script src="<?php echo base_url() ?>assets/assets/js/bootstrap.min.js"></script>
</head>
<body>
	<div class="container">
		<div class="logo text-center">
			<!-- <img class="responsive-img" src="assets/assets/img/logo.png" alt=""> -->
			<h1>LASABUNGA</h1>
		</div>
		<div class="menu">
			<ul>
				<li><a class="<?php echo current_url() == base_url() ? 'active' : '' ?>" href="<?php echo base_url(); ?>">HOME</a></li>
				<li><a class="<?php echo current_url() == base_url('product') ? 'active' : '' ?>" href="<?= base_url('product'); ?>">OUR PRODUCT</a></li>
				<li><a class="<?php echo current_url() == base_url('about') ? 'active' : '' ?>" href="<?php echo base_url('about'); ?>">ABOUT</a></li>
				<li><a class="<?php echo current_url() == base_url('contact') ? 'active' : '' ?>" href="<?php echo base_url('contact'); ?>">CONTACT</a></li>
			</ul>
		</div>
