<?php
/**
* The Header for our theme.
* Displays all of the <head> section and everything up till <div id="main">
* @package artunlimited
*/
?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>><head><meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<link href='http://fonts.googleapis.com/css?family=Roboto:400,300,300italic,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Gentium+Book+Basic' rel='stylesheet' type='text/css'>
<?php wp_head(); ?>

</head>
<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
<div class="barra">
	<a class="barra" href="<?php echo home_url(); ?>">
    <div class="top-barra"></div>
    </a>
    <a class="a-etiqueta" href="<?php echo home_url('index.php/portfolio/'); ?>">
	<div class="etiqueta-barra-portfolio-archive"></div>
    </a>
</div><!-- .barra -->
<?php do_action( 'before' ); ?>
<div id="main" class="site-main">