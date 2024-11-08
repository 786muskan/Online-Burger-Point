<!DOCTYPE html>
<html lang="en">

<head>
	<title>Admin Panel</title>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">


	
	<link href="../assets/css/app.css" rel="stylesheet">


	<link href="../assets/css/bootstrap.min.css" rel="stylesheet">
	<link href="../assets/css/bootstrap-theme.css" rel="stylesheet">
	<link href="../assets/css/jquery.dataTables.min.css" rel="stylesheet">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

	<!-- font awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
		
	<!-- css -->
	<link rel="stylesheet" type="text/css" href="../assets/css/icons.css">
	
	<link rel="stylesheet" type="text/css" href="../assets/css/add_c2.css">



	

	<style type="text/css">
		.sidebar-brand {
		    font-size: 2rem;
		}
		.sidebar-header{
		    font-size: 1rem;
		}
	</style>
</head>

<body>
	<div class="wrapper">

<?php 
	session_start();
	require_once("sidebar.php");
?>
<div class="main ">
	<nav class="navbar navbar-expand navbar-light navbar-bg navbar-right">
		<a class="sidebar-toggle js-sidebar-toggle" href="home.php">
          <i class="hamburger align-self-center"></i>
        </a>
				<a class="nav-link  d-none d-sm-inline-block" href="home.php" >
	            			<!-- <img src="../attachment/bw.png" class="img-fluid rounded me-1 sideImg"  />  -->

	            			<span class="text-dark h3"><?php echo $_SESSION['name']?></span>
	          			</a>
		<div class="navbar-collapse collapse col-xs-offset-8 col-md-offset-0" >
				<ul class="navbar-nav navbar-align navbar-right">
					<li class="nav-item  ">
						
<!-- image -->
<a class="nav-link  d-none d-sm-inline-block " href="logout.php">
			              <i class="icon "><img src="../attachment/icon_img/exit.png"  class="icon img-fluid" /></i> <span class="align-middle text-dark h4">Log Out</span>
			            </a>
						
						
					</li>
				</ul>
			</div>
	</nav>