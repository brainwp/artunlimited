<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package artunlimited
 */
?>
<!DOCTYPE html>
<!--[if lt IE 7 ]> <html class="ie ie6 lte-ie6"> <![endif]-->
<!--[if IE 7 ]>    <html class="ie ie7 lte-ie7"> <![endif]-->
<!--[if IE 8 ]>    <html class="ie ie8 lte-ie8"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html <?php language_attributes(); ?> class="js no-flexbox flexbox-legacy canvas canvastext webgl no-touch geolocation postmessage no-websqldatabase indexeddb hashchange history draganddrop websockets rgba hsla multiplebgs backgroundsize borderimage borderradius boxshadow textshadow opacity cssanimations csscolumns cssgradients no-cssreflections csstransforms csstransforms3d csstransitions fontface generatedcontent video audio localstorage sessionstorage webworkers applicationcache svg inlinesvg smil svgclippaths pointerevents"><!--<![endif]-->
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,400italic,500,500italic,700,700italic' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Gentium+Book+Basic' rel='stylesheet' type='text/css'>
	<!--[if lt IE 9 ]><script src="/lib/respond.min.js"></script><![endif]-->
	<?php wp_head(); ?>
</head>

<?php
global $current_user;
get_currentuserinfo();
if ( is_user_logged_in() ) {
	$d = 'ol&aacute;, '.  $current_user->user_login .'!';
} else {
	$d = 'acesso restrito';
}
?>

<body <?php body_class(); ?>>
	<div class="overlay"></div>
	<div id="page" class="hfeed site site-home">
	<div class="slide-out-div" id="portfolio-container">	

			<div class="barra-portfolio handle">
				<a href="javascript:scroll_to('#page');" id="portfolio-click" class="etiqueta-barra-portfolio" data-show="false">
				</a>
			</div>
			<div class="home-portfolio" id="portfolio-content">

				<div class="header-portfolio">
					<div id="busca-aba" class="portfolio">
						<div id="lupa-aba"></div>
						<form id="searchform" action="<?php bloginfo('url'); ?>/" method="get">
							<input class="inlineSearch" type="text" name="s" value="busca" onblur="if (this.value == '') {this.value = 'busca';}" onfocus="if (this.value == 'busca') {this.value = '';}" />
							<input type="hidden" name="post_type" value="portfolio" /> 
							<!-- <input class="inlineSubmit" id="searchsubmit" type="submit" alt="Search" value="Buscar" /> -->
						</form>
					</div><!-- #busca-aba -->
				</div><!-- .header-categories -->

				<?php
				/* $paged é a variável para paginação do Loop CPT Projetos */	$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

				/* $args_loop_cpt_projetos são os argumentos para o Loop */
				$args_loop_cpt_projetos = array(
					'post_type' => 'portfolio',
					'orderby' => 'date',
					'order' => 'DESC',
					'posts_per_page' => '66',
					'paged' => $paged
					);
				$loop_cpt_projetos = new WP_Query( $args_loop_cpt_projetos ); if ( $loop_cpt_projetos->have_posts() ) {
					while ( $loop_cpt_projetos->have_posts() ) : $loop_cpt_projetos->the_post();
					?>

					<div class="cada-projeto">

						<div class="thumb-cada-projeto">
							<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('thumb-projetos'); ?></a>
						</div><!-- .thumb-cada-projeto -->

						<div class="rodape-cada-projeto">
							<h3><a class="titulo-resumo" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
							<span class="data-cada-post"><?php the_time( 'Y' ); ?></span>
						</div><!-- .rodape-cada-projeto -->
					</div><!-- .cada-projeto -->

					<?php
							// Fim do Loop
					endwhile;
				}
				?>

			</div> <!-- .home-portfolio -->


		</div>
		<header id="masthead" class="site-header" role="banner">

			<div id="logo">
				<a class="a-logo" href="javascript:scroll_to('#page');"></a>
			</div><!-- #logo -->

			<div class="area-4-header">
				<div id="link-login">
					<div id="cadeado"></div><!-- #cadeado -->
					<div id="form-login" class="tgl">	
						<?php if (!(current_user_can('level_0'))){ ?>
						<form action="<?php bloginfo( 'home' ); ?>/wp-login.php" method="post">
							<div class="linha-form">
								<div class="linha-form-a-login">Login</div>
								<div class="linha-form-b"><input type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20" />
								</div>
							</div>

							<div class="linha-form">
								<div class="linha-form-a-senha">Senha</div>
								<div class="linha-form-b"><input type="password" name="pwd" id="pwd" size="15" /><input type="submit" name="submit" value="ok" class="button" /></div>
							</div>
							<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
						</form>
						<a href="<?php bloginfo( 'home' ); ?>/wp-login.php?action=lostpassword">Esqueceu a Senha?</a>
						<?php } else { ?>
						<div class="linha-form-logada">				
							<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Sair">Sair</a>
							<a href="<?php bloginfo( 'home' ); ?>/wp-admin/">Admin</a>
						</div>
						<?php }?>
					</div><!-- #form-login -->
				</div><!-- #link-login -->
			</div><!-- .area-4-header -->

			<div class="area-3-header">
				<div id="redes">
					<div id="facebook">
						<a class="a-redes" href="<?php echo get_option( 'mo_facebook' ); ?>"></a>
					</div><!-- #facebook -->

					<div id="linkedin">
						<a class="a-redes" href="<?php echo get_option( 'mo_linkedin' ); ?>"></a>
					</div><!-- #linkedin -->
				</div><!-- #redes -->

				<div id="linguas">
					<div id="en">
						<a class="a-linguas" href=""></a>
					</div><!-- #en -->

					<div id="pt">
						<a class="a-linguas" href=""></a>	
					</div><!-- #pt -->
				</div><!-- #linguas -->
			</div><!-- .area-3-header -->


			<nav id="site-navigation" class="navigation-main" role="navigation">
				<?php  // wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '<ul class="menu"><li class="first-menu-item"></li>%3$s</ul>' ) ); ?>

				<ul class="menu">
					<li class="first-menu-item menu-item menu-item-type-post_type menu-item-object-page menu-item-336" id="menu-item-336"><a href="javascript:scroll_to('#nav-quem-somos');">Quem Somos</a></li>
					<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-30" id="menu-item-30"><a href="javascript:scroll_to('#nav-premios');">Pr&ecirc;mios</a></li>
					<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-28" id="menu-item-28"><a href="javascript:scroll_to('#nav-clientes-parceiros');">Clientes e Parceiros</a></li>
					<li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-288" id="menu-item-288"><a href="javascript:scroll_to('#nav-noticias');">Not&iacute;cias</a></li>
					<li class="last-menu-item menu-item menu-item-type-post_type menu-item-object-page menu-item-29" id="menu-item-29"><a href="javascript:scroll_to('#nav-contatos');">Contatos</a></li>
				</ul>

			</nav><!-- #site-navigation -->
			
			<div class="botao-portfolio-menu">
				<a class="etiqueta-barra-botao-portfolio-menu" href="<?php echo home_url('portfolio'); ?>">
				</a>
			</div>

		</header><!-- #masthead -->


		<?php do_action( 'before' ); ?>

		<div id="main">
