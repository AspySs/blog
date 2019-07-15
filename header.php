<?php
session_set_cookie_params(23200);
session_start();

if((isset($_POST["done"]))&&(@$_SESSION["auth"] = true)){

$_SESSION["auth"] = false;
header("Location: index.php");

}

if((isset($_POST["done"]))&&(@$_SESSION["auth"] != true)){

header("Location: auth.php");
}

?>

<!DOCTYPE html>



<html <?php language_attributes(); ?>>

<head>

	<title><?php bloginfo( 'name' ); ?></title>

	<meta charset="<?php bloginfo( 'charset' ); ?>">

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/mobile.css">

	<link rel="stylesheet" type="text/css" href="<?php bloginfo('template_directory') ?>/css/style.css">

		<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">

	<link rel="pingback" href="<?php echo esc_url( get_bloginfo( 'pingback_url' ) ); ?>">

	<script type="text/javascript" src="<?php bloginfo('template_directory') ?>/js/script.js"></script>

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<div id="header-hr">

	<a href="#" id="mail-link">contact-us@mail.ru</a>

	<form action="<?php bloginfo('template_directory') ?>/reg.php" method="post" name = "acc" id="acc">
		<input class="sub" type="submit" name="reg" value="<?php  if(@$_SESSION["auth"] != true) { echo "Регистрация"; }else {echo @$_SESSION["name"];}  ?>">
	</form>
	<form action="" method="post" name = "acc" id="acc">
	<input class="sub" type="submit" name="done" value="<?php if(@$_SESSION["auth"] != true) { echo "Вход"; }else {echo "выход";} ?>"> 
	</form>



	</div>

	<div id="top-menu">

		<div id="logo"><?php bloginfo( 'name' ); ?></div>
<?php wp_nav_menu( array(
	'theme_location'  => '',
	'menu'            => '',
	'container'       => 'ul',
	'container_class' => '',
	'container_id'    => '',
	'menu_class'      => '',
	'menu_id'         => '',
	'echo'            => true,
	'fallback_cb'     => 'wp_page_menu',
	'before'          => '',
	'after'           => '',
	'link_before'     => '',
	'link_after'      => '',
	'items_wrap'      => '<ul id = "%1$s" class = "%2$s">%3$s</ul>',
	'depth'           => 0,
	'walker'          => '',
) ); ?> 
<!-- 			<ul>

	<li><a href="#">ГЛАВНАЯ</a></li>

	<li><a href="#">КУРСЫ</a></li>

	<li class="main">БЛОГ</li>

	<li><a href="#">ВОПРОСЫ И ОТВЕТЫ</a></li>

	<li><a href="#">О ПРОЕКТЕ</a></li>

	<li><a href="#">КОНТАКТЫ</a></li>

</ul> -->

	</div>

	<div id="blog">БЛОГ</div>