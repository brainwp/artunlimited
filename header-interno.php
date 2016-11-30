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
<body <?php body_class(); ?>>
	<div class="overlay"></div>
	<div id="page" class="hfeed site site-home">
	<div id="portfolio-banner">
		<div class="barra-portfolio handle">
				<a class="etiqueta-barra-portfolio" data-show="false">
				</a>
		</div>
	</div><!-- #portfolio-banner -->
	<div class="slide-out-div" id="portfolio-container">	

			<div class="barra-portfolio handle" id="portfolio-open">
				<a id="portfolio-click" class="etiqueta-barra-portfolio" data-show="false">
				</a>
			</div>
			<div class="home-portfolio" id="portfolio-content">

				<div class="header-portfolio">
					<div id="busca-aba" class="portfolio">
						<div id="lupa-aba"></div>
						<form id="searchform" action="<?php echo get_home_url( ); ?>/" method="get">
							<input class="inlineSearch" type="text" name="s" value="<?php echo __('[:en]search[:pb]busca[:]'); ?>" onblur="if (this.value == '') {this.value = '<?php echo __('[:en]search[:pb]busca[:]'); ?>';}" onfocus="if (this.value == '<?php echo __('[:en]search[:pb]busca[:]'); ?>') {this.value = '';}" />
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
					'post_parent' => 0,
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
        	<a class="a-logo" href="<?php bloginfo( 'home' ); ?>"></a>
        </div><!-- #logo -->
                
        <div class="area-4-header">
              <div id="link-login">
        <a href="<?php echo get_site_url(); ?>/wp-admin/">
        	<div id="cadeado">
			</div><!-- #cadeado -->
			<spam class="link-tgl">			
				<?php echo __('[:en]Login Area[:pb]Acesso Restrito[:]');?>
			</span>
		</a>
        </div><!-- #link-login -->
        </div><!-- .area-4-header -->
		
		 <div class="area-3-header">
        
        <div id="linguas">
            <?php 	
            	if (function_exists('dynamic_sidebar')) {
					dynamic_sidebar('Widget no menu');
				} 
			?>
        </div><!-- #linguas -->
        </div><!-- .area-3-header -->
		
			<nav id="site-navigation" class="navigation-main" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '<ul class="menu"><li class="first-menu-item"></li>%3$s</ul>' ) ); ?>
		
		
		</nav><!-- #site-navigation -->

	<div class="botao-portfolio-menu">
		<a class="etiqueta-barra-botao-portfolio-menu" href="<?php echo get_home_url('index.php/portfolio'); ?>">
		</a>
	</div>
        
	</header><!-- #masthead -->


	<?php do_action( 'before' ); ?>

	<div id="main" class="site-main-home">
