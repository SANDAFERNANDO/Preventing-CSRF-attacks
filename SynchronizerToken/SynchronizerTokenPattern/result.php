<?php

if(isset($_POST['username'],$_POST['password'])){
	$uname = $_POST['username'];
	$pwd = $_POST['password'];
	if($uname == 'sanda' && $pwd == '123'){
		echo 'Successfully logged in';
		session_start();
		$session_id = session_id();
		$myfile = fopen("Tokens.txt", "w") or die("Unable to open file!");
		$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
		$txt = $_SESSION['token'].",";

		fwrite($myfile, $txt);
		$session_id = session_id();
	
		setcookie('ssd',$session_id,time()+60*60*24*365,'/');
		$txt1 = $session_id."\n";
		fwrite($myfile, $txt1);
		fclose($myfile);

		//echo $_SESSION['token'];

		
	}
	else{
		echo 'Invalid Credentials';
		exit();
	}
	
}

?>


<!DOCTYPE html>
<html>
	<head>
		<title>Cross Site Request Forgery Protection</title>
			<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
	
	    
        $( document ).ready(function(){
            //Perform Ajax request.
            $.ajax({
                url: 'csrf.php',
                type: 'post',
				data: { 
					'sessionid': '<?php echo $_COOKIE['ssd']; ?>'
				},
                success: function(data){
                    console.log(data);
					document.getElementById("token_to_be_added").value = data;
					//document.getElementById("listAttributes").innerHTML = data;
					
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Ajax request failed: ' + xhr.responseText;
                    //$('#content').html(errorMsg);
                  }
            });
        });
		
    </script>
	</head>
	<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form p-l-55 p-r-55 p-t-178" action="home.php"   method="post">
					<span class="login100-form-title">
						<h1>Type Your Post</h1>
					</span>
                    
					
					<div class="wrap-input100 validate-input m-b-16" data-validate="Please enter your post">
						<input class="input100" type="text" name="updatepost" placeholder="Post">
						<span class="focus-input100"></span>
					</div>

					<div class="wrap-input100 validate-input" >
						<input class="input100" type="hidden" name="token" value="" id="token_to_be_added">
						<span class="focus-input100"></span>
					</div>

					<div class="text-right p-t-13 p-b-23">
						<span class="txt1">
							
						</span>


							
						
					</div>

					<div class="container-login100-form-btn">
						<button class="login100-form-btn">
							Update Post
						</button>
					</div>

					<div class="flex-col-c p-t-170 p-b-40">
						<span class="txt1 p-b-9">
							
						</span>

						
					</div>
				</form>
			</div>
		</div>
	</div>
	
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
