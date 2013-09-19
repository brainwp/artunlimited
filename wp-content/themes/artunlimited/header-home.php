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

<script type="text/javascript">

    jQuery(function() {
	    if (jQuery('.scroll-pane').length)
	        jQuery('.scroll-pane').jScrollPane();
	    if (jQuery('.scroll-panes').length)
            jQuery('.scroll-panes').jScrollPane();
    });

    jQuery.fn.toggleText = function(a,b) {
	    return this.html(this.html().replace(new RegExp("("+a+"|"+b+")"),function(x){return(x==a)?b:a;}));
	}

	jQuery(document).ready(function(){
	    jQuery('.tgl').before('<span class="link-tgl">Acesso Restrito</span>');
	    jQuery('.tgl').css('display', 'none')
	    jQuery('span', '#link-login').click(function() {
	        jQuery(this).next().slideToggle('slow')
                .siblings('.tgl:visible')
                .slideToggle('fast');
            // aqui começa o funcionamento do plugin
	        jQuery(this).toggleText('Acesso Restrito','Fechar')
	            .siblings('span').next('.tgl:visible').prev()
	            .toggleText('Acesso Restrito','Fechar')
	    });
    });

</script>
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

<div id="page" class="hfeed site">

	<header id="masthead" class="site-header" role="banner">
		        
        <div id="logo">
        	<a class="a-logo" href="<?php bloginfo( 'home' ); ?>"></a>
        </div><!-- #logo -->

		<nav id="site-navigation" class="navigation-main" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'items_wrap' => '<ul><li class="first-menu-item"></li>%3$s</ul>' ) ); ?>
		</nav><!-- #site-navigation -->
        
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
        
        <div class="area-4-header">
        <div id="link-login">
        	<div id="cadeado"></div><!-- #cadeado -->
			<div id="form-login" class="tgl">	
				<?php if (!(current_user_can('level_0'))){ ?>
				<form action="<?php bloginfo( 'home' ); ?>/wp-login.php" method="post">
				<div class="linha-form">
					<div class="linha-form-a">Login</div> <div class="linha-form-b"><input type="text" name="log" id="log" value="<?php echo wp_specialchars(stripslashes($user_login), 1) ?>" size="20" /></div>
				</div>

				<div class="linha-form">
					<div class="linha-form-a">Senha</div> <div class="linha-form-b"><input type="password" name="pwd" id="pwd" size="14" /><input type="submit" name="submit" value="ok" class="button" /></div>
				</div>
					<input type="hidden" name="redirect_to" value="<?php echo $_SERVER['REQUEST_URI']; ?>" />
				</form>
				<a href="<?php bloginfo( 'home' ); ?>/wp-login.php?action=lostpassword">Esqueceu a Senha?</a>
				<?php } else { ?>
				<a href="<?php echo wp_logout_url( get_permalink() ); ?>" title="Sair">Sair</a>
				<a href="<?php bloginfo( 'home' ); ?>/wp-admin/">Admin</a>
				<?php }?>

			</div><!-- #form-login -->
        </div><!-- #link-login -->
        </div><!-- .area-4-header -->
        
	</header><!-- #masthead -->


	<?php do_action( 'before' ); ?>

	<div id="main" class="site-main">
