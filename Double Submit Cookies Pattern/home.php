
<body>
<link rel="stylesheet" type="text/css" href="theme_result.css">
<link href="https://afeld.github.io/emoji-css/emoji.css" rel="stylesheet">

<h2>
<?php

require_once 'token.php';


$val = $_POST["token"];


if(isset($_POST['updatepost'])){
	if(token::checkToken($val,$_COOKIE['csrfCookie'])){
		echo "Hey ".$_POST['updatepost']." ";
		
	    
	}
	else{
	echo "wrong".$_COOKIE['csrfCookie'];
	}
}
?>

</h2>



</body>