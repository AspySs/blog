<?php
session_set_cookie_params(43200);
session_start();
$salt = "ioyypQNDZs2o5tm"; // статичная соль для пароля

//проверяем нажата ли кнопка выхода
if((isset($_POST["done"]))&&($_SESSION["auth"] = true)){

$_SESSION["auth"] = false;
session_unset();
session_destroy();
header("Location: index.php");
}


//проверяем нажата ли кнопка залогиниться

if((isset($_POST["log"]))&&($_SESSION["auth"] != true)){
	//ERROR
$errorAUTH = "";


//FILL
$_SESSION["nameAUTH"] = strip_tags($_POST["nameAU"]);
$_SESSION["passAUTH"] = strip_tags($_POST["passAU"]);
//FILL

$name = strip_tags($_POST["nameAU"]);
$pass = strip_tags($_POST["passAU"]);

if(($name == null)||(strpos($name, "@"))||(strpos($name, "/")||(strpos($name, "!")||(strpos($name, "*")||(strpos($name, "$")||(strpos($name, "#"))||(strlen($name) >15))))))
{
	$error_name = "ник не должен содержать спец. знаков или должен быть длинной менее 15ти знаков";
	$error= true;
} else {$error_name = "";}

if(($pass == null)||(strlen($pass) >18))
{
	$error_pass1 = "Пароль не может быть пустым или быть длиннее 18 знаков";
	$error= true;
} else {$error_pass1 = "";}




	$bd = new mysqli("localhost", "user7436_blogger", "blogger", "user7436_blog");
	$bd -> query("SET NAMES 'utf8'");
	$result_set = $bd -> query("SELECT `pass` FROM `users` WHERE `name`= '".$name."'");
	$maybePass = vivod($result_set);
	$bd -> close();
	if(($result_set == true)&&($maybePass == md5($pass.$salt))&&($error == false)) {

		$_SESSION["auth"] = true;
		$_SESSION["name"] = $name;
		header("Location: index.php");


	}else{
	//$_SESSION["i"] = $i;
	 $errorAUTH = "неправильный логин или пароль";

	 } 


	

}

//запрашиваем пароль из базы

function vivod($result_set){

	while(($row = $result_set->fetch_assoc()) != false){
		return $row["pass"];
		
	}
}





?>




<!DOCTYPE html>
<script type=”text/javascript”>
<?php
      if ( $errorAUTH = ""){
          echo "var error1 = true;";
      }

 ?>
	if (error1 = true) {
		alert("ERROR!!");
	}
	else {
		alert("It's OK");
	}

</script>
<html>

<head>

	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">

	<link rel="stylesheet" type="text/css" href="./css/mobile.css">

	<link rel="stylesheet" type="text/css" href="./css/style.css">

	<title>Authentication</title>

</head>

<body id="auth">

	<div class = "auth">

	<form action="" method="post" name = "auth">

		<span>Логин: </span><input placeholder="Vasya1" class="textbox" name = "nameAU" value="<?php echo @$_SESSION["nameAUTH"]; ?>"></br><span style="color:red"><?php echo $error_name; ?></span></br>
		<span>Пароль: </span><input placeholder="********" class="textbox" name = "passAU" value="<?php echo @$_SESSION["passAUTH"]; ?>"></br><span style="color:red"><?php if ($error != true){echo $errorAUTH;} echo $error_pass1."</br>"; ?></span></br>

		<input class="sub" type="submit" name="log" value="Submit">

	</form>

	</div>

</body>

</html>