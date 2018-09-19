<?php

if(isset($_POST['username'],$_POST['password'])){
	$uname = $_POST['username'];
	$pwd = $_POST['password'];
	if($uname == 'sanda' && $pwd == '123'){
		echo 'Successfully logged in';
		session_start();
		$myfile = fopen("Tokens.txt", "w") or die("Unable to open file!");
		$_SESSION['token'] = base64_encode(openssl_random_pseudo_bytes(32));
		$txt = $_SESSION['token'].",";

		fwrite($myfile, $txt);
		$session_id = session_id();
		//$session_id = 1234;
		setcookie('sse1',$session_id,time()+60*60*24*365,'/');
		$txt1 = $session_id."\n";
		fwrite($myfile, $txt1);
		fclose($myfile);

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
				data: { 
					'sessionid': '<?php echo $_COOKIE['sse1']; ?>'
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
        <link rel="stylesheet" type="text/css" href="theme_result.css">
        <form action="home.php" method="post">
			<div class="login">
				<h1>Type Something</h1>
					<div class="credentials">
							Post: <input type="text" name="updatepost">
					</div>
					<input type="Submit" value="updatepost">
					<div id="div1">
					<input type="text" name="token" value="" id="token_to_be_added"/>
					</div>
			</div>
		</form>
	</body> 
</html>
