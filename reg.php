<?php
session_set_cookie_params(43200);
session_start();
$salt = "ioyypQNDZs2o5tm"; //статик соль для пароля :)


if(@$_SESSION["auth"] != true){
if(isset($_POST["done"])){
	//делаем рефилл
	$_SESSION["nameREG"] = strip_tags($_POST["name"]);
	$_SESSION["pass1"] = strip_tags($_POST["pass1"]);
	$_SESSION["pass2"] = strip_tags($_POST["pass2"]);
	$_SESSION["mail"] = strip_tags($_POST["mail"]);
	//делаем рефилл

/// чистим еррорки
	$_SESSION["errorNAME"] = "";
	$_SESSION["errorMAIL"] = "";
	$_SESSION["errorPASS"] = "";
/// чистим еррорки


if($_POST["pass1"] == $_POST["pass2"]){

///режем теги
$mail = strip_tags($_POST["mail"]);
$pass = strip_tags($_POST["pass1"]);
$pass2 = strip_tags($_POST["pass2"]);
$name = strip_tags($_POST["name"]);
///режем теги
//проверка полей!
// обработка ошибок

if(($mail == null)||(!strpos($mail, "@")))
{
	$error_mail = "неправильно указана почта";
	$error= true;
} else {$error_mail = "";}

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

if(($pass2 == null)||(strlen($pass2) >18))
{
	$error_pass2 = "Пароль не может быть пустым или быть длиннее 18 знаков";
	$error= true;
} else {$error_pass2 = "";}

// обработка ошибок
//проверка полей!

// подключаемся кБД
$bd = new mysqli("localhost", "user7436_blogger", "blogger", "user7436_blog");
$bd -> query("SET NAMES 'utf8'");
// подключаемся кБД

//проверяем есть ли зарегистрированный пользователь с такой почтой
$result_set_mail = $bd -> query("SELECT `id` FROM `users` WHERE `mail`='".$mail."'");
$log = mailcheck($result_set_mail);
//проверяем есть ли зарегистрированный пользователь с такой почтой
if ($log != false)
{
	$error_mail = "данная почта уже зарегистрирована"; // создаем еррорку
}elseif($error != true)  {

//если такого нет, то регистрируем
$reg = $bd->query("INSERT INTO `users` (`id`, `name`, `pass`, `mail`, `date`) VALUES (NULL, '".$name."', '".md5($pass.$salt)."', '".$mail."', CURRENT_TIMESTAMP);");
$bd -> close();
//закрываем БД
if($reg)
{ 


	//убираем нахуй рефилл
	$_SESSION["nameREG"] = "";
	$_SESSION["pass1"] = "";
	$_SESSION["pass2"] = "";
	$_SESSION["mail"] = "";
	//убираем нахуй рефилл

// успешная регистрация, передаем авторизацию и имя, ну и еррорки убираем, ибо хуле нам

	$_SESSION["name"] = $name;
	$_SESSION["auth"] = true;
	$_SESSION["errorNAME"] = "";
	$_SESSION["errorMAIL"] = "";
	$_SESSION["errorPASS"] = "";
	header("Location: index.php");
	
}else{ 


    $error_name = "пользователь с таким ником уже зарегистрирован";
	//header('Location: reg.php');        
}

		}


}else {
    $error_pass2 = "пароли в полях не совпадают";
	//header('Location: reg.php');         
}

}
}else{header("Location: index.php");}


// запрашиваем айди пользователя с данной почтой
function mailcheck($result_set_mail){

	while(($row = $result_set_mail->fetch_assoc()) != false){
		return $row["id"];
		
	}
}




?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8" name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="./css/mobile.css">
	<link rel="stylesheet" type="text/css" href="./css/style.css">
	<title>Register</title>
</head>
<body id="reg">
	<div class = "auth">
	<form action="" method="post" name = "reg">
		<span>Почта: </span><input placeholder="example@mail.ru" class="textbox" name="mail" value="<?php echo $_SESSION["mail"]; ?>"></br><span style="color:red"><?php echo $error_mail; ?></span><br />
		<span>Логин: </span><input placeholder="Vanya335" class="textbox" name="name" value="<?php echo $_SESSION["nameREG"]; ?>"></br><span style="color:red"><?php echo $error_name; ?></span><br />
		<span>Пароль: </span><input placeholder="********" class="textbox" name="pass1" value="<?php echo $_SESSION["pass1"]; ?>"></br><span style="color:red"><?php echo $error_pass1; ?></span> <br />
		<span>Повтор пароля: </span><input placeholder="********" class="textbox" name="pass2" value="<?php echo $_SESSION["pass2"]; ?>"></br><span style="color:red"><?php echo $error_pass2; ?></span><br />
		<input class="sub" type="submit" name="done" value="Submit">
	</form>
	</div>
</body>
</html>