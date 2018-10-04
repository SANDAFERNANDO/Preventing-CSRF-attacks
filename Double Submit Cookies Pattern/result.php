<?php


if(isset($_POST['username'],$_POST['password'])){
	$uname = $_POST['username'];
	$pwd = $_POST['password'];
	if($uname == 'sanda' && $pwd == '123'){
		echo 'Successfully logged in';
		session_start();
		$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
		$session_id = session_id();
		setcookie('sessionCookie',$session_id,time()+60*60*24*365,'/');
		setcookie('csrfCookie',$_SESSION['token'],time()+60*60*24*365,'/');
		

		echo $_SESSION['token'];	
		
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
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script>
	$( document ).ready(function(){
            //Perform Ajax request.
            $.ajax({
                url: 'csrf.php',
                type: 'post',
				
                success: function(data){
                    console.log(data);
					document.getElementById("token_to_be_added").value = data;
					
					
					
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    var errorMsg = 'Ajax request failed: ' + xhr.responseText;
                    
                  }
            });
        });

	
	
</script>
    <link rel="stylesheet" type="text/css" href="theme_result.css">

    </head>
	<body>
		<form action="home.php" method="post">
			<div class="login">
				<h1>Type Something</h1>
					<div class="credentials">
							Post: <input type="text" name="updatepost">
					</div>
					<input type="Submit" value="updatepost">
					
					<div id="div1" >
					SESSION
					<input type="text" name="token1" value="<?php echo $_COOKIE['sessionCookie']; ?>" id="sessionCookie"/>
					</div>
					<div id="div1"> 
					CSRF
					<input type="text" name="token" value="" id="token_to_be_added"/>
					</div>
			</div>
		</form>
	</body> 
</html>
