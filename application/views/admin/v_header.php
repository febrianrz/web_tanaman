<!DOCTYPE html>
<html lang="en">
	<head>
		<base href="<?php echo base_url('assets/admin');?>/" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<!-- Meta, title, CSS, favicons, etc. -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<title>Ilmu Pengetahuan - <?php echo $this->session->userdata('nama');?></title>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="fonts/css/font-awesome.min.css" rel="stylesheet">
		<link href="css/animate.min.css" rel="stylesheet">
		<!-- Custom styling plus plugins -->
		<link href="css/custom.css" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="css/maps/jquery-jvectormap-2.0.3.css" />
		<link href="css/icheck/flat/green.css" rel="stylesheet" />
		<link href="css/floatexamples.css" rel="stylesheet" type="text/css" />
		<script src="js/jquery.min.js"></script>
		<script src="js/nprogress.js"></script>
		<!--[if lt IE 9]>
		<script src="../assets/js/ie8-responsive-file-warning.js"></script>
		<![endif]-->
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="nav-md">
		<div class="container body">
			<div class="main_container">
				<div class="col-md-3 left_col">
					<div class="left_col scroll-view">
						<div class="navbar nav_title" style="border: 0;">
							<a href="<?php echo $this->master->adminUrl('dashboard');?>" class="site_title"> <span><?php echo $this->master->getOption(1);?></span></a>
						</div>
						<div class="clearfix"></div>
						<!-- menu prile quick info -->
						<div class="profile">
							<div class="profile_pic">
								<img src="../frontend/uploads/logonya.jpg" alt="..." class="img-circle profile_img">
							</div>
							<div class="profile_info">
								<span>Selamat Datang,</span>
								<h2><?php echo $this->session->userdata('nama');?></h2>
							</div>
						</div>
						<!-- /menu prile quick info -->
						<br />
						<!-- sidebar menu -->
						<?php $this->load->view('admin/v_sidebar');?>
					</div>
				</div>
				<!-- top navigation -->
				<div class="top_nav">
					<div class="nav_menu">
						<nav class="" role="navigation">
							<div class="nav toggle">
								<a id="menu_toggle"><i class="fa fa-bars"></i></a>
							</div>
							<ul class="nav navbar-nav navbar-right">
								<li class="">
									<a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
										<i class="fa fa-user" style="font-size:2em"></i> &nbsp;&nbsp;<?php echo $this->session->userdata('nama');?>
									</a>
									<ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
<!--										<li>-->
<!--											<a href="javascript:;">  Profile</a>-->
<!--										</li>-->
<!--										<li>-->
<!--											<a href="javascript:;">-->
<!--											<span class="badge bg-red pull-right">50%</span>-->
<!--											<span>Settings</span>-->
<!--											</a>-->
<!--										</li>-->
										<li>
											<a href="<?php echo base_url('admin/setting/ubahpassword');?>">Ubah Password</a>
										</li>
											<li>
												<a href="<?php echo $this->master->adminUrl('login/logout');?>"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
											</li>
									</ul>
								</li>
							</ul>
						</nav>
					</div>
				</div>
				<div class="right_col" role="main">
