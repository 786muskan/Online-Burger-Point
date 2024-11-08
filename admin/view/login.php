<?php 
	session_start();
	include('../controller/login_controller.php');
	$obj =  new LoginController();
	$error="";
	if(isset($_REQUEST['submit'])){
	
		$res=$obj->CheckUserController($_REQUEST['username'],$_REQUEST['pass']);
		
		if($res!=null){
			$_SESSION['name'] = $res['name'];
			
			header("location:home.php");
		}
		else{
				$error="Please enter valid username or password";
		}
	}
	elseif (isset($_REQUEST['change'])) {
		$res=$obj->CheckKeyController($_REQUEST['sk'],$_REQUEST['usernames']);
		
		
	}

?>
<!doctype html>
<html lang="en">
  <head>
  	<title>Admin Login form</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	
	<link rel="stylesheet" href="../assets/css/style.css">



	</head>
	<body class="img js-fullheight" style="background-image: url(../attachment/login_image/bg5.jpg);">
	<section class="ftco-section" >
		<div class="container" id="login-section">
			
			<div class="row justify-content-center">
				<div class="col-md-6 col-lg-4">
					<div class="login-wrap p-0">
		      	<h3 class="mb-4 text-center">Login Form</h3>
		      	<form action="#" class="signin-form" id="loginForm" method="post">
		      		<div class="form-group">
		      			<input type="text" class="form-control usernames" placeholder="Username" required name="username"  >
		      			
		      		</div>
	            <div class="form-group">
	              <input  type="password" class="form-control password" placeholder="Password" required 
	              minlegth="4" name="pass">
	              <span class="text-danger"> <?php echo $error ?></span>
	            </div>
	            <div class="form-group">
	            	<button type="submit" class="form-control btn btn-light submit px-3" name="submit" >Log In</button>
	          	</div>
	          </form>
		      </div>
				</div>
			</div>
		</div>

	</section>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    
	</body>

</html>
